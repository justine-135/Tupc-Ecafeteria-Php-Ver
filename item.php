<?php
    require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-CAFETERIA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css?">


</head>
<body style="height: auto;" onload="itemFunc()">

    <nav class="navbar navbar-expand-sm navbar-dark topnav sticky-top head">
        <a class="navbar-brand"> <img src="favicon.png" alt="logo" style="height:40px; width:40px;"> TUPC E-Cafeteria </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="topnav">
            <li><button id="menu-tab" data-toggle="tooltip" title="Menu"><i class="fa fa-home"></i></button></li>
            <li><a class="active" href="item.php" data-toggle="tooltip" title="Item management"><i class="fas fa-warehouse"></i></a></li>
            <li><a href="inventory.php" data-toggle="tooltip" title="Inventory"><i class="fa fa-chart-line"></i></a></li>
        </ul>
    </div>
    </nav>

    <form enctype="multipart/form-data" id="item-form" class="was-validated" action="insert_data.php" method="post">
    <div class="container-fluid contents">
        <div class="row">
            <div class="col-sm-3 h-50 d-flex flex-column justify-content-center item-height left-content">
                <label class="headeritem" >Item Management </label>

                <select class="custom-select form-control flex-fill mb-1 w-100 select-btn"id="dropdown" name='categories'>
                    <option value="breakfast" id="selectBreakfast">Breakfast</option>
                    <option value="lunchmeal" id="selectLunchmeals">Lunchmeals</option>
                    <option value="beverage" id="selectBeverageDrinks">Beverage and Drinks</option>
                    <option value="add-ons" id="Addons">Add-ons</option>         
                </select>
                <input class="mb-1 form-control"type= "text" id="food" name="food" placeholder="Enter name here" required>
                <input class="mb-1 form-control"type="number" min=1 id="quantity" name="quantity" placeholder="Enter quantity here"required>
                <input class="mb-1 form-control"type="number" id="price" min=1 name="price" step="any" placeholder="Enter price here" required>
                <input data-toggle="tooltip" title="JPG, JPEG, PNG, GIF" class="upload"type="file" id="myFile" accept="image/*" name="filename" style="opacity: 0;"">
                <label for="myFile" id="fileUpload" class="btn btn-primary select-image" style="margin-top: -30px;">Select an image <i class="fa fa-upload"></i></label>
                <div class="container image-preview col-12" id='image-preview' style="background-color: transparent; width: 100%; ">
                    <img class=""id="preview"  alt=''>
                    
                </div>
                <div class="group mt-1 row">
                    <button data-target="#confirm" type="button" class="btn btn-primary form-btn ml-3" id="add-button" data-toggle="modal" title="Submit to menu"> <i></i> Confirm</button>
                    <button onClick="window.location.reload()" class="btn btn-secondary form-btn ml-3" type="button" id="clear" data-toggle="tooltip" title="Clear inputs">Clear</button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id='modal-body'></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value='Add item' class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 item-height right-content">
                <div class="d-flex group-btn">
                    <button class="col-xl-3 nav-button" type="button" aria-expanded="false" data-toggle="collapse" data-target="#itemBreakfast" id="btn-breakfast">Breakfast <span class="badge badge-light badge-pill" id="breakfast-count">0</span></button>
                    <button class="col-xl-3 nav-button" type="button" aria-expanded="false" data-toggle="collapse" data-target="#itemLunchmeals" id="btn-lunch">Lunchmeals <span class="badge badge-light badge-pill" id="lunchmeal-count">0</span></button>
                    <button class="col-xl-3 nav-button" type="button" aria-expanded="false" data-toggle="collapse" data-target="#itemBeverageDrinks" id="btn-drinks">Beverage and Drinks <span class="badge badge-light badge-pill" id="drinks-count">0</span></button>
                    <button class="col-xl-3 nav-button" type="button" aria-expanded="false" data-toggle="collapse" data-target="#itemAddons" id="btn-addons">Add-ons <span class="badge badge-light badge-pill" id="addons-count">0</span></button>
                </div>
                <div class="itemMenu container-fluid">  
                    <div id="accordion">
                        <div class="container-fluid breakFast show" id="itemBreakfast" data-parent="#accordion">
                            <h3 class="col-xl-12 titleMenu">Breakfast</h3>
                            <div class="container-fluid d-flex flex-row" id="breakfast-menu">
                                <table class="table table-item" id="id-table-item-breakfast">
                                    <thead>
                                        <th>Item</th>
                                        <th>Display</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Edit</th>
                                    </thead>
                                    <tbody id="table-content-breakfast">
                                        <?php
                                            $result = $conn->prepare("SELECT * FROM breakfast_table");
                                            $result->execute();
                                            while($row=$result->fetch()){
                                                $id = $row['item_num'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['item_name'];?></td>
                                                    <td><img src="image/<?php echo $row['display'];?>" alt="<?php echo $row['display'];?>" class="img img-input"></td>
                                                    <td><?php echo $row['item_quantity'];?></td>
                                                    <td>P <?php echo $row['item_price'];?></td>
                                                    <td><a href="search_breakfast.php?item_num=<?php echo $id;?>"  class='btn edit-item'><i data-toggle = 
                                                    "tooltip" title="Update" data-placement="bottom" class="fa fa-pen-square"></i></a>
                                                        <a class="btn btn-danger rem" 
                                                    href="breakfast_remove.php?id=<?php echo $id;?>">
                                                    <i class="fa fa-trash-o" data-toggle = 
                                                    "tooltip" title="Remove" data-placement="bottom" ></i></a></td>
                                                </tr>  
                                        <?php }?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="container-fluid lunchMeals collapse" id="itemLunchmeals" data-parent="#accordion">
                                <h3 class="col-xl-12 titleMenu">Lunchmeals</h3>
                            <div class="container-fluid d-flex flex-row" id="lunch-menu">
                                <table class="table table-item" id="id-table-item-lunchmeal">
                                    <thead>
                                        <th>Item</th>
                                        <th>Display</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Edit</th>
                                    </thead>
                                    <tbody id="table-content-lunchmeal">
                                    <?php
                                            $result = $conn->prepare("SELECT * FROM lunchmeal_table");
                                            $result->execute();
                                            while($row=$result->fetch()){
                                                $id = $row['item_num'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['item_name'];?></td>
                                                    <td><img src="image/<?php echo $row['display'];?>" alt="<?php echo $row['display'];?>" class="img img-input"></td>
                                                    <td><?php echo $row['item_quantity'];?></td>
                                                    <td>P <?php echo $row['item_price'];?></td>
                                                    <td><a href="search_lunchmeal.php?item_num=<?php echo $id;?>"  class='btn edit-item'><i data-toggle = 
                                                    "tooltip" title="Update" data-placement="bottom" class="fa fa-pen-square"></i></a>
                                                        <a class="btn btn-danger rem" data-toggle = 
                                                    "tooltip" title="Remove" data-placement="bottom" 
                                                    href="lunchmeal_remove.php?id=<?php echo $id;?>">
                                                    <i class="fa fa-trash-o"></i></a></td>
                                                </tr>  
                                        <?php }?>    
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        <div class="container-fluid beverageDrinks collapse" id="itemBeverageDrinks" data-parent="#accordion">
                                <h3 class="col-xl-12 titleMenu ">Beverage and Drinks</h3>
                            <div class="container-fluid d-flex flex-row" id="drinks-menu">
                                <table class="table table-item" id="id-table-item-drinks">
                                    <thead>
                                        <th>Item</th>
                                        <th>Display</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Edit</th>
                                    </thead>
                                    <tbody id="table-content-drinks">
                                    <?php
                                            $result = $conn->prepare("SELECT * FROM beverageDrinks_table");
                                            $result->execute();
                                            while($row=$result->fetch()){
                                                $id = $row['item_num'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['item_name'];?></td>
                                                    <td><img src="image/<?php echo $row['display'];?>" alt="<?php echo $row['display'];?>" class="img img-input"></td>
                                                    <td><?php echo $row['item_quantity'];?></td>
                                                    <td>P <?php echo $row['item_price'];?></td>
                                                    <td><a href="search_beveragedrinks.php?item_num=<?php echo $id;?>"  class='btn edit-item'><i data-toggle = 
                                                    "tooltip" title="Update" data-placement="bottom" class="fa fa-pen-square"></i></a>
                                                        <a class="btn btn-danger rem" data-toggle = 
                                                    "tooltip" title="Remove" data-placement="bottom" 
                                                    href="beverage_remove.php?id=<?php echo $id;?>">
                                                    <i class="fa fa-trash-o"></i></a></td>
                                                </tr>  
                                        <?php }?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="container-fluid addOns collapse" id="itemAddons" data-parent="#accordion">
                                <h3 class="col-xl-12 titleMenu">Add-ons</h3>
                             <div class="container-fluid d-flex flex-row" id="addons-menu">
                                <table class="table table-item" id="id-table-item-addons">
                                    <thead>
                                        <th>Item</th>
                                        <th>Display</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Edit</th>
                                    </thead>
                                    <tbody id="table-content-addons">
                                    <?php
                                        $result = $conn->prepare("SELECT * FROM addOns_table");
                                        $result->execute();
                                        while($row=$result->fetch()){
                                            $id = $row['item_num'];
                                            ?>
                                            <tr>
                                                <td><?php echo $row['item_name'];?></td>
                                                <td><img src="image/<?php echo $row['display'];?>" alt="<?php echo $row['display'];?>" class="img img-input"></td>
                                                <td><?php echo $row['item_quantity'];?></td>
                                                <td>P <?php echo $row['item_price'];?></td>
                                                <td><a href="search_addons.php?item_num=<?php echo $id;?>"  class='btn edit-item'><i data-toggle = 
                                                    "tooltip" title="Update" data-placement="bottom" class="fa fa-pen-square"></i></a>
                                                    <a class="btn btn-danger rem" data-toggle = 
                                                "tooltip" title="Remove" data-placement="bottom" 
                                                href="addons_remove.php?id=<?php echo $id;?>">
                                                <i class="fa fa-trash-o"></i></a></td>
                                            </tr>  
                                    <?php }?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </form>
    
    <div class="footer2">
        <p>@ 2020 COET S-3A Students</p>
    </div>

    <script src="ecafeScript.js?v=2"></script>
</body>
</html>