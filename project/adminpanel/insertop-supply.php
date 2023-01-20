<?php

    include "config2.php";

?>
<head>
    <title>Insert</title>
</head>
<body>
    <h2>Insert to supply table</h2>
    <form method="POST">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label for="insert-coid">coid</label>
                        <input type="text" name="insert-coid" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="insert-pid">pid</label>
                        <input type="text" name="insert-pid" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="insert-amount">amount</label>
                        <input type="text" name="insert-amount" required>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <button type="submit" name="insert-btn">Insert</button>
    </form>
    <?php
        
        if(!empty($_POST["insert-coid"]) && !empty($_POST["insert-pid"]) && !empty($_POST["insert-amount"])) {
            $coid = $_POST["insert-coid"];
            $pid = $_POST["insert-pid"];
            $amount = $_POST["insert-amount"];

            $result = mysqli_query($db, "SELECT * FROM supply WHERE coid = '$coid' AND pid = '$pid'");

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $curamount = $row["amount"];
                $newamount = $curamount + $amount;
                mysqli_query($db, "UPDATE supply SET amount = '$newamount' WHERE coid = '$coid' AND pid = '$pid'");
            }
            else {
                mysqli_query($db, "INSERT INTO supply (coid, pid, amount) VALUES ('$coid', '$pid', '$amount')");
            }

            echo "<p>Operation successful</p>";

        }

    ?>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
</body>