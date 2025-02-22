

<?php
    $aResult = array();

    // if( !isset($_POST['members']) ) { $aResult['error'] = 'No members!'; }
    
    //if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    
    if( !isset($aResult['error']) ) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $userPassword = $_POST['password'];
        $id = $_POST['id'];
        $aResult['result'] =editUser($name, $email, $role, $userPassword, $id);
    }



    echo json_encode($aResult);


    function editUser($name, $email, $role, $userPassword, $id){

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



        // // get the user that matches the last ip
        // $sql = "SELECT * FROM users WHERE id = '$id';";
        // $result = $conn->query($sql);
        // $loggedIn = false;


        // // if the user has a matching ip and session id, get al of the users data, if not, have them log in
        // if ($result->num_rows == 1) {
        //     // output data of each row
        //     while($row = $result->fetch_assoc()) {
        //         return($row["email"]);
        //     }   
        // }



        $sql = "UPDATE `users` SET `email` = '$email', `password` = '$hashedPw', `name` = '$name', `role` = '$role' WHERE id='$id'";
        // return($sql);
        if ($conn->query($sql) === FALSE) {
            die("Oh no");
        }



        return("Success");


    }

