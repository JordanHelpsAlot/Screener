<?php
/*
	$tmp_file = $_FILES['image']['tmp_name'];
	$filename = $_FILES['image']['name'];


	// Directory for uploads should be as follows:
	//		-UploadFolder/TeacherUserName/ClassCode/$filename
	// This will ensure that we keep all files organized on server while uploading.
	$t=time();
	$target_address = 'video/'.$t.$filename;

	if(move_uploaded_file($tmp_file,$target_address)){
		error_log("it worked", 3, "/home/screener/log/php.log");
	}
	else {
		error_log($target_address, 3, "/home/screener/log/php.log");
	}

	$name=$_POST['name'];
	$duedate=$_POST['duedate'];
	$runtime=$_POST['runtime'];
*/
 // Connect to the database
	require("DBConnect.php");
	$conn = db_connect();
	/*
	$sql = "INSERT INTO Video(Title,URL,Active)VALUES ('$name', '$target_address', 1);";

	if ($conn->query($sql) === TRUE) {
		$sql = "SELECT id FROM Video WHERE URL= '$target_address'";
		if ($result = $conn->query($sql)) {
			if ($row = mysqli_fetch_assoc($result)) {
				error_log("inside if2, ", 3, "/home/screener/log/php.log");
				$videoid= $row['id'];
				$classid=0;
				error_log(" ".$videoid." ", 3, "/home/screener/log/php.log");
				//echo $videoid;
				foreach($_POST['classopt'] as $selected){
					error_log($selected." ", 3, "/home/screener/log/php.log");
					$classid=(int)$selected;
					$sql=" INSERT INTO ClassVideo(ClassId,VideoId) VALUES($classid,$videoid);";
					if($conn->query($sql){
						error_log(" We ARE crazy ", 3, "/home/screener/log/php.log");
					}
				}
			}
		}
	}
	*/
	echo "Hello";

?>

