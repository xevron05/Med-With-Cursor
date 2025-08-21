<?php session_start();?>
<?php require "../controller/isLogin.php";
require "../controller/medicine-data.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/detailsMedicine.css">
</head>
<body>

<header>
    <h1>Medicine Details</h1>
</header>
<div id="existMedicine">
</div>
<?php if (isset($_GET['success']) && $_GET['success'] == '1') {?>
    <p class="success-color">Entered Successfully.</p>
<?php }?>
<?php if (isset($_GET['success']) && $_GET['success'] == '0') {?>
    <p class="failed-color">Failed to insert</p>
<?php }?>
<?php if (isset($_GET['delete']) && $_GET['delete'] == '1') {?>
    <p class="success-color">Deleted Successfully.</p>
<?php }?>
<?php if (isset($_GET['delete']) && $_GET['delete'] == '0') {?>
    <p class="failed-color">Failed to delete</p>
<?php }?>
<div class="container">
    <span><button onclick="openAddMedicineModal()"><i class="fa-solid fa-plus"></i> Add Medicine</button></span>
    <input type="text" id="searchInput" placeholder="Search Medicine" onchange="searchMedicine()">
    <input type="submit" value="Search" onclick="searchMedicine()">


    <table id="medicineTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <?php
            if ($result-> num_rows > 0){
                while ($row = $result->fetch_assoc()){

                    ?>
                        <tr>
                        <td><?php echo $i?></td>
                        <td><?php  echo $row['MEDICINENAME'] ?></td>
                        <td><?php echo $row['COMPANYNAME'] ?></td>
                        <td>
                            <div class="actionButton">
                        <button class="batch-entry-btn" onclick="openBatchEntry('<?php  echo $row['MEDICINENAME'] ?>','<?php echo $row['SN']?>')"><i class="fa-solid fa-plus"></i> Batch Entry</button>

                            <form action="../controller/Delete-medicine.php" method="post">
                                <input type="hidden" name="ID" value="<?php echo  $row['SN']?>">
                                <button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                            </div>
                        </td>
                        </tr>

            <?php   $i++; }  }?>
        <tr>

        </tr>
    </table>
    <div class="page-info">
        <?php
        if(!isset($_GET['page-nr'])){
            $page = 1;
        }else{
            $page = $_GET['page-nr'];
        }
        ?>
        Showing  <?php echo $page ?> of <?php echo $pages; ?> pages
    </div>

    <div class="pagination">
        <a href="?page-nr=1">First</a>

        <!-- Go to the previous page -->
        <?php
        if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
            ?> <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a> <?php
        }else{
            ?> <a>Previous</a>	<?php
        }
        ?>

        <!-- Output the page numbers -->
        <div class="page-numbers">
            <?php
            if(!isset($_GET['page-nr'])){
                ?> <a class="active" href="?page-nr=1">1</a> <?php
                $count_from = 2;
            }else{
                $count_from = 1;
            }
            ?>

            <?php
            for ($num = $count_from; $num <= $pages; $num++) {
                if($num == @$_GET['page-nr']) {
                    ?> <a class="active" href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                }else{
                    ?> <a href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                }
            }
            ?>
        </div>

        <!-- Go to the next page -->
        <?php
        if(isset($_GET['page-nr'])){
            if($_GET['page-nr'] >= $pages){
                ?> <a>Next</a> <?php
            }else{
                ?> <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a> <?php
            }
        }else{
            ?> <a href="?page-nr=2">Next</a> <?php
        }
        ?>
        <a href="?page-nr=<?php echo $pages;?>">Last</a>
    </div>
</div>
<br><br>
<footer class="Footer" id="Footer">
    &copy;copyright <b>MEDSOFT</b>. All Rights Reserved <br> Design by 💙 <b>medsoft</b>
</footer>

