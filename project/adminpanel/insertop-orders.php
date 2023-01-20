<?php

    include "config2.php";

?>
<head>
    <title>Insert</title>
</head>
<body>
    <h2>Insert to orders table</h2>
    <form method="POST">
        <table>
            <tbody>
                <tr>
                    <td>
                        <label for="insert-cid">cid</label>
                        <input type="text" name="insert-cid" required>
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
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
    <?php
        
        if(!empty($_POST["insert-cid"]) && !empty($_POST["insert-pid"]) && !empty($_POST["insert-amount"])) {
            $cid = $_POST["insert-cid"];
            $pid = $_POST["insert-pid"];
            $amount = $_POST["insert-amount"];

            $sql = "SELECT * FROM supply WHERE pid = '$pid'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            $avamount = $row["amount"];

            if($amount <= $avamount) {
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

                $avamount = $avamount - $amount;
                mysqli_query($db, "UPDATE supply SET amount = '$avamount' WHERE pid = '$pid'");
                
                echo "<p>Operation successful</p>";
            }
            else {
                echo '<script>alert("Not enough product available in stock")</script>';
            }

        }

    ?>
</body>