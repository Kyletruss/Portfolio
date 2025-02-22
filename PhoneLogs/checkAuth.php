
<?php
        // require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-config.php';
    $aResult = array();
    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    if( !isset($_POST['email']) && !isset($_POST['password'])) { $aResult['error'] = 'Error in function arguments!'; }
    
    if( !isset($aResult['error']) ) {


        $email = $_POST['email'];
        $password = $_POST['password'];
        $aResult['result'] =checkAuth($email, $password);

    }


    echo json_encode($aResult);


    function checkAuth($email, $password){

        // Database credentials
        $host = "localhost";
        $username = "phonelogsapp";
        $dbpassword = "mypassword";
        $dbName = "phonelogsapp";

        // $hash = password_hash($password, PASSWORD_DEFAULT);




        


        // connection to the database
        $conn = new mysqli($host, $username, $dbpassword, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "<br><br><br><br>");
        }

        $sql = "SELECT * FROM users WHERE email = '$email';";
        $result = $conn->query($sql);


        if ($result->num_rows == 1) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                // $tempPass = $row["password"];

                // return($tempPass);

                // Example of industry-appropriate security features
                if(password_verify($password, $row["password"])) {
                    $sql = "UPDATE users SET sessionID = '" . session_id() . "', lastIP = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE email = '$email';";
                    if ($conn->query($sql) === FALSE) {
                        return($conn->error);
                    }
                    return("Login Validated");
                } 
                else{
                    return("Password Incorrect");
                }


                // if($row["password"] == $password){

                //     $sql = "UPDATE users SET sessionID = '" . session_id() . "', lastIP = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE email = '$email';";
                //     if ($conn->query($sql) === FALSE) {
                //         return($conn->error);
                //     }
                //     // return($sql);
                //     return("Login Validated");
                // }
                // else{
                //     return("Password Incorrect");

                // }
            }
        }
        if($result->num_rows > 1){
            return ("More than one user!");
        }
        else{
            return("Email does not exist");
        }
        return("Test");

    }
