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
    <h2>Delete from supply table</h2>
    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>coid</th>
                    <th>pid</th>
                    <th>amount</th>
                </tr>
            </thead>    
            <tbody>
                <?php

                    $sql = "SELECT * FROM supply";
                    $result = mysqli_query($db, $sql);

                    while($row = mysqli_fetch_array($result)) {
                        $coid = $row["coid"];
                        $pid = $row["pid"];
                        $amount = $row["amount"];

                        echo "<tr><td>".$coid."</td><td>".$pid."</td><td>".$amount."</td></tr>";
                    }

                ?>
            </tbody>
        </table>
        <br>
        <label for="delete-coid">coid</label>
        <input type="text" name="delete-coid" required>
        <label for="delete-pid">pid</label>
        <input type="text" name="delete-pid" required>
        <button type="submit" name="delete-btn">Delete</button>
    </form>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
    <?php
        
        if(!empty($_POST["delete-coid"]) && !empty($_POST["delete-pid"])) {
            $coid = $_POST["delete-coid"];
            $pid = $_POST["delete-pid"];

            $result = mysqli_query($db, "DELETE FROM orders WHERE pid = '$pid'");
            $result2 = mysqli_query($db, "DELETE FROM product WHERE pid = '$pid'");
            $result3 = mysqli_query($db, "DELETE FROM supply WHERE coid = '$coid' AND pid = '$pid'");

            header("Location: deleteop-supply.php");
        }

    ?>
</body>