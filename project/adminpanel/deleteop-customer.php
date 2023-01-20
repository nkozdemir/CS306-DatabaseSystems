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
    <h2>Delete from customers table</h2>
    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>cid</th>
                    <th>name</th>
                    <th>gender</th>
                    <th>email</th>
                    <th>pword</th>
                    <th>address</th>
                </tr>
            </thead>    
            <tbody>
                <?php

                    $sql = "SELECT * FROM customer";
                    $result = mysqli_query($db, $sql);

                    while($row = mysqli_fetch_array($result)) {
                        $cid = $row["cid"];
                        $name = $row["name"];
                        $gender = $row["gender"];
                        $email = $row["email"];
                        $pword = $row["pword"];
                        $address = $row["address"];

                        echo "<tr><td>".$cid."</td><td>".$name."</td><td>".$gender."</td><td>".$email."</td><td>".$pword."</td><td>".$address."</td></tr>";
                    }

                ?>
            </tbody>
        </table>
        <br>
        <label for="delete-cid">cid</label>
        <input type="text" name="delete-cid" required>
        <button type="submit" name="delete-btn">Delete</button>
    </form>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
    <?php
        
        if(!empty($_POST["delete-cid"])) {
            $cid = $_POST["delete-cid"];

            $result = mysqli_query($db, "SELECT * FROM orders WHERE cid='$cid'");
            while($row = mysqli_fetch_array($result)) {
                $pid = $row["pid"];
                $amount = $row["amount"];

                $result2 = mysqli_query($db, "SELECT * FROM supply WHERE pid = '$pid'");
                $row2 = mysqli_fetch_assoc($result2);
                $avamount = $row2["amount"];

                $newamount =  $amount + $avamount;
                $result3 = mysqli_query($db, "UPDATE supply SET amount = '$newamount' WHERE pid = '$pid'");
            }

            $result4 = mysqli_query($db, "DELETE FROM customer WHERE cid = '$cid'");

            header("Location: deleteop-customer.php");
        }

    ?>
</body>