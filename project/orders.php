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
    <title>Orders</title>
</head>
<body>
    <div class="container mt-3">
        <h2>My Orders</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $result = mysqli_query($db, "SELECT * from orders WHERE cid = '$id'"); 

                    while($row = mysqli_fetch_assoc($result)) {
                        $pid = $row["pid"];
                        $amount = $row["amount"];
                        $date = $row["order_date"];
                        $date = date("d-m-Y H:i:s",strtotime(str_replace('/','-',$date)));
                        
                        $result2 = mysqli_query($db, "SELECT name, price FROM product WHERE pid = '$pid'");
                        $row2 = mysqli_fetch_assoc($result2);
                        $name = $row2["name"];
                        $price = $row2["price"];
                        $totprice = $price * $amount;

                        echo "<tr>"."<td>".$name."</td>"."<td>".$amount."</td>"."<td>".$date."</td>"."<td>$".$price."</td>"."<td>$".$totprice."</td>"."</tr>";

                    }

                ?>
            </tbody>
        </table>
        <br>
        <form action="delete-order.php" method="POST">
            <input type="hidden" name="cid" value="<?= $id ?>" />
            <label for="pnameid" class="form-label">Choose an order to delete</label>
            <select name="pnameid" class="form-select" aria-label="Default select example">
                <?php
                    
                    $result3 = mysqli_query($db, "SELECT * from orders WHERE cid = '$id'");

                    while($row3 = mysqli_fetch_assoc($result3)) {
                        $pid = $row3["pid"];
                        
                        $result4 = mysqli_query($db, "SELECT name FROM product WHERE pid = '$pid'");
                        $row4 = mysqli_fetch_assoc($result4);
                        $name = $row4["name"];

                        echo "<option value=$pid>".$name."</option>";
                    }

                ?>
            </select>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Delete Order</button>
            </div>
        </form>
    </div>
</body>