<?php
  include_once 'products_crud.php';
  include("auth_session.php");
?>

<!DOCTYPE html>
<html>

<style type="text/css">
body {
    background: url(background.jpg) ;
    background-size: cover;
    background-position: center;
}
</style>

<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Photocopiers And Copy Supplies Ordering System : Products</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

  <?php include_once 'nav_bar.php'; ?>

  <div class="container-fluid">
     <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header" style="color: white;">
        <h2>Create New Product</h2>
      </div>
    <form action="products.php" method="post" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
        <label for="productid" class="col-sm-3 control-label" style="color: white;">Product ID</label>
        <div class="col-sm-9">
        <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>
      </div>
      </div>
      <div class="form-group">
        <label for="productname" class="col-sm-3 control-label" style="color: white;">Product Name</label>
        <div class="col-sm-9">
        <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
      </div>
      </div>
      <div class="form-group">
        <label for="productprice" class="col-sm-3 control-label" style="color: white;">Price (RM)</label>
        <div class="col-sm-9">
        <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required> 
      </div>
      </div>
      <div class="form-group">
        <label for="productbrand" class="col-sm-3 control-label" style="color: white;">Brand</label>
        <div class="col-sm-9">
        <input name="brand" type="text" class="form-control" id="productbrand" placeholder="Product Brand" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_brand']; ?>" required> 
      </div>
      </div>
      <div class="form-group">
        <label for="producttype" class="col-sm-3 control-label" style="color: white;">Type</label>
        <div class="col-sm-9">
      <select name="type" class="form-control" id="producttype" required>
        <option value="">Please select</option>
        <option value="PhotoPaper" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="PhotoPaper") echo "selected"; ?>>PhotoPaper</option>
        <option value="Photocopier" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Photocopier") echo "selected"; ?>>Photocopier</option>
        <option value="Catridge" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Catridge") echo "selected"; ?>>Catridge</option>
      </select>
      </div>
      </div>
      <div class="form-group">
        <label for="productwarranty" class="col-sm-3 control-label" style="color: white;">Warranty Length</label>
        <div class="col-sm-9">
        <input name="warranty" type="text" class="form-control" id="productwarranty" placeholder="Product Warranty" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_warranty']; ?>" required>
      </div>
      </div>
      <div class="form-group">
        <label for="productweight" class="col-sm-3 control-label" style="color: white;">Weight (g)</label>
        <div class="col-sm-9">
        <input name="weight" type="text" class="form-control" id="productweight" placeholder="Product Weight" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_weight']; ?>" required>
      </div>
      </div>
      <div class="form-group">
        <label for="productimage" class="col-sm-3 control-label" style="color: white;">Image</label>
        <div class="col-sm-9">
        <input name="fileToUpload" type="file" class="form-control" id="productimage" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_image']; ?>">
      </div>
      </div>
      <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
      <button class="btn btn-default" type="submit" name="create" <?php if ($_SESSION['userLevel']=="Normal Staff"){ ?> disabled <?php } ?>><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
      </div>
      </div>
    </form>
        </div>
      </div>

    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
      <div class="page-header" style="color: white;">
        <h2>Products List</h2>
      </div>
      <table class="table table-bordered" style="background: white;">
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Price(RM)</th>
        <th>Brand</th>
        <th>Type</th>
        <th>Warranty Length</th>
        <th>Weight(g)</th>
        <th></th>
      </tr>
      <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a175838_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?> 
      <tr>
        <td><?php echo $readrow['fld_product_num']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_product_brand']; ?></td>
        <td><?php echo $readrow['fld_product_type']; ?></td>
        <td><?php echo $readrow['fld_product_warranty']; ?></td>
        <td><?php echo $readrow['fld_product_weight']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button" <?php if ($_SESSION['userLevel']=="Normal Staff"){ ?>style="pointer-events: none; opacity: 0.5; "<?php   } ?>> Edit </a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button" <?php if ($_SESSION['userLevel']=="Normal Staff"){ ?>style="pointer-events: none; opacity: 0.5; "<?php   } ?>>Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
      </table>
    </div>
    </div>
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a175838_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>