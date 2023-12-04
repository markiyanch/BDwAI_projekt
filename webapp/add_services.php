<html>
<head>
    <meta charset="utf-8">
    <title>Dodaj usługę</title>
</head>

<body>
    <?php
        print "<h1>Dodaj rekord usługi</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        // Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "services";

        $sql = "SELECT MAX(service_id) AS MaxServiceID FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $id = $row['MaxServiceID'] + 1;
        }

        $name = $_POST['name'];
        $description = $_POST['description'];

        $sqlInsert = "INSERT INTO $table VALUES (?, ?, ?)";
        $params = array($id, $name, $description);
        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $params);

        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Zrobione!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=services.php'>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