<div class="medicineEntry" id="medicineEntry" style="display: none">
    <form action="../controller/Add-medicine-controller.php" method="post">
        <div class="medicineEntry-popup">
            <span class="close" onclick="closeAddMedicineModal()">&times;</span>
            <div class="medicineName">
                <h1>Add New Medicine</h1>
                <input type="text" id="medicineName" name="medicineName" placeholder="Medicine Name" required>
            </div>
            <div class="medicineInfoEntry">
                <div class="company">
                    <input type="text" name="companyName" id="companyName" placeholder="Company Name" required>
                </div>
                <div class="unit">
                    <input type="text" name="unit" id="unit" placeholder="Category" required>
                </div>
                <!-- <div class="unit">
                    <select name="unit" id="unit" aria-placeholder="Category" require">
                        <option value="Tablet">TABLET</option>
                        <option value="Capsule">CAPUSLE</option>
                        <option value="Syrup">SYRUP</option>
                        <option value="Drop">DROP</option>
                        <option value="Powder">POWDER</option>
                        <option value="Cream">CREAM</option>
                        <option value="Injection">INJECTION</option>
                    </select>
                </div> -->
                <div class="moneyType">
                    <select name="moneyType" id="moneyType" aria-placeholder="Select type" required>
                        <option value="Nepali">NPR</option>
                        <option value="Indian">INR</option>
                    </select>
                    </label>
                </div>
            </div>


            <div class="saveMedicine">
                <button type="submit" name="saveMedicine" class="button" value="Button1" >Save Medicine</button>
            </div>
        </div>
    </form>
</div>


<div class="batchEntry" id="batchEntry" style="display: none">
    <form action="../controller/Submit-batch-entry.php" method="post">
        <div class="batchEntry-popup">
            <span class="close" onclick="closeBatchEntry()">&times;</span>
        <h1>New Batch Entry of <span id="entryMedicineName"></span></h1>
        <div class="upInfo">
            <div class="batchNo">
                <label for="batch_No">Batch No: </label>
                <input type="text" name="batchNo" id="batchNo" placeholder="Batch Number" require>
            </div>

            <div class="expiry">
                <label for="date">Expiry: </label>
                <input type="date" name="expiry" id="expiry" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
        </div>
        <div class="downInfo">
            <div class="quantity">
                <label for="quantity">Quantity: </label>
<input type="number" name="quantity" id="quantity" placeholder="Quantity" min="1" step="1" oninput="validity.valid||(value='');" required>
            </div>
            <div class="MRP">
                <label for="mrp">MRP: </label>
<input type="number" name="mrp" id="mrp" placeholder="MRP" required min="0" step="0.01" oninput="validity.valid||(value='');">

            </div>
        </div>
        <div class="process">
            <input type="hidden" name="medId" id="medId">
            <button type="submit">Submit</button>
            <button type="reset" class="reset">Reset</button>
        </div>
    </form>
</div>



<script>
    function openBatchEntry(medName, id) {
        document.getElementById('batchEntry').style.display = 'flex';
        document.getElementById('entryMedicineName').innerText = medName;
        document.getElementById('medId').value = id;
        console.log(id);
    }

    function closeBatchEntry(){
        document.getElementById('batchEntry').style.display = 'none';
    }
/*
    document.addEventListener("click", function(closeBatchEntry) {
            // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()
            if (
                closeBatchEntry.target.matches(".close") ||
                !closeBatchEntry.target.closest(".container")
            ) {
                closeModal()
            }
        },
        false
    )
    function closeModal() {
        document.querySelector(".batchEntry").style.display = "none"
    }
*/


    function openAddMedicineModal() {
        document.getElementById('medicineEntry').style.display = 'flex';
    }

    function closeAddMedicineModal() {
        document.getElementById('medicineEntry').style.display = 'none';
    }
/*
    // document.addEventListener("click", function(closeMedicineEntry) {
    //         // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()
    //         if (
    //             closeMedicineEntry.target.matches(".close") ||
    //             !closeMedicineEntry.target.closest(".container")
    //         ) {
    //             closeModal()
    //         }
    //     },
    //     false
    // )
    // function closeModal() {
    //     document.querySelector(".medicineEntry").style.display = "none"
    // }
*/

    // function closeOpenElement(){}
    // document.getElementById('medicineEntry').style.display = 'none';
    //
    // function closeOpenElement(){}
    // document.getElementById('batchEntry').style.display = 'none';


    function searchMedicine() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("medicineTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    
</script>
<script src="../public/js/medicineDetails.js"></script>

</body>
</html>


