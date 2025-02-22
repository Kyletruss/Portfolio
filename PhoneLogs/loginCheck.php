<?php
    // detect if there is a session
    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    }


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

    // get the user that matches the last ip
    $sql = "SELECT * FROM users WHERE lastIP = '" . $_SERVER['REMOTE_ADDR'] . "';";
    $result = $conn->query($sql);
    $loggedIn = false;


    // if the user has a matching ip and session id, get al of the users data, if not, have them log in
    if ($result->num_rows == 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // if the session does not match the latest session id, direct the user to the login page
            if($row["sessionID"] != session_id()){
                header('Location: login.php');
                die();
                
            }
            else{
                $userEmail = $row["email"];
                $userName = $row["name"];
                $role = $row["role"];
                $loggedIn = true;
                // echo($userEmail . "<br>");
                // echo($userName . "<br>");
                // echo($role . "<br>");
                
            }
        }
    }
    else{
        header('Location: login.php');
        die();
    }




    // if(isset($_SESSION["login"])){
    // echo("Checked for login session variable<br>");

    // if($_SESSION["login"] != true){
    //     header('Location: login.php');
    //     die();

    // }

    // }
    // else{
    // echo("No login session variable<br>");
    // header('Location: login.php');
    // die();
    // }


?>