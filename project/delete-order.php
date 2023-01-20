<?php

    include "config.php";

    if(!empty($_POST['pnameid'])) {
        $pid = $_POST['pnameid'];
        $cid = $_POST['cid'];

        $result2 = mysqli_query($db, "SELECT * FROM orders WHERE cid='$cid' AND pid='$pid'");
        $row2 = mysqli_fetch_assoc($result2);
        $amount = $row2["amount"];

        $result3 = mysqli_query($db, "SELECT * FROM supply WHERE pid = '$pid'");
        $row3 = mysqli_fetch_assoc($result3);
        $supamount = $row3["amount"];

        $newamount = $supamount + $amount;
        mysqli_query($db, "UPDATE supply SET amount = '$newamount' WHERE pid = '$pid'");
        mysqli_query($db, "DELETE FROM orders WHERE pid = '$pid' AND cid = '$cid'");

        header("Location: orders.php");
    }
    else {
        echo '<script>alert("The form is empty")</script>';
    }

?>