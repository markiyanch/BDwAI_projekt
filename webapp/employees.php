<html>
<head>
    <meta charset="utf-8">
    <title>Pracownicy</title>
</head>

<body>
    <h1>Pracownicy</h1>
    <a href='index.php'><- Strona główna</a><p>
    <a href='add_employees.html'>+ Dodaj wpis</a> <a href='search_employees.php'>? Wyszukaj wpisy</a>

    <?php
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
        print "<th>Imię i nazwisko</th>";
        print "<th>Nazwa stanowiska</th>";
        print "<th>Numer telefonu</th>";
        print "<th>Wynagrodzenie</th>";
        print "<th>Edytuj</th>";
        print "<th>Usuń</th>";
        print "</tr>";

        $query = "SELECT * FROM $table";
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

        print "</table>";

        sqlsrv_close($conn);
    ?>
</body>
</html>

