<!DOCTYPE html>
<html>

<style type="text/css">
body {
    margin: 0;
    padding: 0;
    background: url(background.gif) no-repeat;
    height: 100vh;
    font-family: sans-serif;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    overflow: hidden
}

.loginBox {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 350px;
    min-height: 200px;
    background: #FFFFFF;
    border-radius: 10px;
    padding: 40px;
    box-sizing: border-box
}

.user {
    margin: 0 auto;
    display: block;
    margin-bottom: 20px
}

h3 {
    margin: 0;
    padding: 0 0 20px;
    color: #59238F;
    text-align: center
}

.loginBox input {
    width: 100%;
    margin-bottom: 20px
}

.loginBox input[type="text"],
.loginBox input[type="password"] {
    border: none;
    border-bottom: 2px solid;
    outline: none;
    height: 40px;
    color: black;
    background: transparent;
    font-size: 16px;
    padding-left: 20px;
    box-sizing: border-box
}

.loginBox input[type="text"]:hover,
.loginBox input[type="password"]:hover {
    color: #59238F;
    border: 1px solid;
}

.loginBox input[type="text"]:focus,
.loginBox input[type="password"]:focus {
    border-bottom: 2px solid
}

.inputBox {
    position: relative
}

.inputBox span {
    position: absolute;
    top: 10px;
}

.loginBox input[type="submit"] {
    border: none;
    outline: none;
    height: 40px;
    font-size: 16px;
    background: #59238F;
    color: #fff;
    border-radius: 20px;
    cursor: pointer
}
</style>

<head>
  <title>Photocopiers And Copy Supplies Ordering System : Login</title>
</head>

<body>

<?php
    require('db.php');
    session_start();
    include_once 'database.php';

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // When form submitted, check and create user session.
    if (isset($_POST['login'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        // Check user is exist in the database
        $query = "SELECT * FROM `tbl_staffs_a175838_pt2` WHERE fld_staff_email='$username' and fld_staff_password='".($password) ."'";
        $query2 = "SELECT * FROM `tbl_staffs_a175838_pt2` WHERE fld_staff_email='$username' and fld_staff_password='".($password)."'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        $statement = $conn -> prepare($query2);
        $statement -> execute();
        $result2 = $statement -> fetch();

        if ($rows == 1) {
            if(!empty($result2)){
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $result2["fld_staff_name"];
            $_SESSION['userLevel'] = $result2["fld_staff_level"];
            // Redirect to user index page
            header("Location: index.php");
        }
        } else {
            echo '<script type="text/javascript">'; 
            echo 'alert("Invalid Username or Password. Please Try Again");'; 
            echo 'window.location.href = "login.php";';
            echo '</script>';
        }
    } else {
?>

<form class="form" method="post" name="login">
   <div class="loginBox"> <img class="user" src="login.png" height="100px" width="100px">
    <h3>Sign in here</h3>
    <form action="login.php" method="post">
        <div class="inputBox"> 
          <input id="username" type="text" name="username" placeholder="Username" required> 
          <input id="password" type="password" name="password" placeholder="Password" required> 
        </div> 
        <input type="submit" name="login" value="Login">
  </div>
</form>
<?php
    }
?>
  </body>
</html>