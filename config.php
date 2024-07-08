<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else{
        echo "<h1>Connected to the server</h1>";
    }

    // create database
    $sql = "CREATE DATABASE school_db";
    if ($conn->query($sql) === TRUE) {
        $db_name = "school_db";
        echo "<h1>Database created successfully</h1>";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    // Connect to the database
    $conn->select_db($db_name);

    // create table new_admission
    $create_table_admission = "
    CREATE TABLE IF NOT EXISTS new_admission (
    ID int PRIMARY KEY AUTO_INCREMENT,
    NAME varchar(50) NOT NULL,
    EMAIL varchar(50) NOT NULL,
    PASSWORD varchar(50) NOT NULL,
    PHONE varchar(50) NOT NULL,
    DOB varchar(50) NOT NULL,
    GENDER varchar(10) NOT NULL,
    SENIOR_QUAL varchar(50) NOT NULL,
    HIGHER_QUAL varchar(50) NOT NULL,
    COURSE varchar(50) NOT NULL,
    STATUS int DEFAULT NULL,
    ADRESS_1 varchar(50) NOT NULL,
    ADRESS_2 varchar(50) NOT NULL,
    COUNTRY varchar(50) NOT NULL,
    CITY varchar(50) NOT NULL,
    REGION varchar(50) NOT NULL,
    PINCODE varchar(50) NOT NULL
    );
    ";

    if(mysqli_query($conn, $create_table_admission)){
        echo "<h1>Admission Table created successfully</h1>";
    }else{
        echo mysqli_error($conn);
    }

    // create table new_staff
    $create_table_staff = "
    CREATE TABLE IF NOT EXISTS new_staff (
    ID int PRIMARY KEY AUTO_INCREMENT,
    NAME varchar(50) NOT NULL,
    EMAIL varchar(50) NOT NULL,
    PASSWORD varchar(50) NOT NULL,
    PHONE varchar(50) NOT NULL,
    DOB varchar(50) NOT NULL,
    GENDER varchar(10) NOT NULL,
    SENIOR_QUAL varchar(50) NOT NULL,
    HIGHER_QUAL varchar(50) NOT NULL,
    SUBJECTS json NOT NULL,
    ADRESS_1 varchar(50) NOT NULL,
    ADRESS_2 varchar(50) NOT NULL,
    COUNTRY varchar(50) NOT NULL,
    CITY varchar(50) NOT NULL,
    REGION varchar(50) NOT NULL,
    PINCODE varchar(50) NOT NULL
    );
    ";

    if(mysqli_query($conn, $create_table_staff)){
        echo "<h1>Staff Table created successfully</h1>";
    }else{
        echo mysqli_error($conn);
    }

    // create table admin_credentials
    $create_table_admin = "
    CREATE TABLE IF NOT EXISTS admin_credentials (
    ID int PRIMARY KEY AUTO_INCREMENT,
    NAME varchar(50) NOT NULL,
    EMAIL varchar(50) NOT NULL,
    PASSWORD varchar(50) NOT NULL,
    IMAGE varchar(255) DEFAULT NULL
    );
    ";

    if(mysqli_query($conn, $create_table_admin)){
        echo "<h1>Admin Table created successfully</h1>";
    }else{
        echo mysqli_error($conn);
    }

    $register_admin = "
    INSERT INTO admin_credentials (NAME, EMAIL, PASSWORD) VALUES
    ('Hemant Zuceed', 'hemant@gmail.com', 'hemant123');
    ";

    if(mysqli_query($conn, $register_admin)){
        echo "<h1>Admin Registered successfully</h1>";
    }else{
        echo mysqli_error($conn);
    }

    echo "<h1>Everything is done.....</h1>";
    mysqli_close($conn);
?>