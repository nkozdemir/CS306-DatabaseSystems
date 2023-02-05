<?php

  include "config.php";

  if(!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($db, "SELECT * FROM customer WHERE cid = '$id'");
    $row = mysqli_fetch_assoc($result);
  }
  else {
    header("Location: login.html");
  }

  include "navbar.php";

?>

<head>
    <title>Home Page</title>
</head>
<body>
  <div class="container mt-3 text-center">
    <h2>Welcome, <?php echo $row["name"]; ?></h2>
    <br>
    <div class="card-group">
      <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Order</h5>
          <p class="card-text">View your orders and delete your orders.</p>
          <a href="orders.php" class="btn btn-primary">Go to your orders</a>
        </div>
      </div>
      <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Products</h5>
          <p class="card-text">View product catalog and order products.</p>
          <a href="products.php" class="btn btn-primary">Go to products</a>
        </div>
      </div>
      <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Support Page</h5>
          <p class="card-text">Contact support regarding any order issues & suggestions.</p>
          <a href="message_client.php" class="btn btn-primary">Support</a>
        </div>
      </div>
      <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Log out</h5>
          <p class="card-text">Log out from your account.</p>
          <a href="logout.php" class="btn btn-primary">Log out</a>
        </div>
      </div>
    </div>
  </div>
</body>