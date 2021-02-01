<?php
    if(isset($_POST['action']) && $_POST['action'] == 'LOGIN'){
        header('Location: login.php');
        exit;
    }
    session_start();
    if(!empty($_POST["username"]) && !empty($_POST["password"]) && trim($_POST["username"]) != '' && trim($_POST["password"]) != '')
    {
        $connect = new mysqli("localhost", "Admin", "UserAd1212@@", "test2");
        mysqli_set_charset($connect, "utf8");
        if($connect->connect_error){
            //var_dump($connect->connect_error);
            die();
        } else{
            $username = mysqli_real_escape_string($connect, $_POST["username"]);
            $password = mysqli_real_escape_string($connect, $_POST["password"]);
            if(!empty($_POST["name"])){
            $name = mysqli_real_escape_string($connect, $_POST["name"]);
            } else {
                $name = null;
            }
            if(!empty($_POST["email"])){
            $email = mysqli_real_escape_string($connect, $_POST["email"]);
            } else {
                $email = null;
            }
            if(!empty($_POST["phonenumber"])){
            $phonenumber = mysqli_real_escape_string($connect, $_POST["phonenumber"]);
            } else {
                $phonenumber = null;
            };                              

            $count = "SELECT COUNT(*) FROM user";
            $countUser = "SELECT * FROM user WHERE username = '". $username ."'";
            $isExist = mysqli_query($connect, $countUser);
            $isExist = $isExist->num_rows;
            if($isExist > 0){
                // header("Location: register.php?name=". $name ."&username=&phonenumber=". $phonenumber ."&email=". $email ."&password=");
                $_SESSION['isRegister'] = false;
                // echo "<br /> <div style='color: red; font-weight: bold; font-size: 16px'>Tên đăng nhập đã tồn tại</div>";
            } else{
                $NumberOfRows = mysqli_query($connect, $count);
                $NumberOfRows = mysqli_fetch_array($NumberOfRows)[0];
                // $char = '0123456789abcdefghijklmnopqrstuvwxyz';
                // $id = '';
                // for($i = 1; $i<=3; ++$i){
                //     $id .= $char[rand(0, 35)];
                // }

                // $id .= $NumberOfRows+1;
                $id = uniqid();
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO user(id, name, username, phonenumber, email, password) VALUES ('".$id."', '".$name."', '".$username."', '".$phonenumber."', '".$email."', '".$password."')";
                mysqli_query($connect, $query);
                $_SESSION['isRegister'] = true;
                // echo "<br /><div style=font-weight: bold; font-size: 16px'>Đăng ký thành công!</div>";

                }
            $connect->close();
        }

    }
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>
        <title>Sign up</title>
        <link href="login.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div id = "ParentForm">
            <table style="border-width: 2px;">
                <tr>
                    <td>
                        <span><img src="data/logoLogin.jpg" style="margin-right: 100px; margin-left: 100px ;width: 250px; height: 250px; border-radius: 10px;" /></span>
                    </td>
                <td>
<!--             <div id = "form2">
 -->                    <font size="+8" style="font-weight: bold; color: white" id = "caption">REGISTER</font>
                    <br />
                    <br />
                    <form method="post" action="" id = "form">
                        <table class="table">
                            <tr>
                                <td class="title">Name: </td>
                                <td><input type="text" name="name" class = "input" value="<?php
                                    if((!empty($_POST['name'])) && ((!isset($_SESSION['isRegister'])) || $_SESSION['isRegister'] == false)){
                                        echo htmlspecialchars($_POST['name']);
                                    }
                                 ?>"></td>
                            </tr>
                            <tr>
                                <td class="title">Username: </td>
                                <td><input type="text" name="username" class = "input"></td>
                            </tr>

                            <tr>
                                <td class="title">Phone number:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><input type="number" name="phonenumber" class = "input" value="<?php
                                    if((!empty($_POST['phonenumber'])) && ((!isset($_SESSION['isRegister'])) || $_SESSION['isRegister'] == false)){
                                        echo htmlspecialchars($_POST['phonenumber']);
                                    }
                                 ?>"></td>
                            </tr>


                            <tr>
                                <td class="title">Email: </td>
                                <td><input type="email" name="email" class = "input" value="<?php
                                    if((!empty($_POST['email'])) && ((!isset($_SESSION['isRegister'])) || $_SESSION['isRegister'] == false)){
                                        echo htmlspecialchars($_POST['email']);
                                    }
                                 ?>"></td>
                            </tr>

                            <tr>
                                <td class="title">Password: </td>
                                <td><input type="password" name="password" class = "input"></td>
                            </tr>
                        </table>
                        <br />
                            <input type="submit" name="action" value="LOGIN" style="margin-right: 25px; background-color: #43ABC9;" class = "button">
                            <input type="submit" value="REGISTER" class = "button"/>
                    </form>
                    <?php
                        if(isset($isExist)){
                            if($isExist > 0){
                                echo "<br /><div style='color: #FFA07A; font-weight: bold; font-size: 16px'>Đăng ký thất bại</div>";
                            } else{
                                echo "<br /><div style='font-weight: bold; font-size: 16px; color: #43ABC9;''>Đăng ký thành công!</div>";
                                }
                            }
                    ?>
<!--                 </div>
 -->                </td>
            </tr>
            </table>

            </div>

         </body>
</html>


