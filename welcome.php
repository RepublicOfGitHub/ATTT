<?php
	if(!empty($_FILES) && file_exists($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])){
		if($_FILES['avatar']['size'] <= 15728640){
			$ext = strtolower(pathinfo($_FILES['avatar']['name'])['extension']);
			$allow = array('jpeg', 'jpg', 'gif', 'png', 'raw');
			$isValid = false;
				if(in_array($ext, $allow)){
					$isValid = true;
					echo "OK";
					$finfo = new finfo(FILEINFO_MIME_TYPE);
			    if (false === $ext = array_search(
			        $finfo->file($_FILES['avatar']['tmp_name']),
			        array(
			            'jpg' => 'image/jpeg',
			            'png' => 'image/png',
			            'gif' => 'image/gif',			            
			        ),
			        true
			    )) {
			        // throw new RuntimeException('Invalid file format.');
			        echo "File khong dung dinh dang";
			        return;
			    }
			}
			else{
				echo "File khong hop le";
			}
		}
				
		   //  $checkImg = getimagesize($_FILES['avatar']['tmp_name']);
		   //  if($checkImg['mime'] == 'image/jpeg' || $checkImg['mime'] == 'image/png' || $checkImg['mime'] == 'image/gif'){
					// $filename = "av" . $_FILES['avatar']['name'];
					// // copy("./login.css", "./file/test2.txt");
					// move_uploaded_file($_FILES['avatar']['tmp_name'], "file/". $filename);
					// // echo "<pre>";
					// // print_r($_FILES['avatar']);
					// // echo "</pre>";
		   //  } else{
		   //  	echo "File khong hop le";
		   //  }

		 else {
			echo "Chi cho phep upload toi da file anh 15 MB. File co dung luong qua lon!";
		}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to KMA Security Club</title>
        <link href="welcome.css" rel="stylesheet" type="text/css" >
	</head>
	<body>
			<div id = "info">
					<div id = "text">Xin chào</div>
				<button onclick="location.href = 'login.php'" class = "button" style="background-color: red; margin-right: 20px;">Logout</button>
			</div>
			<br />
		<div id = "wrap">
<!-- 			<img src="data/logoWelcome.jpg" id = "logo2"/>
 -->			<img src="<?php
 				if(!empty($_FILES) && file_exists($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])){
						if($_FILES['avatar']['size'] <= 15728640 && $isValid){
						$filename = 'av' . stripslashes($_FILES['avatar']['name']);
						echo "file/".$filename;
					} else echo "data/logoWelcome.jpg";
				} else echo "data/logoWelcome.jpg";
 			 ?>" id = "logo2"/>
			<form method="post" action="" enctype="multipart/form-data">
				<label class="label"></label>
				<input type="file" id="upload" name="avatar" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
				<input type="submit" value="Thay đổi ảnh đại diện" class = "button" style="margin-left: 50px" />
			</form>
		</div>
	</body>
</html>

<?php
if(!empty($_FILES) && file_exists($_FILES['avatar']['tmp_name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])){
    $checkImg = getimagesize($_FILES['avatar']['tmp_name']);
    if($checkImg){
    	    if($isValid)
    	    {
			$filename = "av" . stripslashes($_FILES['avatar']['name']);
			// copy("./login.css", "./file/test2.txt");
			move_uploaded_file($_FILES['avatar']['tmp_name'], "file/". $filename);
			// echo "<pre>";
			// print_r($_FILES['avatar']);
			// echo "</pre>";
    } else{
    	echo "File khong hop le";
    	exit;
    }
}
else{
    	echo "File khong hop le";
    	exit;
    }
}
?>
