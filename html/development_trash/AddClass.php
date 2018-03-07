<?php
    error_reporting(E_ALL); 
    ini_set('display_errors',1);

    $servername = "127.0.0.1";
    $username = "root";
    $password = "jthklo123";
    $dbname = 'websitedb';

    class ReturnObject {
        public $success = false;
        public $rowCount = 0;
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $classObject = $_GET["classObject"];

    $classData = json_decode($classObject);

    $studentIds = $classData->studentList;

    $classId = 69;

    $counter = 0;

    $returnObj = new ReturnObject();
    if(is_array($studentIds)) {
        foreach($studentIds as $Id) {
            $query1 = mysqli_real_escape_string($conn, $Id);
            $query ="INSERT INTO EnrolledIn (UserId, ClassId) VALUES ( '". $Id."','".$classId."' )";
            mysqli_query($conn, $query);
            $returnObj->rowCount = $returnObj->rowCount + 1;
        }
        $returnObj->success = true;
    }

    echo json_encode($returnObj);

?>
