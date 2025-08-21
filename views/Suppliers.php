<?php session_start(); ?>
<?php require "../controller/isLogin.php"; ?>
<?php require "./Navigation.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers</title>
    <link rel="stylesheet" href="../public/css/totalMedicine.css">
    <script src="../public/js/jquery.js"></script>
</head>
<body>
<div style="width:95%; margin: 20px auto;">
    <h2>Suppliers</h2>
    <form method="post" action="../controller/suppliers.php" style="display:grid; grid-template-columns: repeat(3,1fr); gap:10px; align-items: end;">
        <div>
            <label>Name</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Contact Person</label>
            <input type="text" name="contact_person">
        </div>
        <div>
            <label>Phone</label>
            <input type="text" name="phone">
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address">
        </div>
        <div>
            <label>Notes</label>
            <input type="text" name="notes">
        </div>
        <div>
            <button type="submit" style="padding:8px 12px; background:#2563eb; color:#fff; border:none; border-radius:6px;">Add Supplier</button>
        </div>
    </form>

    <div style="display:flex; justify-content: space-between; margin-top: 16px;">
        <input type="text" id="q" placeholder="Search name/contact/phone" style="padding:6px 8px; width:260px;">
        <button id="search" style="padding:8px 12px; background:#1e40af; color:#fff; border:none; border-radius:6px;">Search</button>
    </div>

    <table style="width:100%; margin-top: 12px; border-collapse: collapse;">
        <thead style="background:#f1f5f9;">
            <tr>
                <th style="text-align:left; padding:8px;">Name</th>
                <th style="text-align:left; padding:8px;">Contact</th>
                <th style="text-align:left; padding:8px;">Phone</th>
                <th style="text-align:left; padding:8px;">Email</th>
                <th style="text-align:left; padding:8px;">Address</th>
                <th style="text-align:left; padding:8px;">Actions</th>
            </tr>
        </thead>
        <tbody id="supplierRows"></tbody>
    </table>
</div>

<script>
function load(q){
    const params = q ? {format:'json', q} : {format:'json'};
    $.get('../controller/suppliers.php', params, function(rows){
        const body = $('#supplierRows');
        body.empty();
        rows.forEach(r=>{
            body.append(`<tr>
                <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.name}</td>
                <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.contact_person || ''}</td>
                <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.phone || ''}</td>
                <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.email || ''}</td>
                <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.address || ''}</td>
                <td style="padding:8px; border-bottom:1px solid #e5e7eb;"><a href="../controller/suppliers.php?action=delete&id=${r.id}" onclick="return confirm('Delete this supplier?')">Delete</a></td>
            </tr>`);
        })
    })
}
$('#search').on('click', function(){ load($('#q').val()); })
$(function(){ load(); })
</script>
</body>
</html>



