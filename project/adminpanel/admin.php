<head>
    <title>Select Table</title>
</head>
<body>
    <h2>Choose Table</h2>
    <form method="GET">
        <label for="table-name">Choose Table</label>
        <select name="table-name">
            <?php

                include "config2.php";

                $sql = "SHOW TABLES";
                $result = mysqli_query($db, $sql);

                while($row = mysqli_fetch_row($result)) {
                    echo "<option value=$row[0]>".$row[0]."</option>";
                }

            ?>
        </select>
        <br>
        <button type="submit" name="table-btn">Choose</button>
    </form>
    <?php

        if(isset($_GET["table-btn"])) {
            $_SESSION["table-name"] = $_GET["table-name"];
            header("Location: operation.php");
        }

    ?>
    <br>
    <a href="../message_admin.php">Support Panel</a>
<body>