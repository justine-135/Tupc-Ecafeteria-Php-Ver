<?php
    require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>E-CAFETERIA</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <meta name="google-site-verification" content="iEKFN3Db9oCK1iLEgrYp7HiHQ4lfAbZ-LW4o7yGXcDg" />


</head>
<body class="main" style="background-image: linear-gradient(to right, #23272a, #35455d);" onload="indexFunc()">
 
  <header>
    <nav class="navbar navbar-expand-sm navbar-dark topnav fixed-top head head2 col-xl-12" style="background-image: linear-gradient(to right,#23272a, #35455d);">
      <a class="navbar-brand"> <img src="favicon.png" alt="logo" style="height:40px; width:40px;"> TUPC E-Cafeteria </a>
      <button class="order-btn col-2 ml-auto p-2 col-xl-1" data-toggle="collapse" data-target="#orders-section" type="button"><i class="fa fa-shopping-cart"></i>
        <span class="badge badge-light badge-pill cart-count" title="Orders" data-toggle="tooltip" id="order-count">0</span></button>
    </nav>  
  </header> 

  <div class="container-blur" id="idBlur" onclick="blur()">
    
  </div>

  <div class="cover col-12" id="idCover">
    <div class="container-fluid pt-1 col-12 col-md-12 col-xl-12 justify-content-center quote">
      <h3 id="select">
        <pre>
