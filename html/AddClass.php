<?php
    error_reporting(E_ALL); 
    ini_set('display_errors',1);

    // Connect to the database
    require("DBConnect.php");
    $conn = db_connect();

    class ReturnObject {
        public $success = false;
        public $rowCount = 0;
    }

    $classObject = $_GET["classObject"];

    $classData = json_decode($classObject);

    $studentIds = $classData->studentList;

    $counter = 0;
    $classId = 0;

    $returnObj = new ReturnObject();

    // Adding new class to Class table
    if($classData->classTitle != '' && $classData->classCode != '') {
        $query1 = mysqli_real_escape_string($conn, $Id);
        $query ="INSERT INTO Class (ClassName, ClassNumber, Active) VALUES ( '". $classData->classTitle."','".$classData->classCode."','".$classData->Active."' )";
        mysqli_query($conn, $query);
    }

    // Getting newly created classe's Id
    if ($result = $conn->query("
                SELECT Id
                From Class
                WHERE Class.ClassName = '$classData->classTitle'
                AND Class.ClassNumber = '$classData->classCode'
                AND Class.Active = '$classData->Active'
                Limit 1;
                ")) 
    {
       while ($row = mysqli_fetch_assoc($result)) {
            $classId = $row['Id'];
            $returnObj->rowCount = $classId //Delete
            $returnObj->success = true;     // Delete
       } 
    }

    // // Adds Students to class under EnrolledIn table
    //if(is_array($studentIds)) {
    //     foreach($studentIds as $wheatonId) {

    //         if ($result = $conn->query("
    //             SELECT Id
    //             From User
    //             WHERE User.WheatonId = '$wheatonId'
    //             Limit 1;
    //             ")) 
    //         {
    //             while ($row = mysqli_fetch_assoc($result)) {
    //                 $Id = $row['Id'];
    //                 $query1 = mysqli_real_escape_string($conn, $Id);
    //                 $query ="INSERT INTO EnrolledIn (UserId, ClassId) VALUES ( '". $Id."','".$classId."' )";
    //                 mysqli_query($conn, $query);
    //                 $returnObj->rowCount = $returnObj->rowCount + 1;
                            
    //             }
    //         }
            
    //     }
      //  $returnObj->success = true;
    //}

    echo json_encode($returnObj);

?>
