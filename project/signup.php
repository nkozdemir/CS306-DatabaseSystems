<?php

    include "config.php";

    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $pword = $_POST['pword'];
        $address = $_POST['address'];

        $duplicate = mysqli_query($db, "SELECT * FROM customer WHERE email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            echo '<script>alert("Email already exists");</script>';
        }
        else {
            $sql_statement = "INSERT INTO customer(name,gender,email,pword,address) VALUES ('$name','$gender','$email','$pword','$address')";
            $result = mysqli_query($db, $sql_statement);
            header("Location: signup-success.html");
        }
        
    }
    else {
        echo '<script>alert("Registration failed")</script>';
    }

?>