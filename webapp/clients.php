<html>
<head>
    <meta charset="utf-8">
    <title>Klienci</title>
</head>

<body>
    <h1>Klienci</h1>
    <a href='index.php'><- Strona główna</a><p>
    <a href='add_clients.html'>+ Dodaj wpis</a> <a href='search_clients.php'>? Szukaj wpisów</a>
    <?php
        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "clients";

        $sql = "SELECT * FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

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

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['client_id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['activity_type'] . "</td>";
            print "<td>" . $row['address'] . "</td>";
            print "<td>" . $row['phone_number'] . "</td>";
            print "<td><a href='edit_clients.php?client=" . $row['client_id'] . "'>Edytuj</td>";
            print "<td><a href='delete_clients.php?client=" . $row['client_id'] . "'>Usuń</td></tr>";
        }

        print "</table>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

