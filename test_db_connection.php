<?php
// Simple database connection test
// Run this with: php test_db_connection.php

try {
    $host = "localhost"; // Change this to your DB host
<<<<<<< HEAD
    $dbname = "alkaproi_smpalk"; // Change this to your DB name
    $username = "alkaproi_smpalk"; // Change this to your DB username
=======
    $dbname = "raphnesi_smpalk"; // Change this to your DB name
    $username = "raphnesi_smpalk"; // Change this to your DB username
>>>>>>> 01cf9e1bd0b1c9f8e46d93c6fdb38a4008df2eeb
    $password = "YOUR_PASSWORD_HERE"; // Change this to your actual password
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful!\n";
    
    // Check if alkapro_library_settings table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'alkapro_library_settings'");
    if ($stmt->rowCount() > 0) {
        echo "✅ alkapro_library_settings table exists\n";
    } else {
        echo "❌ alkapro_library_settings table does not exist - run migration\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "Please check your database credentials and server status.\n";
}
