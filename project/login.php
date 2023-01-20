<?php

    include "config.php";

    if(isset($_POST["useremail"]) && isset($_POST["userpassword"])) {
        $useremail = $_POST["useremail"];
        $userpassword = $_POST["userpassword"];

        $result = mysqli_query($db, "SELECT * FROM customer WHERE email = '$useremail'");
        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($userpassword == $row["pword"]) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["cid"];
                header("Location: index.php");
                exit;
            }
            else {
                echo "<script>alert('Wrong Password');</script>";
            }
        }
        else {
            echo "<script>alert('User Not Found');</script>";
        }
    }
    else {
        echo "<script>alert('Login Failed');</script>";
    }
    
?>