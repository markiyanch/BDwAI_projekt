<html>
<head>
    <meta charset="utf-8">
    <title>Dokumenty</title>
</head>

<body>
    <h1>Dokumenty</h1>
    <a href='index.php'><- Strona główna</a><p>
    <a href='add_documents.html'>+ Dodaj rekord</a> <a href='search_documents.php'>? Wyszukaj rekordy</a>
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

        print "<table>";
        print "<tr>";
        print "<th>ID dokumentu</th>";
        print "<th>Identyfikator umowy</th>";
        print "<th>Nazwa dokumentu</th>";
        print "<th>Termin ważności dokumentu</th>";
        print "<th>Status wykonania</th>";
        print "<th>Edytuj</th>";
        print "<th>Usuń</th>";
        print "</tr>";

        // Retrieve data from SQL Server
        $sql = "SELECT * FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['document_id'] . "</td>";
            print "<td>" . $row['contract_id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['data']->format('Y-m-d H:i:s') . "</td>";
            print "<td>" . $row['status'] . "</td>";
            print "<td><a href='edit_documents.php?document=" . $row['document_id'] . "'>Edytuj</td>";
            print "<td><a href='delete_documents.php?document=" . $row['document_id'] . "'>Usuń</td></tr>";
        }

        print "</table>";

        // Close the connection
        sqlsrv_close($conn);
        die();
    ?>
</body>
</html>

