<html>
<head>
    <meta charset="utf-8">
    <title>Edytowano!</title>
</head>

<body>
    <?php
        $serverName = "COMMANDOVM";
        $connectionOptions = array(
            "Database" => "kancelaria_notarialna"
        );

        $table = "employees";
        $employee_id = $_POST['employee_id'];
        $name = $_POST['name'];
        $job_title = $_POST['job_title'];
        $phone_number = $_POST['phone_number'];
        $salary = $_POST['salary'];
        
        // Establish the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Update data in SQL Server
        $sql = "UPDATE $table SET name = ?, job_title = ?, phone_number = ?, salary = ? WHERE employee_id = ?";
        $params = array($name, $job_title, $phone_number, $salary, $employee_id);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        print "<b>Zrobione!</b><p>";
        print "<meta http-equiv='refresh' content='0; url=employees.php'>";

        // Close the connection
        sqlsrv_close($conn);
        die();
    ?>
</body>
</html>

