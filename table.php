<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Log In";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Item</title>
        <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/metisMenu.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.min.css">
        
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        
        <link rel="stylesheet" href="assets/css/typography.css">
        <link rel="stylesheet" href="assets/css/default-css.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    
    <body>
        <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php">NOV Inventory</a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li class="active">
                                <a href="table.php" aria-expanded="true"><i class="fa fa-table"></i>
                                <span>Item Records</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="header-area">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-8 clearfix">
                    </div>
                    
                    <div class="col-md-6 col-sm-4 clearfix">
                        
                    </div>
                </div>
            </div>
            
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                
                               <a class="dropdown-item" href="index.php?logout='1'">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                
            <h1 style="text-align:center">Add Items</h1>
            
            <body>
                <form method="POST" class="form-inline" action="additem.php">
                    <div class="form-group">
                        <label for="name">Item Name</label>
                        <input type="text" class="form-control" name="product_name">
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input type="text" class="form-control" name="price">
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Quantity</label>
                        <input type="number" name="quant" id="quant" min="1" max="">
                    </div>
                    <button type="submit" class="btn btn-default" name="add">ADD</button>
                </form>
            </body>
            
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Items</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Option</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $conn = new mysqli("localhost","root","","ivm");
                                                $sql = "SELECT * FROM product";
                                                
                                                $result = $conn->query($sql);
                                                $count=0;
                                                if ($result -> num_rows >  0) {
                                                    
                                                    while ($row = $result->fetch_assoc()){
                                                        $count=$count+1;
                                                        
                                                        ?>
                                                        
                                                        <tr>
                                                            <th><?php echo $count ?></th>
                                                            <th><?php echo $row["product_name"]?></th>
                                                            <th><?php echo $row["price"]?></th>
                                                            <th><?php echo $row["quantity"]?></th>
                                                            <th> <a href="up"Edit></a><a href="edit.php?id=<?php echo $row["product_id"] ?>">Edit</a> <a href="up"Edit></a><a href="delete.php?id=<?php echo $row["product_id"] ?>">Delete</a></th>
                                                        </tr>
                                                        
                                                        <?php
                                                        }
                                                    }
                                                    
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>

                            </div>
                        </div>
                        
                        <html>
                            <head>
                                <title>Add Item</title>
                                <link rel="stylesheet" type="text/css" href="style.css">
                                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
                            </head>
                        </html>
                    </div>
                    
                    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
                    <script src="assets/js/popper.min.js"></script>
                    <script src="assets/js/bootstrap.min.js"></script>
                    <script src="assets/js/owl.carousel.min.js"></script>
                    <script src="assets/js/metisMenu.min.js"></script>
                    <script src="assets/js/jquery.slimscroll.min.js"></script>
                    <script src="assets/js/jquery.slicknav.min.js"></script>
                    
                    <script src="assets/js/plugins.js"></script>
                    <script src="assets/js/scripts.js"></script>
                
                </body>
                </html>
