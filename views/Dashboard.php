<?php session_start();?>
<?php require "../controller/isLogin.php";?>
<?php require "../controller/totalMedicine-data.php" ?>
<?php //require "../controller/medicine-data.php" ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Medicine Inventory System</title>
    <link rel="stylesheet" href="../public/css/Dashboard.css">
</head>
<body>
<div class="content">
    <div class="section-title">Dashboard</div>
    <div class="card-container">

<!--        --><?php
//        if ($totaRowCount-> num_rows > 0){
//        while ($row = $totaRowCount->fetch_assoc()){
//
//        ?>
        <div class="card">
            <h2>Total Medicines</h2>
<!--            <span id="totalRowCount"></span>-->
            <p>Currently managing  medicines in <span><?php  echo "$rowcounting";?> </span> the inventory.</p>
            <a  <button class="totalMedicines" href="totalMedicine.php"> More Details </button> </a>

        </div>

        <div class="card">
            <h2>Low Stock Alert</h2>
            <p> <span id="lowStockCount"></span> medicines are running low in stock. Please replenish.</p>
            <a  <button class="lowStockBtn" href="lowStock.php"> More Details </button> </a>
        </div>

        <div class="card">
            <h2>Expired Medicines</h2>
            <p> <span id="expiryRowCount"></span> medicines have expired. Take necessary actions.</p>
            <a  <button class="totalMedicines" href="expiryDate.php"> More Details </button> </a>
        </div>

    </div>
</div>



<footer class="Footer">
    &copy;copyright <b>MEDSOFT</b>. All Rights Reserved <br> Design by 💙 <b>medsoft</b>
</footer>

<script>
    function showModal(title, content) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalContent').innerText = content;
        document.getElementById('myModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Allow closing modal by clicking the close button
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('close')) {
            closeModal();
        }
    });

    // // For count Total medicine
    // fetch('totalMedicine.php')
    //     .then(response => response.text())
    //     .then(php => {
    //         const parser = new DOMParser();
    //         const doc = parser.parseFromString(php, 'text/html');
    //         const rowCount = doc.querySelectorAll('table tr').length;
    //         var rowCountSpan = document.getElementById('totalRowCount');
    //         rowCountSpan.textContent = rowCount;
    //     })
    //     .catch(error => {
    //         console.log('Error fetching data:', error);
    //     });

// Low stock count via API
    fetch('../controller/low-stock-data.php?threshold=5')
        .then(r=>r.json())
        .then(j=>{ document.getElementById('lowStockCount').textContent = j.items.length; })
        .catch(()=>{});

// Expiry within 30 days via API
    fetch('../controller/expiry-alerts.php?days=30')
        .then(r=>r.json())
        .then(j=>{ document.getElementById('expiryRowCount').textContent = j.items.length; })
        .catch(()=>{});

</script>
</body>
</html>
