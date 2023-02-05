<?php

    include "config.php";

?>
<head>
  <title>Admin Support</title>
  <style>

    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 5px;
    }

    input[type=text] {
      width: 400px;
    }

    .center {
      margin-left: auto;
      margin-right: auto;
    }

    button {
      margin: auto;
      display: block;
    }

  </style>
<head>
<body>
  <div>
    <h2>Admin Support Page</h2>
    <br>
    <table>
      <thead>
        <tr>
          <th style="width:100px;">#</th>
          <th style="width:100px;">Sender ID</th>
          <th style="width:300px;">Sender Name</th>
          <th style="width:100px;">Receiver ID</th>
          <th style="width:300px;">Subject</th>
          <th style="width:300px;">Message</th>
          <th style="width:300px;">Date</th>
        </tr>
      </thead>
      <tbody>
        <?php 

            include "dbconfig.php";

            $ref_table = "messages";
            $fetch_data = $database->getReference($ref_table)->getValue();
            if($fetch_data > 0)
            {
              $index = 1;
              foreach($fetch_data as $key=>$row)
              {
                ?>
                  <tr>
                    <td style="width:100px;"><?=$index?></td>
                    <td style="width:100px;"><?=$row["sender"]?></td>
                    <td style="width:300px;">
                      <?php
                        
                        $cid = $row["sender"];
                        $result = mysqli_query($db, "SELECT * FROM customer WHERE cid = '$cid'");
                        $row2 = mysqli_fetch_assoc($result);
                        $name = $row2["name"]; 
                        if (mysqli_num_rows($result) == 0) {
                          $name = "Admin";
                        }

                      ?>
                      <?=$name?>
                    </td>
                    <td style="width:100px;"><?=$row["receiver"]?></td>
                    <td style="width:300px;"><?=$row["subject"]?></td>
                    <td style="width:300px;"><?=$row["message"]?></td>
                    <td style="width:300px;"><?=$row["time"]?></td>
                  </tr>
                <?php
                $index++;
              }
            }
          
        ?>
      
      </tbody>
    </table>
    <br>
    <form method="POST" action="send_msgadmin.php">
      <table class="center">
        <tbody>
            <tr>
              <td><label for="receiverid">Receiver ID: </label></td>
              <td>
                <select name="receiverid" id="receiverid">
                    <?php
                    
                      $result = mysqli_query($db, "SELECT * FROM customer");

                      while($row = mysqli_fetch_array($result)) {
                        $cid = $row["cid"];
                        echo "<option value=$cid>".$cid."</option>";
                      }

                    ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <label for="subject">Subject: </label>
              </td>
              <td>
                <input type="text" name="subject" id="subject" value="Response">
              </td>
            </tr>
            <tr>
              <td>
                <label for="message">Message: </label>
              </td>
              <td>
                <input type="text" name="message" id="message">
              </td>
            </tr>
        </tbody>
      </table>
      <br>
      <button type="submit" style="text-align: center;">Send</button>
    </form>
    <a href="adminpanel/admin.php">Admin Page</a>
  </div>
</body>