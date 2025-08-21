<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Bill</title>
    <link rel="stylesheet" href="../public/css/printBill.css">
</head>
<body>
<!--<div class="openPrinting" id="openPrinting" style="display: none">-->
    <div class="openPrinting" id="openPrinting">
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

                        <label class="form-label" for="contact-number">Contact Number:</label>
                        <input class="form-input" type="text" id="contact-number" required>

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
        <script>
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
        </script>

</body>
</html>