<!DOCTYPE html>
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "loginapp");
	
$message = "";
if(!empty($_POST["login"])) {
	$result = mysqli_query($conn,"SELECT * FROM users WHERE userName='" . $_POST["username"] . "' and password = '". $_POST["password"]."'");
	$row  = mysqli_fetch_array($result);
	if(is_array($row)) {
	   $_SESSION["userId"] = $row['userId'];
	} else {
	   $message = "Invalid Username or Password!";
	}
}
if(!empty($_POST["logout"])) {
	$_SESSION["userId"] = "";
	session_destroy();
}
?>
<html>
    <head>
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div>
            <div style="display:block;margin:0px auto;">
                <?php if(empty($_SESSION["userId"])) { ?>
                <form action="" method="post" id="frmLogin">
                    <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>	
                    <div class="field-group">
                        <div>
                            <label for="login">Username</label>
                        </div>
                        <div>
                            <input name="username" type="text" class="input-field">
                        </div>
                    </div>
                    <div class="field-group">
                        <div>
                            <label for="password">Password</label>
                        </div>
                        <div>
                            <input name="password" type="password" class="input-field">
                        </div>
                    </div>
                    <div class="field-group">
                        <div>
                            <input type="submit" name="login" value="Login" class="form-submit-button">
                        </div>
                    </div>       
                </form>
                <?php 
                } else { 
                $result = mysqlI_query($conn,"SELECT * FROM users WHERE userId='" . $_SESSION["userId"] . "'");
                $row  = mysqli_fetch_array($result);
                ?>
                <form action="" method="post" id="frmLogout">
                    <div class="member-dashboard">
                        Welcome <?php echo ucwords($row['displayName']); ?>, You have successfully logged in!<br>Click to <input type="submit" name="logout" value="Logout" class="logout-button">.
                    </div>
                </form>
                </div>
            </div>
            <?php } ?>
    </body>
</html>