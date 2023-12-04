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
    print "<h1>Wyszukiwanie umów</h1>";
    print "<a href='contracts.php'><- Umowy</a><p>";

    print "<form action='search_contracts.php?query=" . $query . "'>";

    if ($query == '')
        $query = 'Wprowadź cenę umowy';

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

    $table = "contracts";

    print "<table>";
    print "<tr>";
    print "<th>ID umowy</th>";
    print "<th>ID klienta</th>";
    print "<th>ID usługi</th>";
    print "<th>ID pracownika</th>";
    print "<th>Cena umowy</th>";
    print "<th>Dodatkowy komentarz</th>";
    print "<th>Edytuj</th>";
    print "<th>Usuń</th>";
    print "</tr>";

    if ($query != 'Wprowadź cenę umowy' && $query != '') {
        $query = str_replace("'", "''", $query); // Escape single quotes
        $query = str_replace("%", "", $query); // Remove % to prevent SQL injection

        $query = "SELECT * FROM $table WHERE price LIKE '%$query%';";
        $result = sqlsrv_query($conn, $query);

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['contract_id'] . "</td>";
            print "<td>" . $row['client_id'] . "</td>";
            print "<td>" . $row['service_id'] . "</td>";
            print "<td>" . $row['employee_id'] . "</td>";
            print "<td>" . $row['price'] . "</td>";
            print "<td>" . $row['comment'] . "</td>";
            print "<td><a href='edit_contracts.php?contract=" . $row['contract_id'] . "'>Edytuj</td>";
            print "<td><a href='delete_contracts.php?contract=" . $row['contract_id'] . "'>Usuń</td></tr>";
        }
    }
    print "</table>";

    sqlsrv_close($conn);
    die();
    ?>
</body>
</html>

