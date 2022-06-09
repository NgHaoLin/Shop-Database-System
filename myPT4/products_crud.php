<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {
  if($_FILES["fileToUpload"]["tmp_name"] == ""){
    echo '<script>alert("Please upload a products GIF file.")</script>';
  }

  else{
  $target_dir = "products/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo '<script>alert("File is not an image.")</script>';
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo '<script>alert("Sorry, your file is too large. Max 10 MB is allowed")</script>';
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "gif" ) {
    echo '<script>alert("Sorry, only GIF files are allowed.")</script>';
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    unlink($target_file);
    $uploadOk = 1;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo '<script>alert("Sorry, your file was not uploaded.")</script>';
  // if everything is ok, try to upload file
  } 

  else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a175838_pt2(fld_product_num,
        fld_product_name, fld_product_price, fld_product_brand, fld_product_type,
        fld_product_warranty, fld_product_weight, fld_product_image) VALUES(:pid, :name, :price, :brand,
        :type, :warranty, :weight, :picture)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':warranty', $warranty, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
      $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $warranty = $_POST['warranty'];
    $weight = $_POST['weight'];
    $picture = $_FILES["fileToUpload"]["name"];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  } else {
    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
  }
  } 
  } 
}

//Update
if (isset($_POST['update'])) {
  if($_FILES["fileToUpload"]["tmp_name"] != ""){
  $target_dir = "products/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo '<script>alert("File is not an image.")</script>';
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo '<script>alert("Sorry, your file is too large. Max 10 MB is allowed")</script>';
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "gif" ) {
    echo '<script>alert("Sorry, only GIF files are allowed.")</script>';
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    unlink($target_file);
    $uploadOk = 1;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo '<script>alert("Sorry, your file was not uploaded.")</script>';
  // if everything is ok, try to upload file
  } 

   else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a175838_pt2 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand,
        fld_product_type = :type, fld_product_warranty = :warranty, fld_product_weight = :weight, fld_product_image = :picture
        WHERE fld_product_num = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':warranty', $warranty, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
      $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $warranty = $_POST['warranty'];
    $weight = $_POST['weight'];
    $picture = $_FILES["fileToUpload"]["name"];
    $oldpid = $_POST['oldpid'];

    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
  else {
    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
  }
  } 
  }
  else{
    try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a175838_pt2 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand,
        fld_product_type = :type, fld_product_warranty = :warranty, fld_product_weight = :weight
        WHERE fld_product_num = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':warranty', $warranty, PDO::PARAM_STR);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $warranty = $_POST['warranty'];
    $weight = $_POST['weight'];
    $oldpid = $_POST['oldpid'];

    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
  } 
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a175838_pt2 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a175838_pt2 WHERE fld_product_num = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>