eat good 
feel good
        </pre> 
      </h3>
    </div>
  </div>
  
  <form class="form1" id="index-form" action="submitted_order.php" method="post">
    <div class="d-flex justify-content-end form-width">
      <div class="row collapse col-xl-4" id="orders-section">
        <div class="column1 pl-4 col-4 col-lg-4 col-xl-3">
          <h5 class="font-weight-bolder">Item</h5>
          <hr>
        </div>
        <div class="column1 pl-3 col-4 col-lg-4 col-xl-4">
          <h5 class="font-weight-bolder">Price</h5>
          <hr>
        </div>
        <div class="column1 col-4 col-lg-3 pr-1 col-xl-5">
          <h5 class="font-weight-bolder">Amount</h5>
          <hr>
        </div>
        <div class="content col-12" id="inside">
        <input type="text" name='hour' class='display-hour' id='display-hour'>
       </div>
        <hr>
        <p class="col-12 col-lg-12 mb-4 par-price" style="background-color: white;">Total purchase: P <span> <input id="myPrice" class="col-5" type="number" value="0" name="total-purchase" readonly> </span> </p>
        <input class="btn col-8 col-md-8 col-lg-7 col-xl-8 btn-primary submit-btn mr-4" data-toggle='tooltip' data-placement='bottom' title='Submit item' type="submit" value="PURCHASE" id="id-purchase" onclick="window.location.href='('update_table.php')'">
        <button class="btn col-3 btn-danger submit-btn" type="button" data-toggle='tooltip' data-placement='bottom' title='Clear rows' id="idReset"><i class="fa fa-trash-o"></i></button>
      </div>
    </div>    
  </form>
  
  <div class="main-content" id="accordion">
    <div class="middle-side col-12 col-xl-12" id="idMenu">
      <div class="breakFast collapse" id="idBreakfast" data-parent="#accordion">
        <div class="menu-containers row">

          <?php
              $result = $conn->prepare("SELECT * FROM breakfast_table");
              $result->execute();
              while($row=$result->fetch()){
                  ?>
                  <div class="thumbnail col-6 col-sm-4 col-xl-3 mt-5">
                    <img class="img" type="button" src="image/<?php echo $row['display'];?>" value="<?php echo $row['item_quantity'];?>" value2="<?php echo $row['item_price'];?>" name="<?php echo $row['item_name'];?>" id="dish">
                    <div class="caption"  style="background-color: white;" id="caption">
                      <h5></h5>
                      <h6 class="ml-1">Quantity</h6>
                      <h6 class="ml-1">Price</h6>
                    </div>
                  </div>
          <?php }?>   
        
        </div>  
      </div>
      <div class="lunchMeals collapse" id="idLunchmeals" data-parent="#accordion">
        <div class="menu-containers row">

        <?php
              $result = $conn->prepare("SELECT * FROM lunchmeal_table");
              $result->execute();
              while($row=$result->fetch()){
                  ?>
                  <div class="thumbnail col-6 col-sm-4 col-xl-3 mt-5">
                    <img class="img" type="button" src="image/<?php echo $row['display'];?>" value="<?php echo $row['item_quantity'];?>" value2="<?php echo $row['item_price'];?>" name="<?php echo $row['item_name'];?>" id="dish">
                    <div class="caption"  style="background-color: white;" id="caption">
                      <h5></h5>
                      <h6 class="ml-1">Quantity</h6>
                      <h6 class="ml-1">Price</h6>
                    </div>
                  </div>
          <?php }?>   

        </div>
      </div>
      <div class="beverageDrinks collapse" id="idBeveragedrinks" data-parent="#accordion">
        <div class="menu-containers row">

          <?php
                $result = $conn->prepare("SELECT * FROM beverageDrinks_table");
                $result->execute();
                while($row=$result->fetch()){
                    ?>
                    <div class="thumbnail col-6 col-sm-4 col-xl-3 mt-5">
                      <img class="img" type="button" src="image/<?php echo $row['display'];?>" value="<?php echo $row['item_quantity'];?>" value2="<?php echo $row['item_price'];?>" name="<?php echo $row['item_name'];?>" id="dish">
                      <div class="caption"  style="background-color: white;" id="caption">
                        <h5></h5>
                        <h6 class="ml-1">Quantity</h6>
                        <h6 class="ml-1">Price</h6>
                      </div>
                    </div>
            <?php }?>   

        </div>
      </div>
      <div class="addOns collapse" id="idAddons" data-parent="#accordion">
        <div class="menu-containers row">

        <?php
              $result = $conn->prepare("SELECT * FROM addOns_table");
              $result->execute();
              while($row=$result->fetch()){
                  ?>
                  <div class="thumbnail col-6 col-sm-4 col-xl-3 mt-5">
                    <img class="img" type="button" src="image/<?php echo $row['display'];?>" value="<?php echo $row['item_quantity'];?>" value2="<?php echo $row['item_price'];?>" name="<?php echo $row['item_name'];?>" id="dish">
                    <div class="caption"  style="background-color: white;" id="caption">
                      <h5></h5>
                      <h6 class="ml-1">Quantity</h6>
                      <h6 class="ml-1">Price</h6>
                    </div>
                  </div>
          <?php }?>   

        </div>
      </div>
    </div>
  </div>

  <div class="bottom-nav fixed-bottom navbar justify-content-center"></div>

  <nav class="fixed-bottom navbar">
    <div class="col-12 col-lg-12 row d-flex flex-row justify-content-center btn-categories" id="btn-group">
      <h1 class="col-xl-4" id="menu-title">Home</h1>
      <button class="button col-3 col-lg-3 col-xl-2 btn-select" data-toggle="collapse" data-target="#idBreakfast" aria-expanded="false" id="btn-breakfast" type="button">BREAKFAST</button>
      <button class="button col-3 col-lg-3 col-xl-2 btn-select" data-toggle="collapse" data-target="#idLunchmeals" aria-expanded="false" id="btn-lunchmeals" type="button">LUNCH MEALS</button>
      <button class="button col-3 col-lg-3 col-xl-2 btn-select" data-toggle="collapse" data-target="#idBeveragedrinks" aria-expanded="false" id="btn-beveragedrinks" type="button">DRINKS</button>
      <button class="button col-3 col-lg-3 col-xl-2 btn-select" data-toggle="collapse" data-target="#idAddons" aria-expanded="false" id="btn-addons" type="button">ADD-ONS</button>
    </div>
  </nav>
  
  <script src="ecafeScript.js?3"></script>
</body>
</html>


