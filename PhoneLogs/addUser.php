

<?php
    $aResult = array();

    // if( !isset($_POST['members']) ) { $aResult['error'] = 'No members!'; }
    
    //if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    
    if( !isset($aResult['error']) ) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $userPassword = $_POST['password'];
        $aResult['result'] =getlogs($name, $email, $role, $userPassword);
    }



    echo json_encode($aResult);


    function getlogs($name, $email, $role, $userPassword){

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

        $hashedPw = password_hash($userPassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users`(`email`, `password`, `name`, `role`) VALUES ('$email','$hashedPw','$name','$role')";

        if ($conn->query($sql) === FALSE) {
            die("Oh no");
        }


        return("Success");


    }

