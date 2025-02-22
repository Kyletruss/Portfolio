<?php include("loginCheck.php")?>
<!DOCTYPE html>
<html lang="en">
    <?php include("navBar.php"); ?>
<body>
    <div class="loginFlex">
    <div class="row" style="width: 60%">

            <div>
                <div class="dashboardContainer">
                    <h3>Reports</h3>
                    <div class="reportGrid" id="reportGrid">
                        <div class="reportOption" id="listAllLogsButton">
                            <div onclick="listAllLogs()">
                                All Logs
                            </div>
                            <!-- <div id="downloadFirmwareButton" class="reportOption" onclick="downloadFirmwareTable('firmwareTable')">
                                Download
                            </div> -->
                        </div>
                        <div class="reportOption" id="callsLastMonthButton">
                            <div onclick="callsLastMonth()">
                                Calls Last Month
                            </div>
                            <!-- <div id="downloadFirmwareButton" class="reportOption" onclick="downloadFirmwareTable('firmwareTable')">
                                Download
                            </div> -->
                        </div>
                        <div class="reportOption" id="callsPerUserButton">
                            <div onclick="callsPerUser()">
                                Calls Per User
                            </div>
                            <!-- <div id="downloadFirmwareButton" class="reportOption" onclick="downloadFirmwareTable('firmwareTable')">
                                Download
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="reportOption devModeButton" style="width: 15%">
        <div onclick="devModeToggle()">Toggle DevMode</div>
    </div>
    <script src="user.js"></script>
    <script>


        // create the user object
        switch ('<?php echo($role); ?>') {
            case 'Admin':
                user = new Admin('<?php echo($userName); ?>', '<?php echo($userEmail); ?>', '<?php echo($role); ?>');
                // user.listAccess();
                break;
            case 'Guest':
                user = new Basic('<?php echo($userName); ?>', '<?php echo($userEmail); ?>', '<?php echo($role); ?>');
                // user.listAccess();
                break;
            default:
                console.log('<?php echo($role); ?>' + " is not a valid role");
        }

        console.log(user.listAccess());

        if('<?php if(isset($_GET['devMode'])){echo($_GET['devMode']);}else{echo("false");} ?>' != "true"){
            for(key in user.listAccess()){
                if(key != "name"){
                    if(user.listAccess()[key] == false){
                        document.getElementById(key + "Button").style.display = "none";
                    }
                }
            }
        }

        function devModeToggle(){
            if('<?php if(isset($_GET['devMode'])){echo($_GET['devMode']);}else{echo("false");} ?>' == "true"){
                location.href = '<?php echo(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)); ?>';
            }
            else{
                location.href = '<?php echo(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)); ?>' + "?devMode=true";
            }
        }
        console.log('<?php if(isset($_GET['devMode'])){echo($_GET['devMode']);}else{echo("false");} ?>');

        function listAllLogs(){
            location.href = "listAllLogs.php";
        }
        function callsLastMonth(){
            location.href = "callsLastMonth.php";
        }

        function callsPerUser(){
            location.href = "callsPerUser.php";
        }
    </script>
        <script src="populateUser.js"></script>
</body>
</html>