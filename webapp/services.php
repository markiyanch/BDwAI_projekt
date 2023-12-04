<html>
<head>
    <meta charset="utf-8">
    <title>Usługi</title>
</head>

<body>
    <h1>Usługi</h1>
    <a href='index.php'><- Strona główna</a><p>
    <a href='add_services.html'>+ Dodaj rekord</a> <a href='search_services.php'>? Wyszukaj rekordy</a>
    <?php
        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "services";

        $query = "SELECT * FROM $table";
        $result = sqlsrv_query($conn, $query);

        print "<table>";
        print "<tr>";
        print "<th>ID usługi</th>";
        print "<th>Nazwa usługi</th>";
        print "<th>Opis usługi</th>";
        print "<th>Akcje</th>";
        print "</tr>";

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            print "<tr><td>" . $row['service_id'] . "</td>";
            print "<td>" . $row['name'] . "</td>";
            print "<td>" . $row['description'] . "</td>";
            print "<td><a href='edit_services.php?service=" . $row['service_id'] . "'>Edytuj</a> | <a href='delete_services.php?service=" . $row['service_id'] . "'>Usuń</a></td></tr>";
        }
        print "</table>";

        sqlsrv_close($conn);
        die();
    ?>
</body>
</html>

