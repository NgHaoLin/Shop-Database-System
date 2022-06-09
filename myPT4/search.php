<?php
  include_once 'database.php';
  include("auth_session.php");
  $query = "SELECT * From tbl_products_a175838_pt2"
?>

<!DOCTYPE html>
<html>
<style type="text/css">
body {
    background: url(background1.jpg);
    background-size: cover;
    background-position: center;
}

</style>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Photocopiers And Copy Supplies Ordering System : Searching Form</title>
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
        <h2>Searching Form</h2>
      </div>

    <form action="search.php" method="post" class="form-horizontal" onsubmit="return validateForm()">
        <div class="form-group">
          <div class="col-sm-9"> 
            <input name="searchid" type="text" class="form-control" placeholder="name / brand / type" id="searchid"> 
          </div>
            <button class="btn btn-primary" type="submit" name="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button> 
        </div>
    </form>
  </div>
</div>

<?php
  
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //Search
  if (isset($_POST['search'])) {
    $searchValue = $_POST['searchid'];
    $tokenize = strtok($searchValue, "\t\n");
    $array = array();

    $keyword = explode(" ", $searchValue);
    $conditions = '';
    foreach($keyword as $word){
      $conditions .= "fld_product_name LIKE '%$word%' OR fld_product_brand LIKE '%$word%' OR fld_product_type LIKE '%$word%' OR ";
    }
    $conditions = substr($conditions, 0, -4);

    while($tokenize!=false){
      array_push($array, "$tokenize");
      $tokenize = strtok(" \n\t");
    }

    if(count($keyword )>3){
      $query = "SELECT * From `tbl_products_a175838_pt2` WHERE CONCAT(`fld_product_name`,`fld_product_brand`,`fld_product_type`)REGEXP '$array[0]'";
    }

    else if(count($keyword )<=3){
        $query = "SELECT * FROM tbl_products_a175838_pt2 WHERE $conditions";
    }
  }
  else{
    $query = "SELECT * From tbl_products_a175838_pt2";
  }
    $conn = null;
?>

  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <?php
            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $conn->prepare("$query");
              $stmt->execute();
              $result = $stmt->fetchAll();
            }
            catch(PDOException $e){
              echo "Error: " . $e->getMessage();
            }
            foreach($result as $readrow) {
              ?> 
          <div class="col-md-4">
            <div style="background: white;">
            <div class="product text-center"> 
              <div style="height: 195px;">
                <div class="w-100 p-3">
              <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive" width="150px" height="150px">
              </div>
            </div>

              <div style="height: 140px;">
                <div class="w-100 p-3">
                <div class="about text-left px-3">
                    <h4><?php echo $readrow['fld_product_num']; ?> <?php echo $readrow['fld_product_name']; ?></h4> 
                    <span class="text-muted"><?php echo $readrow['fld_product_brand']; ?> |</span>
                    <span class="text-muted"><?php echo $readrow['fld_product_type']; ?> |</span>
                    <span class="text-muted"><?php echo $readrow['fld_product_warranty']; ?> |</span>
                    <span class="text-muted"><?php echo $readrow['fld_product_weight']; ?></span>
                    <h4>RM <?php echo $readrow['fld_product_price']; ?></h4>
                </div>
                </div>
                </div> 
            </div>
            </div><br>
          </div>
          <?php
          }
            $conn = null;
          ?>
</div>
</div>
</div>


  <script type="text/javascript">
 
  function validateForm() {
      var x = document.getElementById("searchid").value;
      if (x == null || x == "") {
          alert("Searching cannot be empty!");
          document.getElementById("searchid").focus();
          return false;
      }
    
      return true;
  }
 
  </script>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>