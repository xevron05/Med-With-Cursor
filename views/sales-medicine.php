<?php session_start(); ?>
<?php require "../controller/isLogin.php"; ?>
<?php require "../controller/sales-data.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/salesMedicine.css">
    <script src="../public/js/jquery.js"></script>
</head>

<body>
    <div class="salesContainer" id="salesContainer">
        <?php if (isset($_GET['success']) && $_GET['success'] == '1') { ?>
            <div style="background-color: green; color: #ffffff; padding: 10px 20px; display: flex;margin: 10px 0; justify-content: space-between; align-items: center; width: 100%;"><span style="flex: 1;">Successfully Added</span><button style="background-color: transparent; color: #721c24; border: none; cursor: pointer;" onclick="this.parentElement.style.display='none';">X</button></div>

        <?php } ?>
        <?php if (isset($_GET['success']) && $_GET['success'] == '0') { ?>
            <div style="background-color: #f8d7da; color: #721c24;margin: 10px 0; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; width: 100%;"><span style="flex: 1;">Failed to add Medicine</span><button style="background-color: transparent; color: #721c24; border: none; cursor: pointer;" onclick="this.parentElement.style.display='none';">X</button></div>

        <?php } ?>


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
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($done->num_rows > 0) {
                    $i = 0;
                    while ($row = $done->fetch_assoc()) {
                        $disable = (int)$row['QUANTITY'] > 0 ? "disabled" : "";
                        $bid = $row['B_SN'];
                        if (!$disable) {
                            $deleteBatchMed = "DELETE FROM medicinebatch WHERE B_SN = '$bid'";
                            $conn->query($deleteBatchMed);
                        }
                        $quantity = (int)$row['QUANTITY'] > 0 ? $row['QUANTITY'] : "OUT OF STOCK";

                        $isExpired = (strtotime($row['EXPIRYDATE']) < strtotime(date('Y-m-d')));
                ?>


                        <tr>
                            <td><?php echo $row['MEDICINENAME']; ?></td>
                            <td><?php echo $row['BATCHNUMBER']; ?></td>
                            <td style="<?php echo $isExpired ? 'color:red;font-weight:bold;' : ''; ?>">
                                <?php echo $row['EXPIRYDATE']; ?>
                            <td>
                                <?php echo $quantity ?>
                            </td>
                            <td><button type="button" class="btnSales" onclick="openModal(<?php echo $i ?>)"> <i class="fa-solid fa-caret-down"></i> </button></td>

                        </tr>

                        <tr class="myModal" hidden>
                            <td colspan="4">

                                <form id="insertSalesDetails<?php echo $i; ?>" action="../controller/insert.php" method="post" onsubmit="return checkQuantity(<?php echo $i; ?>, <?php echo (int)$row['QUANTITY']; ?>)">
                                    <input type="hidden" name="batchId" id="medId" value="<?php echo $row['B_SN']; ?>">
                                    <input type="number" name="quantity" id="quantity<?php echo $i; ?>" class="quantity" placeholder="Quantity" required min="1" step="1" oninput="validity.valid||(value='');">
                                    <input type="number" name="discount" id="discount" class="discount" placeholder="Discount %" min="0" max="100" step="0.01" oninput="validity.valid||(value='');">
                                    <input type="text" name="remark" id="remark" class="remark" placeholder="Remark">
                                    <button type="submit" value="submit" class="salesBtn" id="salesBtn">Sales</button>
                                </form>

                            </td>
                        </tr>

                        <script>
                            // $(document).ready(()=>{
                            //     $('#salesBtn').click((e)=>{
                            //         console.log(e);
                            //         console.log("hello");
                            //     })
                            // })
                        </script>


                <?php $i++;
                    }
                } ?>
            </tbody>
        </table>
        <div class="page-info">
            <?php
            if (!isset($_GET['page-nr'])) {
                $page = 1;
            } else {
                $page = $_GET['page-nr'];
            }
            ?>
            Showing <?php echo $page ?> of <?php echo $pages; ?> pages
        </div>

        <div class="pagination">
            <a href="?page-nr=1">First</a>

            <!-- Go to the previous page -->
            <?php
            if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
            ?> <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a> <?php
                                                                                } else {
                                                                                    ?> <a>Previous</a> <?php
                                                                                }
                                ?>

            <!-- Output the page numbers -->
            <div class="page-numbers">
                <?php
                if (!isset($_GET['page-nr'])) {
                ?> <a class="active" href="?page-nr=1">1</a> <?php
                                                                $count_from = 2;
                                                            } else {
                                                                $count_from = 1;
                                                            }
                                                                ?>

                <?php
                for ($num = $count_from; $num <= $pages; $num++) {
                    if ($num == @$_GET['page-nr']) {
                ?> <a class="active" href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                                                                                                } else {
                                                                                                    ?> <a href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
                                                                                                }
                                                                                            }
                                                                                    ?>
            </div>

            <!-- Go to the next page -->
            <?php
            if (isset($_GET['page-nr'])) {
                if ($_GET['page-nr'] >= $pages) {
            ?> <a>Next</a> <?php
                            } else {
                                ?> <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a> <?php
                                                                                }
                                                                            } else {
                                                                                    ?> <a href="?page-nr=2">Next</a> <?php
                                                                            }
                                                ?>
            <a href="?page-nr=<?php echo $pages; ?>">Last</a>
        </div>
    </div>

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

        // for Quantity Valitation
        function checkQuantity(index, maxQty) {
            const qtyField = document.getElementById("quantity" + index);
            const qtyValue = parseInt(qtyField.value, 10);
            if (qtyValue > maxQty) {
                alert("Selected quantity exceeds available stock.");
                qtyField.focus();
                return false;
            }
            return true;
        }

        

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
                medicines: [{
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

        // <!--For Printing -->
        // function openSubmitEntry() {
        //     document.getElementById('openPrinting').style.display = 'flex';
        //     closeModal();
        // }
        document.getElementById("salesBtn").onclick = function() {
            location.href = "addToBill.php";
        }
        // function closeSubmitEntry(){
        //     document.getElementById('openPrinting').style.display = 'none';
        // }

        document.getElementById('salesBtn').addEventListener('click', function() {
            // Access the iframe element where file2.html will be loaded
            var iframe2 = parent.document.getElementById(location.href = "");
            // Change the src attribute of iframe2 to load file2.html
            iframe2.src = 'addToBill.php';
        });


        // AJAX function to send selected medicine details to PHP script
        function submitEntry() {
            const quantity = document.getElementById('quantity').value;
            const discount = document.getElementById('discount').value;
            const remark = document.getElementById('remark').value;

            // Send data to server using AJAX
            $.ajax({
                url: 'addToBill.php', // PHP script to handle the request
                type: 'post',
                data: {
                    quantity: quantity,
                    discount: discount,
                    remark: remark
                },
                success: function(response) {
                    // Optionally, update UI if needed
                    console.log(response);
                }
            });
        }
    </script>

</body>

</html>