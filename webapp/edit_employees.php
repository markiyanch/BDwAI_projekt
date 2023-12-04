<html>
<head>
    <meta charset="utf-8">
    <title>Pracownicy: edytuj</title>
</head>
<body>
    <?php
        print "<h1>Edytuj dane pracownika</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if (!$conn) {
            die(print_r(sqlsrv_errors(), true));
        }

        $employee = $_GET["employee"];

        $sql = "SELECT * FROM employees WHERE employee_id = ?;";
        $params = array($employee);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $employee_id = $row['employee_id'];
            $name = $row['name'];
            $job_title = $row['job_title'];
            $phone_number = $row['phone_number'];
            $salary = $row['salary'];
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        print "<form method='post' action='edited_employees.php'><br>";

        print "<input type='hidden' name='employee_id' value='$employee_id' size=30><p>";

        print "<b>Imię i nazwisko pracownika</b></p>";
        print "<input type='text' name='name' value='$name' size=30><p>";

        print "<b>Nazwa stanowiska</b></p>";
        print "<input type='text' name='job_title' value='$job_title' size=30><p>";

        print "<b>Numer telefonu</b></p>";
        print "<input type='text' name='phone_number' value='$phone_number' size=30><p>";

        print "<b>Wynagrodzenie</b></p>";
        print "<input type='text' name='salary' value='$salary' size=30><p>";

        print "<input type='submit' value='OK'><p></form>";
        print "<a href='employees.php'><- Pracownicy</a>";
    ?>
</body>
</html>

