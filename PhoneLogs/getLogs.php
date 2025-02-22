

<?php
    $aResult = array();

    // if( !isset($_POST['members']) ) { $aResult['error'] = 'No members!'; }
    
    //if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    
    if( !isset($aResult['error']) ) {

        $date = $_POST['date'];
        $startRowNum = $_POST['startRowNum'];
        $endRowNum = $_POST['endRowNum'];
        $aResult['result'] =getlogs($date, $startRowNum, $endRowNum);
    }



    echo json_encode($aResult);


    function getlogs($date, $startRowNum, $endRowNum){


        $data = array(); 

        // if(!isset($date)){
        //     $now = time();
        //     // $beginning_of_day = strtotime("midnight", $now);
        //     $beginningOfDay = strtotime("midnight", $now);
        //     $from = date("Y-m-d H:m:s", $beginningOfDay);
        //     $to = date("Y-m-d H:m:s");
        //     // return($date);
        // }
        // else{
        //     $from = date("Y-m-d H:m:s",strtotime($date[0]));
        //     $to = date("Y-m-d H:m:s", strtotime($date[1]));
        // }


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



        $sql = "SELECT MIN(ID) FROM `logs`;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // return("test");
                $addRows = $row["MIN(ID)"];
            }
        }


        

        $startRowNum = $startRowNum + $addRows;
        $endRowNum = ($endRowNum + $addRows) - 1;

        if($date == "all"){
            $sql = "SELECT * FROM `logs` WHERE ID >= $startRowNum AND ID <= $endRowNum;";
        }
        else{
            $fromDate = $date[0];
            $toDate = $date[1];
            $sql = "SELECT * FROM `logs` WHERE `dateTime` >= '" .  $fromDate . "' AND `dateTime` <= '" .  $toDate . "';";

            // return($sql);

        }

        // return($sql);
  
            $result = $conn->query($sql);

            // return ("test");


            if ($result->num_rows > 0) {
                // output data of each row

                while($row = $result->fetch_assoc()) {

                    array_push($data, [$row["ID"], $row["direction"], $row["userNumber"], $row["otherEndNumber"], $row["duration"], $row["userName"], $row["dateTime"]]);

                    // $tempRowParsed = date_parse($row["duration"]);
                    // $tempRowSeconds = $tempRowParsed['hour'] * 3600 + $tempRowParsed['minute'] * 60 + $tempRowParsed['second'];

                    // $tempMaxParsed = date_parse($data[$row["userNumber"]]["maxduration"]);
                    // $tempMaxSeconds = $tempMaxParsed['hour'] * 3600 + $tempMaxParsed['minute'] * 60 + $tempMaxParsed['second'];

                    // if(isset($data[$row["userNumber"]]["maxduration"])){
                    //     if($tempMaxSeconds < $tempRowSeconds){
                    //         $data[$row["userNumber"]]["maxduration"] = $row["duration"];
                    //     }

                    // }
                    // else{
                    //     $data[$row["userNumber"]]["maxduration"] = $row["duration"]; 
                    // }


                    // if($row["direction"] == "outbound"){
                    //     $data[$row["userNumber"]]["outbound"]++;
                    //     // return("outbound");
                    // }
                    // else{
                    //     $data[$row["userNumber"]]["inbound"]++;
                    // }

                    // $data[$row["userNumber"]]["name"] = $key["name"];

                }
            }
            // else{
            //     $data[$key["email"]]["maxduration"] = "00:00:00";
            //     $data[$key["email"]]["name"] = $key["name"];
            // }
            
            
        


        return($data);

    }

