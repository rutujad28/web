<html>
<head>
<style>
    #box {
        width: 350px;
        height: 270px;
        margin: 0px auto;
        border: 2px solid black;
    }

    h2 {
        text-align: center;
    }

    table {
        margin: 0px auto;
    }
</style>
<script>
    function validateForm() {
        var amount = document.forms["converterForm"]["amount"].value;

        if (amount == "") {
            alert("Please enter the amount");
            return false;
        }
    }
</script>
</head>

<body>

<form align="center" name="converterForm" action="currency_converter.php" method="post" onsubmit="return validateForm()">

<div id="box">
<h2><center>Currency Converter</center></h2>
<table>
    <tr>
        <td>
            Enter Amount:<input type="text" name="amount"><br>
        </td>
    </tr>
    <tr>
        <td>
            <br><center>From:<select name='cur1'>
            <option value="Select" selected>Select</option>
            <option value="USD">US Dollar(USD)</option>
            <option value="INR">Indian Rupee(INR)</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <br><center>To:<select name='cur2'>
            <option value="Select" selected>Select</option>
            <option value="INR">Indian Rupee(INR)</option>
            <option value="USD">US Dollar(USD)</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><center><br>
        <input type='submit' name='submit' value="Convert Now"></center>
        </td>
    </tr>
</table>
</form>

<?php
if(isset($_POST['submit'])){
	
$amount = $_POST['amount'];
$cur1 = $_POST['cur1'];
$cur2 = $_POST['cur2'];

if($cur1=="USD" AND $cur2=="INR"){
echo "<center><b>Your Converted Amount is:</b><br></center>";
echo "<center>" . $amount*83.33 . "</center>";
}

if($cur1=="USD" AND $cur2=="USD"){
echo "<center><b>Your Converted Amount is:</b><br></center>";
echo "<center>" . $amount . "</center>";
}

if($cur1=="INR" AND $cur2=="USD"){
echo "<center><b>Your Converted Amount is:</b><br></center>";
echo "<center>" . $amount*0.012 . "</center>";
}

if($cur1=="INR" AND $cur2=="INR"){
echo "<center><b>Your Converted Amount is:</b><br></center>";
echo "<center>" . $amount . "</center>";
}

if($cur1=="USD" AND $cur2=="Select"){
echo "<center><b>Error : Select Correct Options</b><br></center>";
} 

if($cur1=="INR" AND $cur2=="Select"){
echo "<center><b>Error : Select Correct Options</b><br></center>";
}

if($cur1=="Select" AND $cur2=="USD"){
echo "<center><b>Error : Select Correct Options</b><br></center>";
}

if($cur1=="Select" AND $cur2=="INR"){
echo "<center><b>Error : Select Correct Options</b><br></center>";
}

if($cur1=="Select" AND $cur2=="Select"){
echo "<center><b>Error : Select Correct Options</b><br></center>";
}



}

?>

</body>
</html>