<!doctype html>
<html>

<head>
    <title>Delete a record of a table</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <h1> Welcome to H&M PHP MySQ Database</h1>
    <?php
    $servername = "localhost";
    $dbname = "HnM";
    $username = "root";
    $password = "";

    /* Try MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password).
If the connection was tried and it was successful the code between braces after try is executed, if any error happened while running the code in try-block, 
the code in catch-block is executed. */
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green'>Connection Was Successful</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'> Connection Failed: " . $err->getMessage() . "</p>\r\n";
    }

    try {
        $sql = "DELETE FROM " . $dbname . ".Employee WHERE EmployeeID = :eID";
        $stmnt = $conn->prepare($sql);     // read about prepared statement here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmnt->bindParam(':eID', $_POST['eID']);   // :stdId is the variable that we used in $sql, there must be a colon (:) in front of it.
        //  stdId in $_POST['stdId'] is the name of the element in HTML Form. Make sure it matches exactly the name of the form element in HTML 

        $stmnt->execute();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='color:green'>Record Deleted Successfully</p>";
    } catch (PDOException $err) {
        echo "<p style='color:red'>Record Delete Failed: " . $err->getMessage() . "</p>\r\n";
    }
    // Close connection
    unset($conn);

    echo "<a href='../index.html'>Back to the homepage</a>";

    ?>

</body>

</html>