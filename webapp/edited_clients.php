<html>
<head>
    <meta charset="utf-8">
    <title>Zedytowano!</title>
</head>

<body>
    <?php
        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $table = "clients";
        $client_id = $_POST['client_id'];
        $name = $_POST['name'];
        $activity_type = $_POST['activity_type'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        
        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Update data in SQL Server
        $sql = "UPDATE $table SET name = ?, activity_type = ?, address = ?, phone_number = ? WHERE client_id = ?";
        $params = array($name, $activity_type, $address, $phone_number, $client_id);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Gotowe!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=clients.php'>";

        // Close the connection
        sqlsrv_close($conn);
        die();
    ?>
</body>
</html>

