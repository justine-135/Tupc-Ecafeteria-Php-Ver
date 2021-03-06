<?php
    require_once('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-CAFETERIA</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta charset="utf-8">
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
    <link rel="stylesheet" href="style.css?v=1">

</head>
<body class="inventory-background" id="inventory-body" onload="inventoryFunc()">

    <nav class="navbar navbar-expand-sm navbar-dark topnav head3 sticky-top">
        <a class="navbar-brand"> <img src="favicon.png" alt="logo" style="height:40px; width:40px;"> TUPC E-Cafeteria </a>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
         <ul class="topnav">
            <li><button id="menu-tab" data-toggle="tooltip" title="Menu"><i class="fa fa-home"></i></button></li>
            <li><a href="item.php" data-toggle="tooltip" title="Item management"><i class="fas fa-warehouse"></i></a></li>
            <li><a class="active" href="inventory.php" data-toggle="tooltip" title="Inventory"><i class="fa fa-chart-line"></i></a></li>
         </ul>
       </div>
     </nav>

     <nav class="navbar navbar-expand-sm navbar-dark topnav head4 sticky-top">
         <div class="d-flex justify-content-between flex-row col-xl-12">

            <div class="time">
                <h1 id="date-name"></h1>
                <h6 id="id-time"></h6>
             </div>

             <div class="sales">
                <h1 class="inventory-value" id="id-sales-value" value="0">P 0</h1>
                <h6 class="inventory-status" id="id-sales">Total Sales <i class='fa fa-tags inventory-icons'></i></h6>
             </div>

             <div class="success">
                <h1 class="inventory-value" id="id-success-value" value="0">0</h1>
                <h6 class="inventory-status" id="id-success">Success total <i class="fa fa-angle-up inventory-icons"></i></h6>
             </div>

             <div class="cancel">
                <h1 class="inventory-value" id="id-cancel-value" value="0">0</h1>
                <h6 class="inventory-status" id="id-cancel">Cancel total <i class='fa fa-angle-down inventory-icons'></i></h6>
             </div>
            
             <div class="activate-reset d-flex flex-column">
                <a href="del_table.php" class="btn btn-danger mb-1" id="reset-btn" data-toggle="tooltip" title="Clear table" data-placement="left"><i class="fas fa-folder-minus"></i></a>
                <a role="button" class="btn btn-info" onClick="window.location.reload()" id="refresh-btn"  data-toggle="tooltip" title="Synchronize" data-placement="left"><i class="fas fa-sync-alt"></i></a>

             </div>
         </div>
     </nav>

    <table class="tb-inventory tb-orders table table-bordered table-sm" id="tbl-inventory">
        <thead>
            <tr>
                <th>#</th>
                <th>Time</th>
                <th>Item</th>
                <th>Total purchase (P)</th>
                <th>Status</th>
                <th>Cancel order</th>
            </tr>
        </thead>
        
        <tbody class="tb-body" id="id-tb-body">
            <?php
                $result = $conn->prepare("SELECT * FROM ordered_items");
                $result->execute();
                while($row=$result->fetch()){
                    ?>
                    <tr value="0" value2="0" class="table-rows">
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['day_time'];?></td>
                        <td><?php echo $row['item'];?></td>
                        <td><?php echo $row['total_purchase'];?></td>
                        <td class='stats'><?php echo $row['stats'];?></td>     
                        <td>
                            <a role="button" data-toggle="tooltip" title="Mark row as CANCELLED" class="change2" href='status_cancel.php?order_number=<?php echo $row['id'];?>'><i class="fa fa-ban"></i></a>
                        </td>
                    </tr>  
            <?php }?>   
        </tbody>
    </table>
     

<script src="ecafeScript.js?1"></script>

</body>
</html>

<!-- href='status_success.php?order_number=<//?php echo $row['order_number'];?>' -->
<!-- href='status_cancel.php?order_number=<//?php echo $row['order_number'];?>' -->