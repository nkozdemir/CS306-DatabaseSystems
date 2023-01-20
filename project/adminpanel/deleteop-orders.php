<?php

    include "config2.php";

?>
<head>
    <title>Delete</title>
    <style>

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

    </style>
</head>
<body>
    <h2>Delete from orders table</h2>
    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>cid</th>
                    <th>pid</th>
                    <th>amount</th>
                    <th>order_date</th>
                </tr>
            </thead>    
            <tbody>
                <?php

                    $sql = "SELECT * FROM orders";
                    $result = mysqli_query($db, $sql);

                    while($row = mysqli_fetch_array($result)) {
                        $cid = $row["cid"];
                        $pid = $row["pid"];
                        $amount = $row["amount"];
                        $order_date = $row["order_date"];

                        echo "<tr><td>".$cid."</td><td>".$pid."</td><td>".$amount."</td><td>".$order_date."</td></tr>";
                    }

                ?>
            </tbody>
        </table>
        <br>
        <label for="delete-cid">cid</label>
        <input type="text" name="delete-cid" required>
        <label for="delete-pid">pid</label>
        <input type="text" name="delete-pid" required>
        <button type="submit" name="delete-btn">Delete</button>
    </form>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
    <?php
        
        if(!empty($_POST["delete-cid"]) && !empty($_POST["delete-pid"])) {
            $cid = $_POST["delete-cid"];
            $pid = $_POST["delete-pid"];

            $result2 = mysqli_query($db, "SELECT * FROM orders WHERE cid='$cid' AND pid='$pid'");
            $row2 = mysqli_fetch_assoc($result2);
            $amount = $row2["amount"];

            $result3 = mysqli_query($db, "SELECT * FROM supply WHERE pid = '$pid'");
            $row3 = mysqli_fetch_assoc($result3);
            $supamount = $row3["amount"];

            $newamount = $supamount + $amount;
            mysqli_query($db, "UPDATE supply SET amount = '$newamount' WHERE pid = '$pid'");
            mysqli_query($db, "DELETE FROM orders WHERE pid = '$pid' AND cid = '$cid'");

            header("Location: deleteop-orders.php");
        }

    ?>
</body>