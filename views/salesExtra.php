<?php //session_start();?>
<?php //require "../controller/isLogin.php"?>
<?php ////require "../controller/fatchMedicine-sales.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/salesExtra.css">
</head>
<style>
    /*For print bill*/

    /*body {*/
    /*    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;*/
    /*    font-size: 16px;*/
    /*    color: #444;*/
    /*    background-color: #f4f4f4;*/
    /*    width: 50%;*/
    /*}*/

    .openPrinting {
        width: 50%;
        margin: 20px 20px 20px 560px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }


    .header {
        background-color: #3468C0;
        color: #fff;
        padding: 5px;
        text-align: center;
    }

    .header h1 {
        font-size: 36px;
        margin-bottom: 5px;
    }

    .header p {
        font-size: 18px;
        margin-bottom: 0;
    }

    .bill-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 5px;
    }

    .form-label {
        display: block;
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        font-size: 16px;
        border-radius: 5px;
    }

    .btn-group {
        margin-top: 20px;
        text-align: right;
    }

    .btn {
        padding: 10px 20px;
        background-color: #3468C0;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #204080;
    }

    .bill-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .bill-table th, .bill-table td {
        border: 1px solid #ddd;
        padding: 15px;
        text-align: center;
    }

    .bill-table th {
        background-color: #3468C0;
        color: #fff;
    }

    .bill-total {
        font-weight: bold;
        text-align: right;
        padding-top: 10px;
    }

    .hidden {
        display: none;
    }

    #openPrinting{
        /*background-color: rgba(0, 0, 0, 0.4);*/
        position: absolute;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .openPrinting-popup{
        background-color: white;
        /*width: 100vw;*/
        height: auto;
        /*padding: 20px;*/
        position: relative;
    }
</style>
<body>
<div class="salesContainer" id="salesContainer">

    <div class="search-bar">
        <input type="text" id="searchInput" class="search-input" placeholder="Search..." oninput="searchMedicine()">
        <button type="button" class="searchBtn" id="searchBtn" onclick="searchMedicine()"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
    </div>
    <h1 class="sales-medicine-text">Sales Medicine</h1>
    <table class="medicineTable" id="medicineTable">
        <thead>
        <tr>
            <th>Medicine Name</th>
            <th>Batch Number</th>
            <th>Remaining Quantity</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        --><?php
        require "../controller/sales-data.php";
        //    if ($done-> num_rows > 0){
        //        $i = 0;
        //    while ($row = $done->fetch_assoc()){
        //    ?>

        <tr>
            <td>--><?php // echo $row['MEDICINENAME'] ?><!--</td>
        <td>--><?php // echo $row['BATCHNUMBER'] ?><!--</td>
        <td>--><?php // echo $row['QUANTITY'] ?><!--</td>
        <td><button type="button" class="btnSales" onclick="openModal(--><?php //echo $i?>//)"> <i class="fa-solid fa-caret-down"></i> </button></td>
            //
            //    </tr>
        //        <tr class="myModal" hidden>
            //            <td colspan="4">
                //<!--                <label for="quantity">Quantity: </label>-->
                //                <input type="number" name="quantity" id="quantity" class ="quantity" placeholder="Quantity" required>
                //<!--                <label for="discount">Discount: </label>-->
                //                <input type="number" name="discount" id="discount" class="discount" placeholder="Discount%" required>
                //<!--                <label for="remark">Remark: </label>-->
                //                <input name="remark" id="remark" class="remark" cols="" rows="" placeholder="Remark" required>
                //                <button type="button" class="salesBtn" id="salesBtn" onclick="openSubmitEntry()">Sales</button>
                //            </td>
            //        </tr>
        //    <?php //$i++; } }?>
        </tbody>
    </table>
    <div class="page-info">
        --><?php
        if(!isset($_GET['page-nr'])){
        //            $page = 1;
        //        } else{
        //            $page = $_GET['page-nr'];
        //        }
        //        ?>
        Showing  --><?php //echo $page ?><!-- of --><?php //echo $pages; ?><!-- pages
    </div>

    <div class="pagination">
        <a href="?page-nr=1">First</a>

        <!-- Go to the previous page -->
        --><?php
        if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
        //            ?><!-- <a href="?page-nr=--><?php //echo $_GET['page-nr'] - 1 ?><!--">Previous</a> --><?php
    }else{
//            ?><!-- <a>Previous</a>	--><?php
    }
    //        ?>

        <!-- Output the page numbers -->
        <div class="page-numbers">
            <?php
            if(!isset($_GET['page-nr'])){
            //                ?><!-- <a class="active" href="?page-nr=1">1</a> --><?php
            $count_from = 2;
            //            }else{
            //                $count_from = 1;
            //            }
            //            ?>

            <?php
            for ($num = $count_from; $num <= $pages; $num++) {
            //                if($num == @$_GET['page-nr']) {
            //                    ?><!-- <a class="active" href="?page-nr=--><?php //echo $num ?><!--">--><?php //echo $num ?><!--</a> --><?php
            }else{
            //                    ?><!-- <a href="?page-nr=--><?php //echo $num ?><!--">--><?php //echo $num ?><!--</a> --><?php
            }
            //            }
            //            ?>
        </div>

        <!-- Go to the next page -->
        --><?php
    if(isset($_GET['page-nr'])){
    //            if($_GET['page-nr'] >= $pages){
    //                ?><!-- <a>Next</a> --><?php
    }else{
    //                ?><!-- <a href="?page-nr=--><?php //echo $_GET['page-nr'] + 1 ?><!--">Next</a> --><?php
    }
    //        }else{
    //            ?><!-- <a href="?page-nr=2">Next</a> --><?php
    }
    //        ?>
        <a href="?page-nr=--><?php //echo $pages;?><!--">Last</a>
    </div>
