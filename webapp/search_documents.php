<html>
<head>
    <meta charset="utf-8">
    <?php
    $query = $_GET['query'];
    if ($query == '')
        print "    <title>Wyszukiwanie</title>";
    else
        print "    <title>$query - Wyszukiwanie</title>";
    ?>
</head>

<body>
    <?php
    print "<h1>Wyszukiwanie dokumentów</h1>";
    print "<a href='documents.php'><- Dokumenty</a><p>";

    print "<form action='search_documents.php?query=" . $query . "'>";

    if ($query == '')
        $query = 'Wprowadź nazwę dokumentu';

    print "<b>Wyszukiwanie</b><br><input name='query' value='$query' size=30>";

    print "<input type='submit' value='Wyszukaj'/>";
    print "</form>";

    $serverName = "COMMANDOVM";
    $connectionOptions = array(
        "Database" => "kancelaria_notarialna"
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $table = "documents";

    print "<table>";
    print "<tr>";
    print "<th>ID dokumentu</th>";
    print "<th>ID umowy</th>";
    print "<th>Nazwa dokumentu</th>";
    print "<th>Okres ważności dokumentu</th>";
    print "<th>Status wykonania</th>";
    print "<th>Edytuj</th>";
    print "<th>Usuń</th>";
    print "</tr>";

    if ($query != 'Wprowadź nazwę dokumentu' && $query != '') {
        $query = str_replace("'", "''", $query); // Escape single quotes
        $query = str_replace("%", "", $query); // Remove % to prevent SQL injection

        $query = "SELECT * FROM $table WHERE name LIKE '%$query%';";
        $result = sqlsrv_query($conn, $query);

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['document_id'] . "</td>";
            print "<td>" . $row['contract_id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['data'] . "</td>";
            print "<td>" . $row['status'] . "</td>";
            print "<td><a href='edit_documents.php?document=" . $row['document_id'] . "'>Edytuj</td>";
            print "<td><a href='delete_documents.php?document=" . $row['document_id'] . "'>Usuń</td></tr>";
        }
    }
    print "</table>";

    sqlsrv_close($conn);
    die();
    ?>
</body>
</html>

