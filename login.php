<?php
    if(isset($_POST['action']) && $_POST['action'] == 'REGISTER'){
        header('Location: register.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN PAGE</title>
        <link href="login.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div id = "ParentForm" style="padding: 90px;">
        <table style="border-width: 2px;">
            <tr>
                <td>
                    <span><img src="data/logoLogin.jpg" style="margin-right: 100px; margin-left: 100px ;width: 250px; height: 250px; border-radius: 10px;" /></span>
                </td>
            <td>
	        <font size="+8" style="font-weight: bold; color: #B5C689">LOGIN</font>
      			<br />
  		  		<br />
	        <form method="post" action="">
                <table class="table">
	        	<tr>
	        		<td class="title">Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        			<td><input type="text" name="username" class = "input"></td>
	        	</tr>
<!-- 
        		<br /> -->
        		<tr>
	        		<td class="title">Password: </td>
        			<td><input type="password" name="password" class = "input"></td>
        		</tr>
<!--         		
        		<br />
        		<br /> -->
                </table>
                <br />
                <input type="submit" name="action" value="REGISTER" style="margin-right: 25px;" class = "button">
        		<input type="submit" value="LOGIN" class = "button" style="background-color: #43ABC9" />
	        </form>
            <?php
                if(!empty($_POST["username"]) && !empty($_POST["password"])){
                    $connect = new mysqli("127.0.0.1", "Admin2", "UserAd1212@@", "test2");
                    mysqli_set_charset($connect, "utf8");
                    if($connect->connect_error){
                        //var_dump($connect->connect_error);
                        die('Loi connect');
                    } else{
                        $username = mysqli_real_escape_string($connect, $_POST["username"]);
                        $password = mysqli_real_escape_string($connect, $_POST["password"]);
                        // $query = "SELECT * FROM user WHERE (username = '". $username ."' && password = '". $password ."')";
                        $query = "SELECT password FROM user WHERE (username = '". $username ."')";
                        $isExist = mysqli_query($connect, $query);
                        // echo $query; //XSS error
                        // var_dump($isExist);
                        // print_r($isExist);
                        $NumUser = $isExist->num_rows;
                        // echo $_POST["password"];
                        // echo $isExist;
                        // CACH 2
                        // $data = [];
                        // while ($row = mysqli_fetch_array($isExist, 1)) {
                        //     $data[] = $row;
                        // }
                        // print_r($data[0]["COUNT(*)"]);

                        if($NumUser > 0){
                            while($row = $isExist->fetch_assoc()) {
                                if(password_verify($password, $row['password'])){
                                    // echo "<br /> <br /><div>Dang nhap thanh cong</div>";
                                    header("Location: welcome.php");
                                    die;
                                }
                            };
                            echo "<br /><br/><div style='font-size: 20px; color: #FFA07A'>Sai tên đăng nhập hoặc mật khẩu</div>";
                        } else{
                            echo "<br /><br/><div style='font-size: 20px; color: #FFA07A'>Sai tên đăng nhập hoặc mật khẩu</div>";
                        }
                    }
                }
            ?>
            </td>
            </tr>
            </table>
        </div>
    </body>
</html>