<html>
<head>
    <meta charset="utf-8">
    <title> Dokumenty: usuń</title>
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

        $table = "documents";

        $document_id = $_GET["document"];
        // Delete information from the database
        $sql = "DELETE FROM $table WHERE document_id = ?";
        $params = array($document_id);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Gotowe!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=documents.php'>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

