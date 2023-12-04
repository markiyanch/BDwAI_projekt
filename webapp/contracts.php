<html>
<head>
    <meta charset="utf-8">
    <title>Umowy</title>
</head>

<body>
    <h1>Umowy</h1>
    <a href='index.php'><- Strona główna</a><p>
    <a href='add_contracts.html'>+ Dodaj wpis</a> <a href='search_contracts.php'>? Szukaj wpisów</a>
    <?php
        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "contracts";

        $sql = "SELECT * FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<table>";
        print "<tr>";
        print "<th>ID umowy</th>";
        print "<th>ID klienta</th>";
        print "<th>ID usługi</th>";
        print "<th>ID pracownika</th>";
        print "<th>Kwota umowy</th>";
        print "<th>Dodatkowy komentarz</th>";
        print "<th>Edytuj</th>";
        print "<th>Usuń</th>";
        print "</tr>";

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['contract_id'] . "</td>";
            print "<td>" . $row['client_id'] . "</td>";
            print "<td>" . $row['service_id'] . "</td>";
            print "<td>" . $row['employee_id'] . "</td>";
            print "<td>" . $row['price'] . "</td>";
            print "<td>" . $row['comment'] . "</td>";
            print "<td><a href='edit_contracts.php?contract=" . $row['contract_id'] . "'>Edytuj</td>";
            print "<td><a href='delete_contracts.php?contract=" . $row['contract_id'] . "'>Usuń</td></tr>";
        }

        print "</table>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

