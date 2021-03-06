<!-- // SELECT Video.Title, Class.ClassName, Class.ClassNumber
FROM Video
INNER JOIN ClassVideo on Video.Id = ClassVideo.VideoId
INNER JOIN Class on Class.Id = ClassVideo.ClassId
WHERE Class.Id = 1-->

<?php
    //This code does not work yet!
	error_reporting(E_ALL); 
	ini_set('display_errors',1);

    // Connect to the database
    require("DBConnect.php");
    $conn = db_connect();	
    
    class ReturnObject {
        public $success = false;
        public $classes = "";
    }
    class ClassObject {
        public $Title = "";
        public $ClassName = "";
        public $ClassNumber = "";
    }

	$classId=$_GET["classId"];
	$class_array = array();

	if ($result = $conn->query("
        SELECT Video.Title, Class.ClassName, Class.ClassNumber
        FROM Video
        INNER JOIN ClassVideo on Video.Id = ClassVideo.VideoId
        INNER JOIN Class on Class.Id = ClassVideo.ClassId
        WHERE Class.Id = '$classId'")) 
	{
		while ($row = mysqli_fetch_assoc($result)) {
            $newClassList =new ClassObject();
            $newClassList->FirstName = $row['FirstName'];
            $newClassList->LastName = $row['LastName'];
			$newClassList->Title = $row['ClassName'];
			$newClassList->Number = $row['ClassNumber'];
			array_push($class_array, $newClassList);
			
        }
        
        if (count($class_array) > 0) {
            $returnObj = new ReturnObject();
            $returnObj->success = True;
            $returnObj->classes = $class_array;
            echo json_encode($returnObj);
        }
        else {
            $returnObj = new ReturnObject();
            $returnObj->success = False;
            $returnObj->error = "Videos found in database, but fetch/push failed";
            echo json_encode($returnObj);
        }
    } 
    else {
        $returnObj = new ReturnObject();
        $returnObj->success = False;
        $returnObj->error = "No classes found in database";
        echo json_encode($returnObj);
    }
    $result->close();
		/* free result set */

?>