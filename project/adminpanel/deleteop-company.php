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
    <h2>Delete from company table</h2>
    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>coid</th>
                    <th>name</th>
                    <th>address</th>
                </tr>
            </thead>    
            <tbody>
                <?php

                    $sql = "SELECT * FROM company";
                    $result = mysqli_query($db, $sql);

                    while($row = mysqli_fetch_array($result)) {
                        $coid = $row["coid"];
                        $name = $row["name"];
                        $address = $row["address"];

                        echo "<tr><td>".$coid."</td><td>".$name."</td><td>".$address."</td></tr>";
                    }

                ?>
            </tbody>
        </table>
        <br>
        <label for="delete-coid">coid</label>
        <input type="text" name="delete-coid" required>
        <button type="submit" name="delete-btn">Delete</button>
    </form>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
    <?php
        
        if(!empty($_POST["delete-coid"])) {
            $coid = $_POST["delete-coid"];

            $result = mysqli_query($db, "SELECT * FROM supply WHERE coid='$coid'");
            while($row = mysqli_fetch_array($result)) {
                $pid = $row["pid"];

                $result2 = mysqli_query($db, "DELETE FROM orders WHERE pid = '$pid'");
                $result3 = mysqli_query($db, "DELETE FROM product WHERE pid = '$pid'");
            }
            
            $result4 = mysqli_query($db, "DELETE FROM supply WHERE pid = '$pid'");
            $result5 = mysqli_query($db, "DELETE FROM company WHERE coid = '$coid'");

            header("Location: deleteop-company.php");
        }

    ?>
</body>