<?php

    include "config.php";

    if(!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
    }
    else {
        header("Location: login.html");
    }

    include "navbar.php";
    
?>

<head>
    <title>Products</title>
</head>
<body>
    <div class="container mt-3">
        <h2>Product Catalog</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Company, Address</th>
                    <th scope="col">Price</th>
                    <th scope="col">In Stock</th>
                    <th scope="col">Order</th>
                </tr>
            </thead>
            <?php 

                $sql_statement = "SELECT * from product";
                $result = mysqli_query($db, $sql_statement);
                while($row = mysqli_fetch_array($result)){
                    $pid = $row["pid"];

            ?>
            <tbody>
                <form action="order-item.php" method="POST">
                    <?php

                        $result2 = mysqli_query($db, "SELECT * FROM supply WHERE pid ='$pid'");
                        $row2 = mysqli_fetch_assoc($result2);
                        $coid = $row2["coid"];

                        $result3 = mysqli_query($db, "SELECT * FROM company WHERE coid = '$coid'");
                        $row3 = mysqli_fetch_assoc($result3);

                        echo "<tr>"."<td>".$row["name"]."</td>"."<td>".$row3["name"].", ".$row3["address"]."</td>"."<td>$".$row["price"]."</td>"."<td>".$row2["amount"]."</td>";

                    ?>           
                    <input type="hidden" name="pid" value="<?= $pid ?>" />
                    <input type="hidden" name="cid" value="<?= $id ?>" />
                    <input type="hidden" name="av-amount" value="<?= $row2["amount"] ?>" />
                    <td>
                        <label for="order-amount">Order Amount: </label>
                        <input type="number" name="order-amount" required>
                        <button type="submit" name="order-btn" class="btn btn-primary">Order</button>
                    </td></tr>
                </form>
            </tbody>
        <?php } ?>
        </table> 
    </div>
</body>

