<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table DateBase</title>
</head>
<body>

<h2>Table DateBase</h2>

<table border="1">
    <tr>
        <td>FirstName</td>
        <td>SecondName</td>
        <td>Status</td>
    </tr>
    <?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'users_db';

    $conn = new mysqli($server, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connect Error: ' . $conn->connect_error);
    }

    $select = "SELECT * FROM users";
    $result = $conn->query($select);

    if (!$result) {
        die('Query Error: ' . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['firstname']}</td>
                <td>{$row['secondname']}</td>
                <td>{$row['status']}</td>
            </tr>";
    }

    $conn->close();
    ?>
</table>

</body>
</html>
