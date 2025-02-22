

<?php
    $aResult = array();

    // if( !isset($_POST['members']) ) { $aResult['error'] = 'No members!'; }
    
    //if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    
    if( !isset($aResult['error']) ) {

        $id = $_POST['id'];
        $aResult['result'] =getlogs($id);
    }



    echo json_encode($aResult);


    function getlogs($id){

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


        $sql = "DELETE FROM `logs` WHERE `ID` = $id;";

        // $sql = "INSERT INTO `logs`(`direction`, `userNumber`, `otherEndNumber`, `duration`, `userName`, `dateTime`) VALUES ('$direction',$number,$otherEndNumber,$duration,'$name','$date')";

        if ($conn->query($sql) === FALSE) {
            die("Oh no");
        }


        return("Success");


    }

