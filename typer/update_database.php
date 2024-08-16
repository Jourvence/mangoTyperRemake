<?php
if (isset($_POST['data1']) && isset($_POST['data2'])) {
    $speed = $_POST['data1'];
    $dbNick = $_POST['data2'];

    error_log("Speed: $speed, Username: $dbNick");
    

    // Database connection (replace with your actual database credentials)
    $host = 'localhost';
    $dbname = 'myfirstdatabase';
    $dbusername = 'root';
    $dbpassword = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // SQL query to update the database
    $sql = "UPDATE users SET speed = :speed WHERE username = :username";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':speed', $speed);
        $stmt->bindParam(':username', $dbNick);
        $stmt->execute();

        echo "Record updated successfully";
    } catch (PDOException $e) {
        echo "Error updating record: " . $e->getMessage();
    }

    // Close the connection
    $pdo = null;
}
