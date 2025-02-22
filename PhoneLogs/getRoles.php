

<?php
    $aResult = array();

    // if( !isset($_POST['members']) ) { $aResult['error'] = 'No members!'; }
    
    //if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    
    if( !isset($aResult['error']) ) {


        $aResult['result'] =getUsers();
    }



    echo json_encode($aResult);


    function getUsers(){


    $data = array(); 
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



    $sql = "SELECT * FROM `roles`;";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            array_push($data, $row["roleName"]);
        }
    }

        


        return($data);

    }

