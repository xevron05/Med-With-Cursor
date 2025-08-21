<?php session_start(); ?>
<?php require "../controller/isLogin.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Analytics</title>
    <link rel="stylesheet" href="../public/css/Analytics.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/jquery.js"></script>
</head>
<body>
<div class="analytics-container">
    <div class="toolbar">
        <div class="range-buttons">
            <button data-range="today">Today</button>
            <button data-range="last7">Last 7 days</button>
            <button data-range="thisMonth">This month</button>
            <button data-range="lastYear">Last year</button>
        </div>
        <div class="custom-range">
            <input type="date" id="startDate"> <span>to</span> <input type="date" id="endDate">
            <button id="applyRange">Apply</button>
        </div>
        <div class="search">
            <input type="text" id="searchInput" placeholder="Search Bill ID, Customer, Medicine">
            <button id="searchBtn">Search</button>
        </div>
    </div>

    <div class="metrics">
        <div class="metric-card"><div class="label">Total Revenue</div><div id="mRevenue" class="value">0</div></div>
        <div class="metric-card"><div class="label">Transactions</div><div id="mTx" class="value">0</div></div>
        <div class="metric-card"><div class="label">Top-Selling</div><div id="mTop" class="value">-</div></div>
        <div class="metric-card"><div class="label">Avg/Day</div><div id="mAvg" class="value">0</div></div>
    </div>

    <div class="charts">
        <canvas id="revenueChart"></canvas>
    </div>

    <div class="table-section">
        <table id="analyticsTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Bill ID</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
    let chart;
    function formatMoney(n){ return new Intl.NumberFormat(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(n || 0); }

    function calcRange(range){
        const now = new Date();
        let s,e;
        if(range==='today'){ s = new Date(now); e = new Date(now); }
        else if(range==='last7'){ e = new Date(now); s = new Date(now); s.setDate(s.getDate()-6); }
        else if(range==='thisMonth'){ e = new Date(now.getFullYear(), now.getMonth()+1, 0); s = new Date(now.getFullYear(), now.getMonth(), 1); }
        else if(range==='lastYear'){ s = new Date(now.getFullYear()-1, 0, 1); e = new Date(now.getFullYear()-1, 11, 31); }
        const toStr = d => d.toISOString().slice(0,10);
        return {start: toStr(s), end: toStr(e)};
    }

    function loadData(params){
        $.get('../controller/analytics-data.php', params, function(res){
            // metrics
            $('#mRevenue').text(formatMoney(res.metrics.totalRevenue));
            $('#mTx').text(res.metrics.transactions);
            $('#mTop').text(res.metrics.topSelling ? (res.metrics.topSelling.name+ ' ('+ res.metrics.topSelling.quantity +')') : '-');
            $('#mAvg').text(formatMoney(res.metrics.averagePerDay));

            // chart
            const labels = res.series.map(r=>r.day);
            const data = res.series.map(r=>parseFloat(r.revenue));
            if(chart){ chart.destroy(); }
            const ctx = document.getElementById('revenueChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: { labels, datasets: [{ label: 'Revenue', data, borderColor: '#2563eb', backgroundColor: 'rgba(37,99,235,0.15)', tension: 0.25, fill: true }]},
                options: { responsive: true, scales: { y: { beginAtZero: true } } }
            });

            // table
            const tbody = $('#analyticsTable tbody');
            tbody.empty();
            res.table.forEach(r => {
                const d = new Date(r.bill_date).toISOString().slice(0,10);
                const tr = `<tr>
                    <td>${d}</td>
                    <td>${r.bill_no}</td>
                    <td>${r.customer_name || ''}</td>
                    <td>${formatMoney(r.total_amount)}</td>
                    <td>${r.payment_status}</td>
                </tr>`;
                tbody.append(tr);
            });
        });
    }

    $(function(){
        // default load
        const r = calcRange('last7');
        $('#startDate').val(r.start); $('#endDate').val(r.end);
        loadData(r);

        $('.range-buttons button').on('click', function(){
            const range = $(this).data('range');
            const rp = calcRange(range);
            $('#startDate').val(rp.start); $('#endDate').val(rp.end);
            loadData(rp);
        });

        $('#applyRange').on('click', function(){
            const start = $('#startDate').val();
            const end = $('#endDate').val();
            const q = $('#searchInput').val();
            loadData({start, end, q});
        });

        $('#searchBtn').on('click', function(){
            const start = $('#startDate').val();
            const end = $('#endDate').val();
            const q = $('#searchInput').val();
            loadData({start, end, q});
        });
    });
</script>
</body>
</html>



