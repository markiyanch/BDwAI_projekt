<html>
<head>
    <meta charset="utf-8">
    <?php
    $query = $_GET['query'];
    if ($query == '')
        print "    <title>Szukaj</title>";
    else
        print "    <title>$query - Szukaj</title>";
    ?>
</head>

<body>
    <?php
    print "<h1>Wyszukiwanie klientów</h1>";
    print "<a href='clients.php'><- Klienci</a><p>";

    print "<form action='search_clients.php?query=" . $query . "'>";

    if ($query == '')
        $query = 'Wprowadź numer telefonu klienta';

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

    $table = "clients";

    print "<table>";
    print "<tr>";
    print "<th>ID klienta</th>";
    print "<th>Imię i nazwisko klienta</th>";
    print "<th>Rodzaj działalności</th>";
    print "<th>Adres</th>";
    print "<th>Numer telefonu</th>";
    print "<th>Edytuj</th>";
    print "<th>Usuń</th>";
    print "</tr>";

    if ($query != 'Wprowadź numer telefonu klienta' && $query != '') {
        $query = str_replace("'", "''", $query); // Escape single quotes
        $query = str_replace("%", "", $query); // Remove % to prevent SQL injection

        $query = "SELECT * FROM $table WHERE phone_number LIKE '%$query%';";
        $result = sqlsrv_query($conn, $query);

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['client_id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['activity_type'] . "</td>";
            print "<td>" . $row['address'] . "</td>";
            print "<td>" . $row['phone_number'] . "</td>";
            print "<td><a href='edit_clients.php?client=" . $row['client_id'] . "'>Edytuj</td>";
            print "<td><a href='delete_clients.php?client=" . $row['client_id'] . "'>Usuń</td></tr>";
        }
    }
    print "</table>";

    sqlsrv_close($conn);
    die();
    ?>
</body>
</html>

