<?php
  include_once 'staffs_crud.php';
  include("auth_session.php");
?>

<!DOCTYPE html>
<html>
<style type="text/css">
body {
    background: url(background.jpg);
    background-size: cover;
    background-position: center;
}

</style>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Photocopiers And Copy Supplies Ordering System : Staffs</title>
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
        <h2>Create New Staff</h2>
      </div>
    <form action="staffs.php" method="post" class="form-horizontal">
      <div class="form-group">
        <label for="staffid" class="col-sm-3 control-label"  style="color: white;">Staff ID</label>
        <div class="col-sm-9">
        <input name="sid" type="text"  class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>" required> 
        </div>
      </div>
      <div class="form-group">
        <label for="staffname" class="col-sm-3 control-label"  style="color: white;">Staff Name</label>
        <div class="col-sm-9">
        <input name="sname" type="text"  class="form-control" id="staffname" placeholder="Staff Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" required> 
      </div>
      </div>
      <div class="form-group">
        <label for="staffemail" class="col-sm-3 control-label"  style="color: white;">Staff Email</label>
        <div class="col-sm-9">
        <input name="email" type="email"  class="form-control" id="staffemail" placeholder="Staff Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" required> 
      </div>
      </div>
      <div class="form-group">
        <label for="staffposition" class="col-sm-3 control-label"  style="color: white;">Staff Position</label>
        <div class="col-sm-9">
        <input name="position" type="text"  class="form-control" id="staffposition" placeholder="Staff Position" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_position']; ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label for="stafflevel" class="col-sm-3 control-label"  style="color: white;">User Level</label>
        <div class="col-sm-9">
      <select name="level" class="form-control" id="stafflevel" required>
        <option value="">Please select</option>
        <option value="Admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="Admin") echo "selected"; ?>>Admin</option>
        <option value="Normal Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="Normal Staff") echo "selected"; ?>>Normal Staff</option>
      </select>
      </div>
      </div>
      <div class="form-group">
        <label for="staffpassword" class="col-sm-3 control-label"  style="color: white;">Staff Password</label>
        <div class="col-sm-9">
        <input name="spassword" type="Password"  class="form-control" id="staffpassword" placeholder="Staff Password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" required>
        </div>
      </div>
      <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
      <button class="btn btn-default" type="submit" name="create" <?php if ($_SESSION['userLevel']=="Normal Staff"){ ?> disabled <?php   } ?>><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>
      <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
    </div>
    </div>
    </form>
      </div>
   </div>
   <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header"  style="color: white;">
        <h2>Staffs List</h2>
      </div>
      <table class="table table-bordered"  style="background: white;">
      <tr>
        <th>Staff ID</th>
        <th>Staff Name</th>
        <th>Staff Email</th>
        <th>Staff Position</th>
        <th>User Level</th>
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
          $stmt = $conn->prepare("select * from tbl_staffs_a175838_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_staff_num']; ?></td>
        <td><?php echo $readrow['fld_staff_name']; ?></td>
        <td><?php echo $readrow['fld_staff_email']; ?></td>
        <td><?php echo $readrow['fld_staff_position']; ?></td>
        <td><?php echo $readrow['fld_staff_level']; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>" class="btn btn-success btn-xs" role="button" <?php if ($_SESSION['userLevel']=="Normal Staff"){ ?>style="pointer-events: none; opacity: 0.5; "<?php   } ?>> Edit </a>
          <a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button" <?php if ($_SESSION['userLevel']=="Normal Staff"){ ?>style="pointer-events: none; opacity: 0.5; "<?php   } ?>>Delete</a>
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
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175838_pt2 ");
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
            <li><a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
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