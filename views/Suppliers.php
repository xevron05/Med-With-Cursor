<?php session_start(); ?>
<?php require "../controller/isLogin.php"; ?>

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
                <th style="text-align:left; padding:8px;">Reports</th>
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
                <td style="padding:8px; border-bottom:1px solid #e5e7eb;"><a href="#" onclick="return openSupplierReport(${r.id}, '${r.name.replace(/'/g, "&apos;")}')">View</a></td>
            </tr>`);
        })
    })
}
$('#search').on('click', function(){ load($('#q').val()); })
$(function(){ load(); })

function openSupplierReport(id, name){
    const modalId = 'supplierReportModal';
    let modal = document.getElementById(modalId);
    if(!modal){
        modal = document.createElement('div');
        modal.id = modalId;
        modal.style.position='fixed'; modal.style.inset='0'; modal.style.background='rgba(0,0,0,0.35)'; modal.style.display='flex'; modal.style.alignItems='center'; modal.style.justifyContent='center';
        modal.innerHTML = `
            <div style="background:#fff; width:920px; max-width:95%; border-radius:10px; padding:16px;">
                <div style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
                    <h3 id="srTitle" style="margin:0;">Supplier Report</h3>
                    <button onclick="document.getElementById('${modalId}').remove()" style="border:none;background:#ef4444;color:#fff;padding:6px 10px;border-radius:6px;">Close</button>
                </div>
                <div style="display:flex; gap:8px; align-items:end; margin-top:12px;">
                    <div><label>From</label><input type="date" id="srFrom" style="padding:6px 8px"></div>
                    <div><label>To</label><input type="date" id="srTo" style="padding:6px 8px"></div>
                    <div><button id="srApply" style="padding:8px 12px; background:#2563eb; color:#fff; border:none; border-radius:6px;">Apply</button></div>
                </div>
                <div style="margin-top:12px; max-height:60vh; overflow:auto;">
                    <table style="width:100%; border-collapse: collapse;">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th style="text-align:left; padding:8px;">Medicine</th>
                                <th style="text-align:left; padding:8px;">Batch</th>
                                <th style="text-align:left; padding:8px;">Import Qty</th>
                                <th style="text-align:left; padding:8px;">Rate</th>
                                <th style="text-align:left; padding:8px;">Discount</th>
                                <th style="text-align:left; padding:8px;">Total Rate</th>
                                <th style="text-align:left; padding:8px;">Import Date</th>
                            </tr>
                        </thead>
                        <tbody id="srRows"></tbody>
                    </table>
                </div>
                <div style="margin-top:12px; display:flex; justify-content:flex-end; gap:12px; font-weight:600;">
                    <div>Total Import Amount: <span id="srTotal">0.00</span></div>
                </div>
            </div>`;
        document.body.appendChild(modal);
    }
    document.getElementById('srTitle').innerText = `Supplier Report - ${name}`;
    const today = new Date().toISOString().slice(0,10);
    const from = new Date(); from.setMonth(from.getMonth()-1);
    document.getElementById('srFrom').value = from.toISOString().slice(0,10);
    document.getElementById('srTo').value = today;
    function fetchAndRender(){
        const s = document.getElementById('srFrom').value; const e = document.getElementById('srTo').value;
        $.get('../controller/suppliers.php', {format:'report', supplier_id:id, start:s, end:e}, function(rows){
            const body = $('#srRows'); body.empty();
            let total = 0;
            rows.forEach(r=>{
                const lineTotal = (parseFloat(r.rate)||0) * (parseFloat(r.import_qty)||0) - (parseFloat(r.discount)||0);
                total += lineTotal;
                body.append(`<tr>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.medicine_name}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.batch_no}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.import_qty}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.rate}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.discount || 0}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${lineTotal.toFixed(2)}</td>
                    <td style="padding:8px; border-bottom:1px solid #e5e7eb;">${r.import_date}</td>
                </tr>`)
            })
            document.getElementById('srTotal').innerText = total.toFixed(2);
        })
    }
    document.getElementById('srApply').onclick = fetchAndRender;
    fetchAndRender();
    return false;
}
</script>
</body>
</html>



