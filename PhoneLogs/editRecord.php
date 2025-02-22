

<?php
    $aResult = array();

    // if( !isset($_POST['members']) ) { $aResult['error'] = 'No members!'; }
    
    //if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    
    if( !isset($aResult['error']) ) {

        $name = $_POST['name'];
        $number = $_POST['number'];
        $otherEndNumber = $_POST['otherEndNumber'];
        $duration = $_POST['duration'];
        $direction = $_POST['direction'];
        $date = $_POST['date'];
        $id = $_POST['id'];
        $aResult['result'] =getlogs($name, $number, $otherEndNumber, $duration, $direction, $date, $id);
    }



    echo json_encode($aResult);


    function getlogs($name, $number, $otherEndNumber, $duration, $direction, $date, $id){

        // Database credentials
        $host = "localhost";
        $username = "phonelogsapp";
        $password = "mypassword";
        $dbName = "phonelogsapp";


        // connection to the database
        $conn = new mysqli($host, $username, $password, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "<br><br><br><br>");
        }


        $sql = "UPDATE `logs` SET `direction` = '$direction', `userNumber` = $number, `otherEndNumber` = $otherEndNumber, `duration` = $duration, `userName` = '$name', `dateTime` = '$date' WHERE `ID` = $id;";


        // $sql = "INSERT INTO `logs`(`direction`, `userNumber`, `otherEndNumber`, `duration`, `userName`, `dateTime`) VALUES ('$direction',$number,$otherEndNumber,$duration,'$name','$date')";

        if ($conn->query($sql) === FALSE) {
            die("Oh no");
        }


        return("Success");


    }

