<?php session_start();?>
<?php require "../controller/isLogin.php";
require "../controller/totalMedicine-data.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../public/css/totalMedicine.css">
</head>
<body>

<header>
    <h1>Total Medicine</h1>
</header>

<div class="container">
    <input type="text" id="searchInput" placeholder="Search Medicine" onchange="searchMedicine()">
    <input type="submit" value="Search" onclick="searchMedicine()">


    <table id="medicineTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Batch Number</th>
            <th>Expiry Date</th>
            <th>Remaining Quantity</th>
            <th>Price </th>
        </tr>
        </thead>
        <?php
            if ($done-> num_rows > 0){
                while ($row = $done->fetch_assoc()){

                    ?>
                        <tr>
                        <td><?php echo $i?></td>
                        <td><?php  echo $row['MEDICINENAME'] ?></td>
                        <td><?php echo $row['COMPANYNAME'] ?></td>
                                <td><?php echo $row['BATCHNUMBER'] ?></td>
                            <td><?php echo $row['EXPIRYDATE'] ?></td>
                            <td><?php echo $row['QUANTITY'] ?></td>
                            <td><?php echo $row['MRP'] ?></td>
                      </tr>

            <?php   $i++; }  }?>
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

        <!-- Output the page numbers ---->
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

<script>

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



