<html>
<head>
    <meta charset="utf-8">
    <title>Dodaj pracownika</title>
</head>

<body>
    <?php
        print "<h1>Dodaj rekord pracownika</h1>";

        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        // Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $table = "employees";

        $sql = "SELECT MAX(employee_id) AS MaxEmployeeID FROM $table";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $id = $row['MaxEmployeeID'] + 1;
        }

        $name = $_POST['name'];
        $job_title = $_POST['job_title'];
        $phone_number = $_POST['phone_number'];
        $salary = $_POST['salary'];

        $sqlInsert = "INSERT INTO $table VALUES (?, ?, ?, ?, ?)";
        $params = array($id, $name, $job_title, $phone_number, $salary);
        $stmtInsert = sqlsrv_query($conn, $sqlInsert, $params);

        if ($stmtInsert === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Zrobione!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=employees.php'>";

        // Close the connection
        sqlsrv_close($conn);
    ?>
</body>
</html>

