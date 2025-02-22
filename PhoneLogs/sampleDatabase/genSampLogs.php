<?php include("../loginCheck.php")?>
<?php
// Setting the time limit to 1 hr as this is a big job
set_time_limit(6000);

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

    // Random names generated from ChatGPT. Disclamer: All names are completely fictional and references to peoples names is purely coincidental.
    $names = ["Aaron Adams", "Abigail Alexander", "Adam Anderson", "Adrian Armstrong", "Aiden Baker", "Alex Barnes", "Alexa Bennett", "Alice Black", "Amber Bradley", "Amelia Brooks", "Andrew Brown", "Anna Bryant", "Anthony Butler", "April Campbell", "Arthur Carter", "Ashton Clark", "Audrey Coleman", "Austin Collins", "Ava Cook", "Bailey Cooper", "Benjamin Cox", "Bethany Cruz", "Blake Davis", "Brianna Diaz", "Brittany Dixon", "Brooklyn Edwards", "Caleb Ellis", "Cameron Evans", "Caroline Fisher", "Carter Flores", "Cassandra Foster", "Charles Garcia", "Chloe Gibson", "Christian Gomez", "Christopher Gonzales", "Claire Gonzalez", "Clara Gray", "Colton Green", "Connor Griffin", "Daisy Gutierrez", "Daniel Hall", "David Harris", "Delilah Hayes", "Dominic Henderson", "Dylan Hernandez", "Eden Hill", "Edward Howard", "Eli Hughes", "Elijah Jackson", "Elizabeth James", "Ella Jenkins", "Elliott Johnson", "Emily Jones", "Emma Kelly", "Eric King", "Ethan Lee", "Evelyn Lewis", "Faith Lopez", "Felix Martinez", "Fiona Miller", "Gabriel Mitchell", "Garrett Morgan", "Gavin Morris", "Gemma Murphy", "George Nelson", "Grace Ortiz", "Grayson Parker", "Hailey Perez", "Hannah Peterson", "Harper Phillips", "Harrison Powell", "Hayden Price", "Hazel Ramirez", "Henry Reed", "Hudson Reyes", "Hunter Richardson", "Ian Rivera", "Isaac Roberts", "Isabelle Robinson", "Jack Rodriguez", "Jackson Rogers", "Jacob Ross", "James Ruiz", "Jasmine Sanders", "Jason Scott", "Jasper Simmons", "Jayden Smith", "Jenna Stewart", "Jessica Taylor", "Joel Thomas", "John Thompson", "Jonah Torres", "Jonathan Turner", "Jordan Walker", "Joseph Ward", "Joshua Washington", "Julia Watson", "Julian White", "Justin Williams", "Kaitlyn Wilson", "Aaron Martinez", "Abigail Price", "Adam Williams", "Adrian Phillips", "Aiden Garcia", "Alex Thompson", "Alexa Sanders", "Alice Baker", "Amber Jenkins", "Amelia Johnson", "Andrew Gray", "Anna White", "Anthony Scott", "April Lewis", "Arthur Watson", "Ashton Anderson", "Audrey Bryant", "Austin Brooks", "Ava Green", "Bailey Hayes", "Benjamin Hughes", "Bethany Nelson", "Blake Harris", "Brianna Lee", "Brittany King", "Brooklyn Ward", "Caleb Hill", "Cameron Robinson", "Caroline Torres", "Carter Butler", "Cassandra Rivera", "Charles Stewart", "Chloe Powell", "Christian Washington", "Christopher Gonzales", "Claire Reed", "Clara Reyes", "Colton Thompson", "Connor Taylor", "Daisy Torres", "Daniel Hill", "David Baker", "Delilah Jones", "Dominic Gonzales", "Dylan Watson", "Eden Harris", "Edward Lewis", "Eli Stewart", "Elijah Cooper", "Elizabeth Watson", "Ella Carter", "Elliott Rivera", "Emily Green", "Emma Davis", "Eric Walker", "Ethan Nelson", "Evelyn Robinson", "Faith Thompson", "Felix Scott", "Fiona Martinez", "Gabriel Anderson", "Garrett Brown", "Gavin Jenkins", "Gemma James", "George Foster", "Grace Wilson", "Grayson Bryant", "Hailey Barnes", "Hannah Powell", "Harper Fisher", "Harrison Bennett", "Hayden Cook", "Hazel Jenkins", "Henry Ross", "Hudson Cruz", "Hunter Johnson", "Ian Harris", "Isaac Lopez", "Isabelle Garcia", "Jack Miller", "Jackson White", "Jacob Evans", "James Gonzalez", "Jasmine Davis", "Jason Jones", "Jasper Foster", "Jayden Cruz", "Jenna Clark", "Jessica Edwards", "Joel Parker", "John Roberts", "Jonah Adams", "Jonathan Gomez", "Jordan Rodriguez", "Joseph Gonzales", "Joshua Peterson", "Julia Gray", "Julian Powell", "Justin Nelson", "Kaitlyn Wilson"];


    // Generating 200 random phone numbers to attach to users. Disclamer: All numbers are completely fictional and references to actual phone numbers is purely coincidental.
    $userNumbers = [];
    for($i = 0; $i < 200; $i++){
        $tempNumber = sprintf("%03d%03d%04d", rand(200, 999), rand(200, 999), rand(0, 9999));
        while(!in_array($tempNumber, $userNumbers)){
            array_push($userNumbers, $tempNumber);
        }
    }
    if(array_unique($userNumbers)){
        // echo("userNumbers array is unique<br>");
    }


    $otherEndNumbers = [];
    for($i = 0; $i < 1000; $i++){
        $tempNumber = sprintf("%03d%03d%04d", rand(200, 999), rand(200, 999), rand(0, 9999));
        while(!in_array($tempNumber, $otherEndNumbers)){
            array_push($otherEndNumbers, $tempNumber);
        }
    }
    if(array_unique($otherEndNumbers)){
        // echo("otherEndNumbers array is unique<br>");
    }








    function weightedRandom($trueWeight, $falseWeight) {
        $totalWeight = $trueWeight + $falseWeight;
        $randomValue = mt_rand(0, $totalWeight - 1); // Random between 0 and totalWeight-1
        return $randomValue < $trueWeight;
    }




    function getRandomTimestamp($year) {
        $start = strtotime("$year-01-01 00:00:00"); // Start of the year
        $end = strtotime(($year + 1) . "-01-01 00:00:00"); // Start of next year
        
        $randomTimestamp = mt_rand($start, $end); // Generate random timestamp between start and end
        
        return date("Y-m-d H:i:s", $randomTimestamp); // Format as yyyy-mm-dd HH:mm:ss
    }



    $logs = [];

    $sql = "DELETE FROM `logs`;";

    if ($conn->query($sql) === FALSE) {
        die("Oh no");
    }
    foreach ($names as $i => $name) {


        $numCalls = floor((1 - pow(mt_rand() / mt_getrandmax(), 5)) * 5000) + 1;



        for ($j = 0; $j < $numCalls; $j++) {
            $call = [];
            // 80% chance of "Outbound" direction
            $direction = weightedRandom(8, 2) ? "Out" : "In";
            
            // Generate a random call duration (1 to 1800 seconds, favoring lower values)
            $duration = floor(pow(mt_rand() / mt_getrandmax(), 5) * 1800) + 1;
    
            // Generate a random timestamp for the year 2024
            $timestamp = getRandomTimestamp(2024);
            
            // Random other end number from the list
            $otherEndNumber = $otherEndNumbers[mt_rand(0, count($otherEndNumbers) - 1)];
    
            // Create the call object and store it in the logs array
            $call = [$userNumbers[$i], $name, $otherEndNumber, $direction, $duration, $timestamp];
            $tempUserNumber = $userNumbers[$i];

                
                
            $sql = "INSERT INTO `logs`(`direction`, `userNumber`, `otherEndNumber`, `duration`, `userName`, `dateTime`) VALUES ('$direction',$tempUserNumber,$otherEndNumber,$duration,'$name','$timestamp')";

            if ($conn->query($sql) === FALSE) {
                die("Oh no");
            }
                
                
            
            
            // $logs[] = $call;
        }







    }






