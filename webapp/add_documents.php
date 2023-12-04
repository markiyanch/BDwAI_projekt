<html>
<head>
    <meta charset="utf-8">
    <title>Dodaj dokument</title>
</head>

<body>
    <?php
        print "<h1>Dodaj rekord dokumentu</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        // Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "documents";

        $sql = "SELECT MAX(document_id) AS MaxDocumentID FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $id = $row['MaxDocumentID'] + 1;
        }

        $contract_id = $_POST['contract_id'];
        $name = $_POST['name'];
        $data = $_POST['data'];
        $status = $_POST['status'];

        $sqlInsert = "INSERT INTO $table VALUES (?, ?, ?, ?, ?)";
        $params = array($id, $contract_id, $name, $data, $status);
        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $params);

        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Zrobione!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=documents.php'>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

