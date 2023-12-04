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

        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "services";

        $service_id = $_POST['service_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $query = "UPDATE $table SET name = ?, description = ? WHERE service_id = ?";
        $params = array($name, $description, $service_id);

        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Zrobione!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=services.php'>";

        sqlsrv_close($conn);
        die();
    ?>
</body>
</html>

