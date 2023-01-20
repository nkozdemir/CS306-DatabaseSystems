<?php

    include "config.php";

    if(isset($_POST["order-btn"])) {
        $pid = $_POST["pid"];
        $cid = $_POST["cid"];
        $amount = $_POST["order-amount"];
        $amount2 = $_POST["av-amount"];

        if ($amount <= $amount2) {

            $result = mysqli_query($db, "SELECT * FROM orders WHERE cid = '$cid' AND pid = '$pid'");

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $addamount = $row["amount"];
                $newamount = $addamount + $amount;
                mysqli_query($db, "UPDATE orders SET amount = '$newamount' WHERE cid = '$cid' AND pid = '$pid'");
            }
            else {
                mysqli_query($db, "INSERT INTO orders (cid, pid, amount) VALUES ('$cid', '$pid', '$amount')");
            }

            $amount2 = $amount2 - $amount;
            mysqli_query($db, "UPDATE supply SET amount = '$amount2' WHERE pid = '$pid'");
            
            header("Location: products.php");
        } 
        else {
            echo '<script>alert("Not enough product available in stock")</script>';
        }
    }
    else {
        echo '<script>alert("Order failed")</script>';
    }

?>