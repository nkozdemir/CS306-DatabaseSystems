<?php

    include "config2.php";

    $tablename = $_SESSION["table-name"];

?>
<head>
    <title>Select</title>
    <style>

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

    </style>
</head>
<body>
    <h2>Select from <?php echo $tablename; ?> table</h2>
    <form method="GET">
        <label for="select-field">Choose field</label>
        <select name="select-field">
            <?php

                $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename'";
                $result = mysqli_query($db, $sql);

                while($row = mysqli_fetch_array($result)) {
                    $field = $row['COLUMN_NAME'];
                    echo "<option value=$field>".$field."</option>";
                }

            ?>
        </select>
        <label for="select-value">Enter value</label>
        <input type="text" name="select-value" required>
        <button type="submit" name="select-btn">Select</button>
    </form>
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
                
                if(!empty($_GET["select-value"]) && !empty($_GET["select-field"])) {
                    $selectfield = $_GET["select-field"];
                    $selectvalue = $_GET["select-value"];

                    $query = "SELECT * FROM $tablename WHERE $selectfield = '$selectvalue'";
                    $result = mysqli_query($db, $query);

                    echo "<p>Displaying entries with $selectfield = $selectvalue</p>";

                    while($row = mysqli_fetch_array($result)) {
                        $output = "<tr>";
                        for($j = 0; $j < $i; $j++) {
                            $output .= "<td>".$row[$j]."</td>";
                        }
                        $output .= "</tr>";
                        echo $output;
                    }

                }
                else {
                    $query = "SELECT * FROM $tablename";
                    $result = mysqli_query($db, $query);

                    echo "<p>Displaying all entries</p>";

                    while($row = mysqli_fetch_array($result)) {
                        $output = "<tr>";
                        for($j = 0; $j < $i; $j++) {
                            $output .= "<td>".$row[$j]."</td>";
                        }
                        $output .= "</tr>";
                        echo $output;
                    }
                }

            ?>
        </tbody>
    </table>
    <br>
    <a href="operation.php">Back</a>
    <a href="admin.php">Home</a>
</body>