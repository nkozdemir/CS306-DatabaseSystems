<?php

    include "config2.php";

    $tablename = $_SESSION["table-name"];

?>
<head>
    <title>Choose Operation</title>
    <style>

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

    </style>
</head>
<body>
    <h2>Displaying <?=$tablename?> table</h2>
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

                $query = "SELECT * FROM $tablename";
                $result = mysqli_query($db, $query);

                while($row = mysqli_fetch_array($result)) {
                    $output = "<tr>";
                    for($j = 0; $j < $i; $j++) {
                        $output .= "<td>".$row[$j]."</td>";
                    }
                    $output .= "</tr>";
                    echo $output;
                }

            ?>
        </tbody>
    </table>
    <br>
    <h2>Choose Operation</h2>
    <table>
        <tbody>
            <tr>
                <td>
                    <a href="selectop.php">Select</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="insertop.php">Insert</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="deleteop.php">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <a href="admin.php">Back</a>
</body>