<html>
<head>
    <meta charset="utf-8">
    <title> Klienci: usuń</title>
</head>

<body>
    <?php
        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "clients";

        $client_id = $_GET["client"];
        // Delete information from the database
        $sql = "DELETE FROM $table WHERE client_id = ?";
        $params = array($client_id);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Gotowe!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=clients.php'>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

