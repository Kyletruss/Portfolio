
<?php
        // require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-config.php';
    $aResult = array();

    if( !isset($_POST['firstName']) && !isset($_POST['lastName']) && !isset($_POST['email']) && !isset($_POST['message'])) { $aResult['error'] = 'Error in function arguments!'; }
    
    if( !isset($aResult['error']) ) {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $aResult['result'] =getlogs($firstName, $lastName, $email, $message);

    }


    echo json_encode($aResult);


    function getlogs($firstName, $lastName, $email, $message){


        $host = "localhost";
        $username = "phonelogsapp";
        $password = "mypassword";
        $dbName = "phonelogsapp";

        $conn = new mysqli($host, $username, $password, $dbName);

        if ($conn->connect_error) {
            return("db connection failed");
            // die("Connection failed: " . $conn->connect_error . "<br><br><br><br>");
        }

        $sql = "INSERT INTO feedback(`first_name`, `last_name`, `email`, `message`) VALUES ('" . $firstName  . "', '" . $lastName  . "', '" . $email  . "', '" . $message . "');";
        // $sql = "INSERT IGNORE INTO zoom_phone_logs SELECT FROM zoom_phone_logs_test;";
        if ($conn->query($sql) === FALSE) {
            return($conn->error);
        }
        else{
            return("Success");
        }


    }

