<html>
<head>
    <meta charset="utf-8">
    <title>Dodaj klienta</title>
</head>

<body>
    <?php
        print "<h1>Dodaj rekord klienta</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        // Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "clients";

        $sql = "SELECT MAX(client_id) AS MaxClientID FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $id = $row['MaxClientID'] + 1;
        }

        $name = $_POST['name'];
        $activity_type = $_POST['activity_type'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];

        $sqlInsert = "INSERT INTO $table VALUES (?, ?, ?, ?, ?)";
        $params = array($id, $name, $activity_type, $address, $phone_number);
        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $params);

        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Zrobione!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=clients.php'>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

