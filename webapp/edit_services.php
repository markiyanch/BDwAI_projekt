<html>
<head>
    <meta charset="utf-8">
    <title>Usługi: edytuj</title>
</head>
<body>
    <?php
        print "<h1>Edytuj usługę</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if (!$conn) {
            die(print_r(sqlsrv_errors(), true));
        }

        $service = $_GET["service"];

        $sql = "SELECT * FROM services WHERE service_id = ?;";
        $params = array($service);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $service_id = $row['service_id'];
            $name = $row['name'];
            $description = $row['description'];
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        print "<form method='post' action='edited_services.php'><br>";

        print "<input type='hidden' name='service_id' value='$service_id' size=30><p>";

        print "<b>Nazwa usługi</b></p>";
        print "<input type='text' name='name' value='$name' size=30><p>";

        print "<b>Opis usługi</b></p>";
        print "<input type='text' name='description' value='$description' size=30><p>";

        print "<input type='submit' value='OK'><p></form>";
        print "<a href='services.php'><- Usługi</a>";
    ?>
</body>
</html>

