<html>
<head>
    <meta charset="utf-8">
    <title>Klienci: edytuj</title>
</head>
<body>
    <?php
        print "<h1>Edytuj rekord klienta</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $table = "clients";
        $client = $_GET["client"];
        
        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Retrieve data from SQL Server
        $sql = "SELECT * FROM $table WHERE client_id = ?";
        $params = array($client);
        $stmt = sqlsrv_query($conn, $sql, $params);

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $client_id = $row['client_id'];
            $name = $row['name'];
            $activity_type = $row['activity_type'];
            $address = $row['address'];
            $phone_number = $row['phone_number'];
        }

        print "<form method='post' action='edited_clients.php'><br>";

        print "<input type='hidden' name='client_id' value='$client_id' size=30><p>";

        print "<b>Imię i nazwisko klienta</b></p>";
        print "<input type='text' name='name' value='$name' size=30><p>";

        print "<b>Rodzaj działalności</b></p>";
        print "<input type='text' name='activity_type' value='$activity_type' size=30><p>";

        print "<b>Adres</b></p>";
        print "<input type='text' name='address' value='$address' size=30><p>";

        print "<b>Numer telefonu</b></p>";
        print "<input type='text' name='phone_number' value='$phone_number' size=30><p>";

        print "<input type='submit' value='OK'><p></form>";
        print "<a href='clients.php'><- Klienci</a>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

