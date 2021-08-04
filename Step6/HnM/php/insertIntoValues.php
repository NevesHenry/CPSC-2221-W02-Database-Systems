<!doctype html>
<html>
<head>
	<title>Insert Data Into a Database</title>
	<link rel="stylesheet" href="../css/style.css" />
</head>
<body>

<?php
$servername ="localhost";
$dbname = "HnM";
$username = "root";
$password = "";

/* Try MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password).
If the connection was tried and it was successful the code between braces after try is executed, if any error happened while running the code in try-block, 
the code in catch-block is executed. */
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<p style='color:green'>Connection Was Successful</p>";
}
catch (PDOException $err) {
	echo "<p style='color:red'>Connection Failed: " . $err->getMessage() . "</p>\r\n";
}


try {
	$sql="INSERT INTO Business (BusinessID, BusinessAddress, NumOfAddresses, BusinessName, CostAndFees, BusinessServices, NumOfCustomers) VALUES (:bID, :bAddr,:NumOfAddr, :bname, :cost, :services, :customers);";   // all the names variable names must start with colon (:)
	$stmnt = $conn->prepare($sql);    				// read about prepared statement here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
	$stmnt->bindParam(':bID', $_POST['bID']);   	// :bID in $_POST[':bID'] in the exact name of the input element in HTML. if any typo, your code does not work   
	$stmnt->bindParam(':bAddr', $_POST['bAddr']);   // note the single quotes, If you foregt to put single quotes, your code does not work.
	$stmnt->bindParam(':NumOfAddr', $_POST['NumOfAddr']);
	$stmnt->bindParam(':bname', $_POST['bname']);
	$stmnt->bindParam(':cost', $_POST['cost']);
	$stmnt->bindParam(':services', $_POST['services']);
	$stmnt->bindParam(':customers', $_POST['customers']);

	$stmnt->execute();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<p style='color:green'>Data Inserted Into Table Successfully</p>";
}
catch (PDOException $err ) {
	echo "<p style='color:red'>Data Insertion Failed: " . $err->getMessage() . "</p>\r\n";
}
// Close connection
unset($conn);

echo "<a href='../insertData.html'>Insert More Values</a> <br />";

echo "<a href='../index.html'>Back to the homepage</a>";

?>

</body>
</html>