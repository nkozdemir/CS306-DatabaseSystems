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
  <title>Support</title>
</head>
<body>
  <div class="container mt-3">
    <h2>Support Page</h2>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th style="width:100px;">#</th>
          <th style="width:300px;">Sender Name</th>
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
            if($fetch_data > 0) {
              $index = 1;
              foreach($fetch_data as $key=>$row) {
                if($row["sender"] == $id || ($row["sender"] == "Admin" && $row["receiver"] == $id)) {
                ?>
                  <tr>
                    
                    <td><?=$index?></td>
                    <td>
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
                    <td><?=$row["subject"]?></td>
                    <td><?=$row["message"]?></td>
                    <td><?=$row["time"]?></td>
                  </tr>
                <?php
                $index++;
                }
              }
              
            }
          
        ?>
      
      </tbody>
    </table>
    <form method="POST" action="send_message.php?sender=<?=$id?>">
        <label for="subject" class="form-label">Choose Subject</label>
        <select name="subject" id="subject" class="form-select">
          <option value="Defected Product">Defected Product</option>
          <option value="Late Order">Late Order</option>
          <option value="Suggestion">Suggestion</option>
        </select>
        <br>
        <label for="message" class="form-label">Your Message</label>
        <div class="text-center">
          <input type="text" name="message" id="message" class="form-control">
          <br>
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
  </div>
</body>