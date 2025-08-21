<?php session_start();?>
<?php require "../controller/isLogin.php";?>
<?php require "../controller/medicine-data.php";?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Low Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/lowStock.css">
</head>
<body>

<header>
    <h1>Low Stock</h1>
</header>

<div class="low-stockBody" id="low-stockBody">
    <div class="low-stock">

        <table>
            <thead>
            <tr class="">
                <th>ID</th>
                <th>Name</th>
                <th>Batch Number</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
            </thead>
            <?php
           if ($doneLowStock-> num_rows > 0){
                while ($row = $doneLowStock->fetch_assoc()){

                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php  echo $row['MEDICINENAME'] ?></td>
                        <td ><?php echo $row['BATCHNUMBER'] ?></td>
                        <td><?php echo $row['QUANTITY'] ?></td>

                        <td>
                            <div class="actionButton">
                                <button class="batch-entry-btn" onclick="openBatchEntry('<?php  echo $row['MEDICINENAME'] ?>','<?php echo $row['SN']?>')"><i class="fa-solid fa-plus"></i> Batch Entry</button>
                            </div>
                        </td>
                    </tr>
                    <?php   $i++; }  }?>
            <tr>

            </tr>
        </table>
    </div>
</div>
</table>

<footer class="Footer">
    &copy;copyright <b>MEDSOFT</b>. All Rights Reserved <br> Design by 💙 <b>medsoft</b>
</footer>


<div class="batchEntry" id="batchEntry" style="display: none">
    <form action="../controller/Submit-batch-entry.php" method="post">
        <div class="batchEntry-popup">
            <span class="close" onclick="closeBatchEntry()">&times;</span>
            <h1>New Batch Entry of....</h1>
            <h3>Medicine Name:- <span id="entryMedicineName"></span></h3>
            <div class="upInfo">
                <div class="batchNo">
                    <label for="batch_No">Batch No: </label>
                    <input type="text" name="batchNo" id="batchNo" placeholder="Batch Number" >
                </div>

                <div class="expiry">
                    <label for="date">Expiry: </label>
                    <input type="date" name="expiry" id="expiry">
                </div>
            </div>
            <div class="downInfo">
                <div class="quantity">
                    <label for="quantity">Quantity: </label>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity">
                </div>
                <div class="MRP">
                    <label for="mrp">MRP: </label>
                    <input type="number" name="mrp" id="mrp" placeholder="MRP">
                </div>
            </div>
            <div class="process">
                <input type="hidden" name="medId" id="medId">
                <button type="submit" class="submit">Submit</button>
                <button type="reset"  class="reset">Reset</button>
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
</script>

</body>
</html>
