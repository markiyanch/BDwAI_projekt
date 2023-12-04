<html>
<head>
    <meta charset="utf-8">
    <title>Dokumenty: edytuj</title>
</head>
<body>
    <?php
        print "<h1>Edytuj rekord dokumentu</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $table = "documents";
        $document = $_GET["document"];
        
        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Retrieve data from SQL Server
        $sql = "SELECT * FROM $table WHERE document_id = ?";
        $params = array($document);
        $stmt = sqlsrv_query($conn, $sql, $params);

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $document_id = $row['document_id'];
            $name = $row['name'];
            $data = $row['data'];
            $status = $row['status'];
            $contract_id = $row['contract_id'];
        }

        print "<form method='post' action='edited_documents.php'><br>";

        print "<input type='hidden' name='document_id' value='$document_id' size=30><p>";

        print "<b>ID umowy</b></p>";
        print "<input type='text' name='contract_id' value='$contract_id' size=30><p>";

        print "<b>Nazwa dokumentu</b></p>";
        print "<input type='text' name='name' value='$name' size=30><p>";

        print "<b>Termin ważności dokumentu</b></p>";
        print "<input type='text' name='data' value='$data' size=30><p>";

        print "<b>Status wykonania</b></p>";
        print "<input type='text' name='status' value='$status' size=30><p>";

        print "<input type='submit' value='OK'><p></form>";
        print "<a href='documents.php'><- Dokumenty</a>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

