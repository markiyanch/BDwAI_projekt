<html>
<head>
    <meta charset="utf-8">
    <title>Zedytowano!</title>
</head>

<body>
    <?php
        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "notarialna_ustanova"
        );

        $table = "documents";
        $document_id = $_POST['document_id'];
        $contract_id = $_POST['contract_id'];
        $name = $_POST['name'];
        $data = $_POST['data'];
        $status = $_POST['status'];
        
        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Update data in SQL Server
        $sql = "UPDATE $table SET name = ?, contract_id = ?, data = ?, status = ? WHERE document_id = ?";
        $params = array($name, $contract_id, $data, $status, $document_id);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Gotowe!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=documents.php'>";

        // Close the connection
        sqlsrv_close($conn);
        die();
    ?>
</body>
</html>

