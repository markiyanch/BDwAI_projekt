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
    print "<h1>Wyszukiwanie klientów</h1>";
    print "<a href='services.php'><- Klienci</a><p>";

    print "<form action='search_services.php?query=" . $query . "'>";

    if ($query == '')
        $query = 'Wprowadź nazwę usługi';

    print "<b>Wyszukiwanie</b><br><input name='query' value='$query' size=30>";

    print "<input type='submit' value='Wyszukaj'/>";
    print "</form>";

    $serverName = "COMMANDOVM";
    $connectionOptions = array(
        "Database" => "notarialna_ustanova"
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $table = "services";

    print "<table>";
    print "<tr>";
    print "<th>ID klienta</th>";
    print "<th>Nazwa usługi</th>";
    print "<th>Opis usługi</th>";
    print "<th>Edytuj</th>";
    print "<th>Usuń</th>";
    print "</tr>";

    if ($query != 'Wprowadź nazwę usługi' && $query != '') {
        $query = str_replace("'", "''", $query); // Escape single quotes
        $query = str_replace("%", "", $query); // Remove % to prevent SQL injection

        $query = "SELECT * FROM $table WHERE name LIKE '%$query%';";
        $result = sqlsrv_query($conn, $query);

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['description'] . "</td>";
            print "<td><a href='edit_services.php?service=" . $row['id'] . "'>Edytuj</td>";
            print "<td><a href='delete_services.php?service=" . $row['id'] . "'>Usuń</td></tr>";
        }
    }
    print "</table>";

    sqlsrv_close($conn);
    die();
    ?>
</body>
</html>

