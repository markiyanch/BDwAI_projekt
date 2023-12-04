<html>
<head>
    <meta charset="utf-8">
    <title>Umowy: edytuj</title>
</head>
<body>
    <?php
        print "<h1>Edytuj rekord umowy</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $table = "contracts";
        $contract = $_GET["contract"];
        
        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Retrieve data from SQL Server
        $sql = "SELECT * FROM $table WHERE contract_id = ?";
        $params = array($contract);
        $stmt = sqlsrv_query($conn, $sql, $params);

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $client_id = $row['client_id'];
            $service_id = $row['service_id'];
            $employee_id = $row['employee_id'];
            $price = $row['price'];
            $comment = $row['comment'];
        }

        print "<form method='post' action='edited_contracts.php'><br>";

        print "<input type='hidden' name='contract_id' value='$contract_id' size=30><p>";

        print "<b>ID klienta</b></p>";
        print "<input type='text' name='client_id' value='$client_id' size=30><p>";

        print "<b>ID usługi</b></p>";
        print "<input type='text' name='service_id' value='$service_id' size=30><p>";

        print "<b>ID pracownika</b></p>";
        print "<input type='text' name='employee_id' value='$employee_id' size=30><p>";

        print "<b>Kwota umowy</b></p>";
        print "<input type='text' name='price' value='$price' size=30><p>";

        print "<b>Dodatkowy komentarz</b></p>";
        print "<input type='text' name='comment' value='$comment' size=30><p>";

        print "<input type='submit' value='OK'><p></form>";
        print "<a href='contracts.php'><- Umowy</a>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

