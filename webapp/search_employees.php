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
    print "<h1>Wyszukiwanie pracowników</h1>";
    print "<a href='employees.php'><- Pracownicy</a><p>";

    print "<form action='search_employees.php?query=" . $query . "'>";

    if ($query == '')
        $query = 'Podaj numer telefonu pracownika';

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

    $table = "employees";

    print "<table>";
    print "<tr>";
    print "<th>ID pracownika</th>";
    print "<th>Imię i nazwisko pracownika</th>";
    print "<th>Nazwa stanowiska</th>";
    print "<th>Numer telefonu</th>";
    print "<th>Wynagrodzenie</th>";
    print "<th>Edytuj</th>";
    print "<th>Usuń</th>";
    print "</tr>";

    if ($query != 'Podaj numer telefonu pracownika' && $query != '') {
        $query = str_replace("'", "''", $query); // Escape single quotes
        $query = str_replace("%", "", $query); // Remove % to prevent SQL injection

        $query = "SELECT * FROM $table WHERE phone_number LIKE '%$query%';";
        $result = sqlsrv_query($conn, $query);

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['employee_id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['job_title'] . "</td>";
            print "<td>" . $row['phone_number'] . "</td>";
            print "<td>" . $row['salary'] . "</td>";
            print "<td><a href='edit_employees.php?employee=" . $row['employee_id'] . "'>Edytuj</td>";
            print "<td><a href='delete_employees.php?employee=" . $row['employee_id'] . "'>Usuń</td></tr>";
        }
    }
    print "</table>";

    sqlsrv_close($conn);
    die();
    ?>
</body>
</html>

