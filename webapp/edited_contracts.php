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

        $table = "contracts";
        $contract_id = $_POST['contract_id'];
        $client_id = $_POST['client_id'];
        $service_id = $_POST['service_id'];
        $employee_id = $_POST['employee_id'];
        $price = $_POST['price'];
        $comment = $_POST['comment'];
        
        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Update data in SQL Server
        $sql = "UPDATE $table SET client_id = ?, service_id = ?, employee_id = ?, price = ?, comment = ? WHERE contract_id = ?";
        $params = array($client_id, $service_id, $employee_id, $price, $comment, $contract_id);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Gotowe!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=contracts.php'>";

        // Close the connection
        sqlsrv_close($conn);
        die();
    ?>
</body>
</html>

