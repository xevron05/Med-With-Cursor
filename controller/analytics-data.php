<?php
require('../php-config/Connection.php');

header('Content-Type: application/json');

$start = isset($_GET['start']) ? $_GET['start'] : null;
$end = isset($_GET['end']) ? $_GET['end'] : null;
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (!$start || !$end) {
    // Default: last 7 days
    $end = date('Y-m-d');
    $start = date('Y-m-d', strtotime('-6 days'));
}

// Normalize to full day bounds
$startDateTime = $start . ' 00:00:00';
$endDateTime = $end . ' 23:59:59';

// Metrics: total revenue, transactions count, average per day
$metricsSql = $conn->prepare("SELECT 
    COALESCE(SUM(total_amount), 0) AS total_revenue,
    COUNT(*) AS transactions
    FROM bills
    WHERE bill_date BETWEEN ? AND ?");
$metricsSql->bind_param('ss', $startDateTime, $endDateTime);
$metricsSql->execute();
$metrics = $metricsSql->get_result()->fetch_assoc();
$metricsSql->close();

$daysDiff = (strtotime($end) - strtotime($start)) / (60 * 60 * 24) + 1;
$avgPerDay = $daysDiff > 0 ? round(((float)$metrics['total_revenue']) / $daysDiff, 2) : 0.0;

// Top selling medicine by quantity
$topSql = $conn->prepare(
    "SELECT bi.medicine_name, SUM(bi.quantity) AS qty
    FROM bill_items bi
    INNER JOIN bills b ON b.id = bi.bill_id
    WHERE b.bill_date BETWEEN ? AND ?
    GROUP BY bi.medicine_name
    ORDER BY qty DESC
    LIMIT 1"
    );
$topSql->bind_param('ss', $startDateTime, $endDateTime);
$topSql->execute();
$topRow = $topSql->get_result()->fetch_assoc();
$topSql->close();

// Daily revenue series
$seriesStmt = $conn->prepare("SELECT DATE(bill_date) AS day, COALESCE(SUM(total_amount),0) AS revenue
    FROM bills
    WHERE bill_date BETWEEN ? AND ?
    GROUP BY DATE(bill_date)
    ORDER BY day ASC");
$seriesStmt->bind_param('ss', $startDateTime, $endDateTime);
$seriesStmt->execute();
$seriesRes = $seriesStmt->get_result();
$series = [];
while ($r = $seriesRes->fetch_assoc()) {
    $series[] = $r;
}
$seriesStmt->close();

// Table data: bills list with optional search on bill no, customer name or medicine name
$baseSql = "SELECT DISTINCT b.id, b.bill_no, b.bill_date, b.customer_name, b.total_amount, b.payment_status
            FROM bills b
            LEFT JOIN bill_items bi ON bi.bill_id = b.id
            WHERE b.bill_date BETWEEN ? AND ?";
$params = [$startDateTime, $endDateTime];
$types = 'ss';
if ($query !== '') {
    $like = '%' . $conn->real_escape_string($query) . '%';
    $baseSql .= " AND (b.bill_no LIKE ? OR b.customer_name LIKE ? OR bi.medicine_name LIKE ?)";
    $params[] = $like; $params[] = $like; $params[] = $like; $types .= 'sss';
}
$baseSql .= " ORDER BY b.bill_date DESC, b.id DESC";

$stmt = $conn->prepare($baseSql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$tableRes = $stmt->get_result();
$rows = [];
while ($row = $tableRes->fetch_assoc()) {
    $rows[] = $row;
}
$stmt->close();

echo json_encode([
    'metrics' => [
        'totalRevenue' => round((float)$metrics['total_revenue'], 2),
        'transactions' => (int)$metrics['transactions'],
        'topSelling' => $topRow ? ['name' => $topRow['medicine_name'], 'quantity' => (int)$topRow['qty']] : null,
        'averagePerDay' => $avgPerDay,
        'start' => $start,
        'end' => $end
    ],
    'series' => $series,
    'table' => $rows
]);

?>



