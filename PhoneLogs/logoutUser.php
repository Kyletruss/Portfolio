
<?php

    if( !isset($_POST['email'])) { $aResult['error'] = 'No email!'; }
    
    if( !isset($aResult['error']) ) {


        $email = $_POST['email'];
        $aResult['result'] =checkAuth($email);

    }


    echo json_encode($aResult);


    function checkAuth($email){

        // Database credentials
        $host = "localhost";
        $username = "phonelogsapp";
        $dbpassword = "mypassword";
        $dbName = "phonelogsapp";



        


        // connection to the database
        $conn = new mysqli($host, $username, $dbpassword, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "<br><br><br><br>");
        }

        $sql = "SELECT * FROM users WHERE email = '$email';";
        $result = $conn->query($sql);

        // Check to make sure that there is an email that matches in the database before attempting to log out
        if ($result->num_rows == 1) {
            $sql = "UPDATE users SET sessionID = NULL, lastIP = NULL WHERE email = '$email';";
            if ($conn->query($sql) === FALSE) {
                return($conn->error);
            }
            return("Logout successfull");
        }
        if($result->num_rows > 1){
            return ("More than one user!");
        }
        else{
            return("Email does not exist");
        }
        return("Test");

    }
