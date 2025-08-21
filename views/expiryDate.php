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
    <title>Expired Stock</title>
    <link rel="stylesheet" href="../public/css/expiryDate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>

<header>
    <h1>Expiry Date</h1>

</header>
<div id="existMedicine">
    <?php if (isset($_GET['delete']) && $_GET['delete'] == '1') {?>
        <p class="success-color">Deleted Successfully.</p>
    <?php }?>
    <?php if (isset($_GET['delete']) && $_GET['delete'] == '0') {?>
        <p class="failed-color">Failed to delete</p>
    <?php }?>

</div>


<div class="low-stockBody" id="low-stockBody">
    <div class="low-stock">

        <table>


            <thead>
            <tr class="">
                <th>ID</th>
                <th>Name</th>
                <th>Batch Number</th>
                <th>Expiry Date</th>
                <th>Remaining Quantity</th>
                <th>Actions</th>
            </tr>
            </thead>
            <?php
            if ($doneExpiryDate->num_rows > 0) {
                while ($row = $doneExpiryDate->fetch_assoc()){

                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php  echo $row['MEDICINENAME'] ?></td>
                        <td><?php echo $row['BATCHNUMBER'] ?></td>
                        <td class="dateExpiry"><?php echo $row['EXPIRYDATE'] ?></td>
                        <td><?php echo $row['QUANTITY'] ?></td>



                        <td>
                            <div class="actionButton">
                                <form action="../controller/DeleteBatch.php" method="post">
                                    <input type="hidden" name="ID" value="<?php echo  $row['SN']?>">
                                    <button type="submit" class="takeOut"> Take Out <i class="fa-solid fa-arrow-right-from-bracket"> </i></button>
                                </form>
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

</body>
</html>
