<?php

    include "config2.php";

    $tablename = $_SESSION["table-name"];

    if($tablename=="orders") {
        header("Location: insertop-orders.php");
    }
    if($tablename=="supply") {
        header("Location: insertop-supply.php");
    }

?>
<head>
    <title>Insert</title>
</head>
<body>
    <h2>Insert to <?php echo $tablename; ?> table</h2>
    <form method="POST">
        <table>
            <tbody>
                <?php

                    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename'";
                    $result = mysqli_query($db, $sql);

                    $fields[] = array();
                    $i = 0;
                    while($row = mysqli_fetch_array($result)) {
                        $field = $row['COLUMN_NAME'];
                        $fields[$i] = $field;
                        echo "<tr>"."<td>".$field."</td>";

                ?>
                <td>
                    <input type="text" name="number[<?php echo $i; ?>]" required>
                </td>
                <?php 
                    
                        $i = $i + 1;
                    }

                ?>
            </tbody>
        </table>
        <button type="submit" name="insert-btn">Insert</button>
    </form>
    <?php
        
        if(isset($_POST["insert-btn"])) {
            $values[] = array();
            $query = "INSERT INTO $tablename ("; 
            
            for($k = 0; $k < $i; $k++) {
                $query .= "$fields[$k],";
            } 
            $query = trim($query, ",");
            $query .= ") VALUES (";

            for($j = 0; $j < $i; $j++) {
                $values[$j] = $_POST["number"]["$j"];
                $query .= "'$values[$j]',";
            }

            $query = trim($query, ",");
            $query .= ")";

            $result = mysqli_query($db, $query);
            if ($result) {
                echo "<p>Operation successful</p>";
            }
            else {
                echo "<p>Operation failed</p>";
            }
        }

    ?>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
</body>