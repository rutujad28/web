<!DOCTYPE html>
<html>
<head>
  <title>Electricity Bill Calculator</title>
  <style>
   body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
    }

    form {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"] {
      width: 60%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="number"] {
      width: 60%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 200px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .result {
      text-align: center;
      margin-top: 20px;
      padding: 10px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      border-radius: 4px;
    } 
  </style>
</head>
<body>
  <div class="container">
    <h1>Electricity Bill Calculator</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      <label for="mobile">Mobile Number:</label>
      <input type="number" id="mobile" name="mobile" required>
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required>
      <label for="billingunit">Billing Unit Number:</label>
      <input type="number" id="billingunit" name="billingunit" required>
      <label for="month">Month:</label>
      <input type="month" id="month" name="month" required>
      <label for="units">Enter Units Consumed:</label>
      <input type="number" id="units" name="units" required>
      <label for="payment">Payment Method:</label>
<select id="payment" name="payment" required>
  <option value="credit_card">Credit Card</option>
  <option value="debit_card">Debit Card</option>
  <option value="net_banking">Net Banking</option>
  <option value="upi">UPI</option>
  <option value="cash">Cash</option>
</select>
<br><br>
      <input type="submit" value="Calculate">
    </form>
    <div class="result">
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Electricity rates
        define('FIRST_50_UNITS_RATE', 3.50);
        define('NEXT_100_UNITS_RATE', 4.00);
        define('NEXT_100_UNITS_ABOVE_RATE', 5.20);
        define('ABOVE_250_UNITS_RATE', 6.50);

        // Get form data
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $month = $_POST['month'];
        $billingunit = $_POST['billingunit'];
        $payment = isset($_POST['payment']) ? $_POST['payment'] : 'Payment method is not defined';
        $units = (int)$_POST['units'];
        $currentDate = date('Y-m-d H:i:s');

        // Calculate the bill
        if ($units <= 50) {
          $bill = $units * FIRST_50_UNITS_RATE;
        } elseif ($units <= 150) {
          $bill = 50 * FIRST_50_UNITS_RATE + ($units - 50) * NEXT_100_UNITS_RATE;
        } elseif ($units <= 250) {
          $bill = 50 * FIRST_50_UNITS_RATE + 100 * NEXT_100_UNITS_RATE + ($units - 150) * NEXT_100_UNITS_ABOVE_RATE;
        } else {
          $bill = 50 * FIRST_50_UNITS_RATE + 100 * NEXT_100_UNITS_RATE + 100 * NEXT_100_UNITS_ABOVE_RATE + ($units - 250) * ABOVE_250_UNITS_RATE;
        }

        // Generate the bill content
        $billContent = "Name: $name\n";
        $billContent .= "Mobile Number: $mobile\n";
        $billContent .= "Address:$address\n";
        $billContent .= "Billing Unit Number: $billingunit\n\n";
        $billContent .= "Year and Month: $month\n\n";
        $billContent .= "Total Units Consumed: $units\n";
        // $billContent .= "Payment Method: $paymentMethod\n";
        $billContent .= "Total Bill Amount: Rs. " . number_format($bill, 2);
        $billContent .= "\n\nBill Generated On: $currentDate\n";

        // Save the bill to a file
        $filename = "electricity_bill.txt";
        file_put_contents($filename, $billContent);

        // Display the result and bill link
        echo "<p>Bill generated and saved as: <a href='$filename' download>Download Bill</a></p>";
      }
      ?>
    </div>
  </div>
</body>
</html>
