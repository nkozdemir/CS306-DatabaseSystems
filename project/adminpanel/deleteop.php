<?php

    include "config2.php";

    $tablename = $_SESSION["table-name"];

    if($tablename=="orders") {
        header("Location: deleteop-orders.php");
    }
    if($tablename=="customer") {
        header("Location: deleteop-customer.php");
    }
    if($tablename=="company") {
        header("Location: deleteop-company.php");
    }
    if($tablename=="supply") {
        header("Location: deleteop-supply.php");
    }

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
    <h2>Delete from <?php echo $tablename; ?> table</h2>
    <form method="POST">
        <table>
            <thead>
                <tr>
                    <?php

                        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename'";
                        $result = mysqli_query($db, $sql);

                        $fields[] = array();
                        $i = 0;
                        while($row = mysqli_fetch_array($result)) {
                            $field = $row['COLUMN_NAME'];
                            $fields[$i] = $field;
                            echo "<th>".$field."</th>";
                            $i = $i + 1;
                        }

                    ?>
                </tr>
            </thead>    
            <tbody>
                <?php

                    $sql = "SELECT * FROM $tablename";
                    $result = mysqli_query($db, $sql);

                    while($row = mysqli_fetch_array($result)) {
                        $output = "<tr>";

                        for($j = 0; $j < $i; $j++) {
                            $output .= "<td>$row[$j]</td>";
                        }

                        $output .= "</tr>";
                        echo $output;
                    }

                ?>
            </tbody>
        </table>
        <br>
        <label for="delete-field">Choose Field</label>
        <select name="delete-field">
            <?php

                $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename'";
                $result = mysqli_query($db, $sql);

                while($row = mysqli_fetch_array($result)) {
                    $field = $row['COLUMN_NAME'];
                    echo "<option value=$field>".$field."</option>";
                }

            ?>
        </select>
        <label for="delete-value">Enter value</label>
        <input type="text" name="delete-value" required>
        <button type="submit" name="delete-btn">Delete</button>
    </form>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
    <?php
        
        if(!empty($_POST["delete-field"]) && !empty($_POST["delete-value"])) {
            $deletefield = $_POST["delete-field"];
            $deletevalue = $_POST["delete-value"];

            $query = "DELETE FROM $tablename WHERE $deletefield = '$deletevalue'";
            $result = mysqli_query($db, $query);

            header("Location: deleteop.php");
        }

    ?>
</body>