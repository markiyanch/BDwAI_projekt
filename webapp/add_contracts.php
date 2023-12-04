<html>
<head>
    <meta charset="utf-8">
    <title>Dodaj umowę</title>
</head>

<body>
    <?php
        print "<h1>Dodaj rekord umowy</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        // Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "contracts";

        $sql = "SELECT MAX(contract_id) AS MaxContractID FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $id = $row['MaxContractID'] + 1;
        }

        $client_id = $_POST['client_id'];
        $service_id = $_POST['service_id'];
        $employee_id = $_POST['employee_id'];
        $price = $_POST['price'];
        $comment = $_POST['comment'];

        $sqlInsert = "INSERT INTO $table VALUES (?, ?, ?, ?, ?, ?)";
        $params = array($id, $client_id, $service_id, $employee_id, $price, $comment);
        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $params);

        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Zrobione!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=contracts.php'>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