?>

<!DOCTYPE html>
<html lang="en">
    <?php include("../navBar.php"); ?>
    <body>
        <div>
            <div class="row">
                <div class="col-12" style="display:flex; flex-direction: column; align-items: center;" id="genLogsContainer" >
                    <div class="reportOption" style="width: 10%;">
                        <div id="getFirmwares" onclick="generateLogs()">
                            Generate Sample Logs
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="subLogsContainer" style="display: none;">
                <div class="col-12" style="display:flex; flex-direction: column; align-items: center;">
                    <div class="reportOption" style="width: 10%; background-color: #446c89;">
                        <div id="getFirmwares" style="color: white;" onclick="submitSampLogs(0)">
                            Submit Logs
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row" id="subLogsContainer" style="display:none;">
                <div class="col-12" style="display:flex; flex-direction: column; align-items: center;" >
                    <div class="reportOption" style="width: 10%; background-color: #446c89;">
                    </div>
                </div>
            </div> -->
            <div class="row" id="callLogsResult" style="display: none;">
                <div class="col-2">
                    <div class="reportOption" id="previousPageButton" onclick="previousPage()">Previous Page</div>
                </div>
                <div class="col-8" style="display:flex; flex-direction: column; align-items: center;" >
                    <div class="dashboardContainer">
                        <h3>Logs</h3>
                        <table id="callLogsTable">
                                <tr>
                                    <th style="width: 20% !important">Name</th>
                                    <th style="width: 20% !important">Number</th>
                                    <th style="width: 20% !important">Other End</th>
                                    <th style="width: 10% !important">Duration</th>
                                    <th style="width: 10% !important">Direction</th>
                                    <th style="width: 20% !important">Date</th>
                                </tr>
                            <tbody id="callLogsTableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-2">
                    <div class="reportOption" id="nextPageButton" onclick="nextPage()">Next Page</div>
                </div>
            </div>


        </div>

        <script src="../user.js"></script>
        <script>
            
            // create the user object
            switch ('<?php echo($role); ?>') {
                case 'Admin':
                    user = new Admin('<?php echo($userName); ?>', '<?php echo($userEmail); ?>', '<?php echo($role); ?>');
                    // user.listAccess();
                    break;
                case 'Guest':
                    user = new Admin('<?php echo($userName); ?>', '<?php echo($userEmail); ?>', '<?php echo($role); ?>');
                    // user.listAccess();
                    break;
                default:
                    console.log('<?php echo($role); ?>' + " is not a valid role");
            }



            




            // let pageNumber = 1;


            // let logs = [];

            // function generateLogs(){
            //     document.getElementById("genLogsContainer").style.display = "none";

            //     function weightedRandom(trueWeight, falseWeight) {
            //         const totalWeight = trueWeight + falseWeight;
            //         const randomValue = Math.random() * totalWeight;

            //         return randomValue < trueWeight;
            //     }

            //     function getRandomTimestamp(year) {
            //         // Start of the year
            //         start = new Date(year, 0, 1); // January 1st
            //         // End of the year
            //         end = new Date(year + 1, 0, 1); // January 1st of the next year

            //         // Generate a random timestamp between start and end
            //         randomTimestamp = new Date(start.getTime() + Math.random() * (end - start));

            //         // Format the timestamp to yyyy-mm-dd HH:mm:ss
            //         yyyy = randomTimestamp.getFullYear();
            //         mm = String(randomTimestamp.getMonth() + 1).padStart(2, '0'); // Months are 0-based
            //         dd = String(randomTimestamp.getDate()).padStart(2, '0');
            //         hh = String(randomTimestamp.getHours()).padStart(2, '0');
            //         min = String(randomTimestamp.getMinutes()).padStart(2, '0');
            //         ss = String(randomTimestamp.getSeconds()).padStart(2, '0');

            //         return `${yyyy}-${mm}-${dd} ${hh}:${min}:${ss}`;
            //     }






            //     userNames = JSON.parse('<?php echo(json_encode($names));?>');
            //     userNumbers = JSON.parse('<?php echo(json_encode($userNumbers));?>');
            //     otherEndNumbers = JSON.parse('<?php echo(json_encode($otherEndNumbers));?>');

            //     console.log(userNames);
            //     console.log(userNumbers);
            //     console.log(otherEndNumbers);



                



            //     for(i = 0; i < userNames.length; i++){
            //     //     // logs.push(["test1", "test2", "test3"]);


                    
            //         // for each user, generate between 1 and 20000 calls, favoring higher call counts
            //         // for(j = 0; j < Math.round(Math.random(1, 20000) * 20000); j++){
            //         for(j = 0; j < Math.floor((1 - Math.pow(Math.random(), 5)) * 20000) + 1; j++){
            //             // 80% chance of true
            //             result = weightedRandom(8, 2); 
            //             if(result == true){
            //                 direction = "Outbound"
            //             }
            //             else{
            //                 direction = "Inbound";
            //             }

            //             // creates the call record object, the duration formula is a random duration in seconds between 1 and 1800 which favors lower numbers. This is to try and replicate the usual low call duration of sales calls but still allow for longer calls.
            //             call = new Call(userNumbers[i], userNames[i], otherEndNumbers[Math.round(Math.random(1, 1000)* 1000)] , direction, Math.floor(Math.pow(Math.random(), 5) * 1800) + 1, getRandomTimestamp(2024));
            //             logs.push(call);
            //         }



            //     }




            //     // call = new Call(userNumbers[0], userNames[0], otherEndNumbers[0], direction, "1:32");



            //     fillLogs();


            // }

            // function fillLogs(){
            //     document.getElementById("subLogsContainer").style.display = "block";
            //     console.log(pageNumber);
            //     document.getElementById("callLogsTableBody").innerHTML = "";

            //     startResults = pageNumber * 1000;
            //     if(pageNumber == 1){
            //         document.getElementById("previousPageButton").style.display = "none";
            //     }
            //     else{
            //         document.getElementById("previousPageButton").style.display = "block";
            //     }

            //     if(startResults + 1000 > startResults + 1000){
            //         document.getElementById("nextPageButton").style.display = "none";
            //     }
            //     else{
            //         document.getElementById("nextPageButton").style.display = "block";
            //     }
            //     resultNumber = startResults;
            //     // console.log(logs);

            //     document.getElementById("callLogsResult").style.display = "flex";

            //     table = document.getElementById("callLogsTableBody");

            //     for (resultNumber = startResults; resultNumber < (startResults + 1000); resultNumber++){

            //         if(resultNumber > logs.length){
            //             break;
            //         }

            //         row = document.createElement("tr");
            //         table.appendChild(row);



            //         nameCell = document.createElement("td");
            //         nameCell.innerHTML = logs[resultNumber].userName;
            //         row.appendChild(nameCell);

            //         numberCell = document.createElement("td");
            //         numberCell.innerHTML = logs[resultNumber].userNumber;
            //         row.appendChild(numberCell);

            //         otherEndNumberCell = document.createElement("td");
            //         otherEndNumberCell.innerHTML = logs[resultNumber].otherEndNumber;
            //         row.appendChild(otherEndNumberCell);

            //         durationCell = document.createElement("td");
            //         durationCell.innerHTML = logs[resultNumber].duration;
            //         row.appendChild(durationCell);


            //         directionCell = document.createElement("td");
            //         directionCell.innerHTML = logs[resultNumber].direction;
            //         row.appendChild(directionCell);
                    
            //         dateCell = document.createElement("td");
            //         dateCell.innerHTML = logs[resultNumber ].dateTime;
            //         row.appendChild(dateCell);

                    
            //     }
            // }

            // function previousPage(){
            //     pageNumber = pageNumber - 1;
            //     fillLogs();
            // }

            // function nextPage(){
            //     pageNumber = pageNumber + 1;
            //     fillLogs();
            // }


            // function submitSampLogs(iteration){
            //     // Couldn't send over all at once, the most I could send at a time was 100 :(
            //     // Will need to add a delay between ajax calls if it breaks in the EC2 instance
            //     startNumber = iteration * 100;
            //     if(startNumber != logs.length){
            //         endNumber = startNumber + 100;

            //         endLoop = false;

            //         if(endNumber > logs.length){
            //         endNumber = logs.length;
            //         endLoop = true;
            //         }

                    
                    

            //         tempLogs = logs.slice(startNumber, endNumber);

            //         console.log(tempLogs);
            //         jQuery.ajax({
            //             type: "POST",
            //             url: 'subSampLogs.php',
            //             dataType: 'json',
            //             data: {logs: tempLogs}, 
            //             // data: {logs: tempVar}, 
            //             async: true,

            //             success: function (obj) {
            //                 if( !('error' in obj) ) {
            //                     console.log( obj.result);



            //                     // // clear error tags for multiple tries
            //                     // document.getElementById("emailError").innerHTML = "";
            //                     // document.getElementById("passwordError").innerHTML = "";

            //                     // if(obj.result == "Login Validated"){
            //                     //     window.location.href = "index.php";
            //                     // }
            //                     // else if(obj.result == "Email does not exist"){
            //                     //     document.getElementById("emailError").innerHTML = obj.result;
            //                     // }
            //                     // else if(obj.result == "Password Incorrect"){
            //                     //     document.getElementById("passwordError").innerHTML = obj.result;
            //                     // }

            //                     if(endLoop == false){
            //                         submitSampLogs(iteration + 1);
            //                     }

                            
                                
            //                 }
            //                 else {
            //                     console.log(obj);
                            
            //                 }
                            
            //             },
            //             error: function(xhr, status, error) {
            //                 // var err = eval("(" + xhr.responseText + ")");
            //                 // alert(error.Message);
            //                 console.log(error);
            //             }
                        
            //         });
            //     }

            // }


            
        </script>
        <script src="../populateUser.js"></script>
    </body>
</html>