</div>

<!--for BIll Printing-->
<div class="openPrinting" id="openPrinting" style="display: none">
    <div class="openPrinting-popup">
        <div class="container">
            <div class="header">
                <h1>Medicine Bill</h1>
                <p>Bill Number: 123456</p>
                <p>Date: 2023-03-08</p>
            </div>

            <div class="bill-body">
                <form id="form">
                    <div class="form-group">
                        <label class="form-label" for="patient-name">Patient Name:</label>
                        <input class="form-input" type="text" id="patient-name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="contact-number">Contact Number:</label>
                        <input class="form-input" type="text" id="contact-number" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">Address:</label>
                        <input class="form-input" type="text" id="address" required>
                    </div>

                    <table class="bill-table">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Medicine Name</th>
                            <th>Expiry Date</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Paracetamol</td>
                            <td>2024-03-08</td>
                            <td>10</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ibuprofen</td>
                            <td>2024-04-08</td>
                            <td>5</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Azithromycin</td>
                            <td>2024-05-08</td>
                            <td>3</td>
                            <td>150</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" class="total">Gross Amount:</td>
                            <td class="total">300</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="total">Discount Amount:</td>
                            <td class="total">0</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="total">Total Amount:</td>
                            <td class="total">300</td>
                        </tr>
                        </tfoot>
                    </table>

                    <div class="btn-group">
                        <button class="btn" type="button" onclick="printBill()"><i class="fa-solid fa-print"></i> Print</button>
                        <button class="btn" type="button" onclick="saveBill()">Save Bill Without Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--<footer class="Footer">-->
<!--    &copy;copyright <b>MEDSOFT</b>. All Rights Reserved <br> Design by 💙 <b>medsoft</b>-->
<!--</footer>-->

<script>
    function searchMedicine() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("medicineTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // function openModal(name, batchNumber) {
    //     document.getElementById('myModal').style.display = 'block';
    //     document.getElementById('quantity').value = '';
    //     document.getElementById('remark').value = '';
    //     console.log(`Opening modal for ${name} - Batch Number: ${batchNumber}`);
    // }

    function openModal(n) {
        document.querySelectorAll('.myModal')[n].toggleAttribute('hidden');
    }
    // function closeModal() {
    //     document.getElementById('myModal').toggleAttribute('hidden');
    // }

    function submitEntry() {
        const quantity = document.getElementById('quantity').value;
        const discount = document.getElementById('discount').value;
        const remark = document.getElementById('remark').value;
        console.log(`Quantity: ${quantity}, Discount: ${discount}, Remark: ${remark}`);
        closeModal();
    }

    // function searchMedicine() {
    //     const searchInput = document.getElementById('searchInput');
    //     const searchTerm = searchInput.value.toLowerCase();
    //     const medicines = [
    //         { id: 1, name: 'Medicine A', batchNumber: 'B001', quantity: 10, price: 5.00 },
    //         { id: 2, name: 'Medicine B', batchNumber: 'B002', quantity: 15, price: 8.00 },
    //         { id: 3, name: 'Medicine C', batchNumber: 'B003', quantity: 20, price: 12.50 }
    //     ];
    //     const filteredMedicines = medicines.filter(medicine =>
    //         medicine.name.toLowerCase().includes(searchTerm) ||
    //         medicine.batchNumber.toLowerCase().includes(searchTerm)
    //     );
    //     renderMedicines(filteredMedicines);
    // }

    // function renderMedicines(filteredMedicines) {
    //     const tableBody = document.getElementById('medicineTable').getElementsByTagName('tbody')[0];
    //     tableBody.innerHTML = '';
    //     filteredMedicines.forEach(medicine => {
    //         const row = tableBody.insertRow();
    //         const cellName = row.insertCell(0);
    //         const cellBatchNumber = row.insertCell(1);
    //         const cellQuantity = row.insertCell(2);
    //         const cellAction = row.insertCell(3);
    //         cellName.textContent = medicine.name;
    //         cellBatchNumber.textContent = medicine.batchNumber;
    //         cellQuantity.textContent = medicine.quantity;
    //         const openModalButton = document.createElement('button');
    //         openModalButton.type = 'button';
    //         openModalButton.textContent = 'Sales';
    //         openModalButton.addEventListener('click', function () {
    //             openModal(medicine.name, medicine.batchNumber);
    //         });
    //         cellAction.appendChild(openModalButton);
    //     });
    // }
    //
    // searchMedicine();

    function printBill() {
        window.print();
        // Hide the print and save buttons after printing.
        document.querySelectorAll('.btn').forEach(btn => {
            btn.classList.add('hidden');
        });
    }

    function saveBill() {
        const patientName = document.getElementById('patient-name').value;
        const contactNumber = document.getElementById('contact-number').value;
        const address = document.getElementById('address').value;

        const billData = {
            patientName,
            contactNumber,
            address,
            medicines: [
                {
                    name: 'Paracetamol',
                    expiryDate: '2024-03-08',
                    quantity: 10,
                    price: 100
                },
                {
                    name: 'Ibuprofen',
                    expiryDate: '2024-04-08',
                    quantity: 5,
                    price: 50
                },
                {
                    name: 'Azithromycin',
                    expiryDate: '2024-05-08',
                    quantity: 3,
                    price: 150
                }
            ]
        };
    }

    <!--For Printing -->
    function openSubmitEntry() {
        document.getElementById('openPrinting').style.display = 'flex';
        closeModal();

    }
    function closeSubmitEntry(){
        document.getElementById('openPrinting').style.display = 'none';
    }


</script>

</body>
</html>
