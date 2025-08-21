<?php
//session_start();
//require "../controller/isLogin.php"?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Generate</title>
    <link rel="stylesheet" href="../public/css/bill.css">
    <script src="../public/js/jquery.js"></script>
</head>
<body>
    
<div class="openPrinting" id="openPrinting" style="display: flex">

<div id="printableArea">
    <div class="openPrinting-popup">
<div class="container">
    <div class="header">
        <h1>Medicine Bill</h1>
<!--        <p>Bill Number: --><?//php?><!--</p>-->
<div class="dateAndBillNo">
        <div class="date">Date: <?php echo date("Y-m-d")?></div>
        <div class="BillNo">Bill Number: <p> <?php echo(rand(100000,200000)); ?> </p> </div>
        </div>
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
                    <th>.</th>
                </tr>
                </thead>
                <tbody id="records"></tbody>


                <tfoot>
                <tr>
                    <td colspan="4" class="total">Gross Amount:</td>
                    <td class="total" id="gross"></td>
                </tr>
                <tr>
                    <td colspan="4" class="total">Discount Amount:</td>
                    <td class="total" id="discount"></td>
                </tr>
                <tr>
                    <td colspan="4" class="total">Total Amount:</td>
                    <td class="total" id="total"></td>
                </tr>

                </tfoot>
            </table>

            <div class="btn-group">
                <button class="btn"  type="button" onclick="printBill()"><i class="fa-solid fa-print"></i> Print</button>
                <button class="btn" type="button" onclick="saveBill()">Save Bill Without Print</button>
            </div>
        </form>
    </div>

            
</div>


    <div id="records"></div>

</div>
    </div>
</div>

<script>

    let batchNumberArr = [];

   const  deleteMedFromBill = (sid)=>{
        console.log(sid);
       $.ajax({
           url:'../controller/deleteFromBill.php',
           type:'POST',
           data:{id: sid},

       })
    }

    const loadRecord = ()=>{
        $.ajax({
            url:'../controller/getData.php',
            type:'GET',
            dataType:'json',
            success:(response)=>{
                // console.log(response);
                batchNumberArr.splice(0, batchNumberArr.length);

                let list = "";
                let gross = 0;
                let discount = 0;
                response.map((item,i)=>{
                    let id = i + 1;
                    // console.log(item);

                    batchNumberArr.push({bid:response[i].B_ID, quentity:response[i].QUANTITY });
                    // console.log(batchNumberArr);
                    // let soldId = response[i].S_ID;
                    let medName = response[i].MEDICINENAME;
                        let expDate = response[i].EXPIRYDATE;
                        let quantity = response[i].QUANTITY;
                        gross+= parseInt( response[i].MRP * response[i].QUANTITY);
                    let discountPercentage = parseInt(response[i].DISCOUNT);
                    let discountAmount =  discountPercentage * parseInt(response[i].MRP * response[i].QUANTITY) /100;
                    discount+= discountAmount;
                        let price = response[i].MRP;
                    list += '<tr><td>' + id + "</td><td>" + medName + "</td><td>" + expDate + "</td><td>" + quantity + "</td><td>" + price + `</td><td ><button onclick='deleteMedFromBill(${response[i].S_ID})' style="background-color: red; color: #ffffff; outline: none; border: none">X</button></td></tr>`;
                })

                // $('#soldId').html(list)
                $('#records').html(list);
                $('#gross').text(gross);
                $('#discount').text(discount);
                $('#total').text(()=>{
                    return gross - discount
                })
            }
        })
    }
    setInterval(loadRecord, 500);


    function postBill(callback){
        const payload = {
            patient_name: $('#patient-name').val(),
            contact_number: $('#contact-number').val(),
            address: $('#address').val(),
            payment_status: 'Paid',
            bill_no: $('.BillNo p').text().trim(),
            batchNumberArr: batchNumberArr
        };
        $.ajax({
            url:'../controller/saleFromBill.php',
            type:'POST',
            data: payload,
            success:(res)=>{ if(callback) callback(res); },
            error:()=>{ if(callback) callback(null); }
        });
    }

    const  printBill= async ()=> {
        postBill(()=>{
            window.print();
            document.querySelectorAll('.btn').forEach(btn => { btn.classList.add('hidden'); });
        });
    }

    const  saveBill= async ()=> {
        postBill(()=>{});
    }

    // function saveBill() {
    //     const patientName = document.getElementById('patient-name').value;
    //     const contactNumber = document.getElementById('contact-number').value;
    //     const address = document.getElementById('address').value;
    //
    //     const billData = {
    //         patientName,
    //         contactNumber,
    //         address,
    //         medicines: [
    //             {
    //                 name: 'Paracetamol',
    //                 expiryDate: '2024-03-08',
    //                 quantity: 10,
    //                 price: 100
    //             },
    //             {
    //                 name: 'Ibuprofen',
    //                 expiryDate: '2024-04-08',
    //                 quantity: 5,
    //                 price: 50
    //             },
    //             {
    //                 name: 'Azithromycin',
    //                 expiryDate: '2024-05-08',
    //                 quantity: 3,
    //                 price: 150
    //             }
    //         ]
    //     };
    //
    // }
</script>
</body>
</html>
