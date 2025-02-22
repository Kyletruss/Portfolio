<?php include("loginCheck.php")?>
<!DOCTYPE html>
<html lang="en">
<?php include("navBar.php"); ?>
    <body>
        <div style="margin-bottom: 5%">
            <p>Show top</p>
            <input value="5" id="topResults">
            <button id="topButton" onclick="getResults('topResults')">Go</button>
            <p>Show bottom</p>
            <input value="5" id="bottomResults">
            <button id="bottomButton" onclick="getResults('bottomResults')">Go</button>
        </div>
        <div class="row" id="callLogsResult">
            <div class="col-1" style="display:flex; flex-direction: column; align-items: center;" >
            </div>
            <div class="col-10" style="display:flex; flex-direction: column; align-items: center;" >
                <div class="dashboardContainer" style="width: 100%">
                    <h3>Logs</h3>
                    <canvas id="myPieChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <script src="user.js"></script>
        <script>
            let myPieChartInstance = null;
            reportName = "callsPerUser";
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


            if(user.listAccess()[reportName] == false || user.listAccess()[reportName] == undefined){
                window.location.href = "redirect.php";
            }

            
            var dataLength = 0;
            now = new Date();

            // Get the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
            dayOfWeek = now.getDay();

            // Calculate the number of days to subtract to get the start of the week (Sunday)
            startOfWeek = new Date(now);
            startOfWeek.setDate(now.getDate() - dayOfWeek); // Set to the most recent Sunday
            startOfWeek.setHours(0, 0, 0, 0); // Start at 00:00:00 on Sunday

            // Calculate the end of the week (Saturday)
            endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6); // Add 6 days to get Saturday
            endOfWeek.setHours(23, 59, 59, 999); // End at 23:59:59 on Saturday

            // Function to format date as 'yyyy-mm-dd hh:mm:ss'
            formatDate = (date) => {
                year = date.getFullYear();
                month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                day = String(date.getDate()).padStart(2, '0');
                hours = String(date.getHours()).padStart(2, '0');
                minutes = String(date.getMinutes()).padStart(2, '0');
                seconds = String(date.getSeconds()).padStart(2, '0');
                
                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            };
            let dateRange = [formatDate(startOfWeek), formatDate(endOfWeek)]


            // console.log([formatDate(startOfWeek), formatDate(endOfWeek)]);

            loadPie(0);
            
            
            function loadPie(topbottom){
                jQuery.ajax({
                    type: "POST",
                    url: 'getLogs.php',
                    dataType: 'json',
                    data: {date: dateRange, startRowNum: 0, endRowNum: 0}, 
                    // data: {logs: tempVar}, 
                    async: true,

                    success: function (obj) {
                        if( !('error' in obj) ) {
                            console.log( obj.result);

                            logs = obj.result;

                            userCallCount = {
                
                            };


                            for(i = 0; i < logs.length; i++){
                                if(userCallCount[logs[i][5]] == undefined){
                                    userCallCount[logs[i][5]] = 1;
                                }
                                else{
                                    userCallCount[logs[i][5]]++;
                                }
                            }

                            scoresArray = Object.entries(userCallCount);
                            scoresArray.sort((a, b) => b[1] - a[1]);
                            let sortedScores = Object.fromEntries(scoresArray);

                            if(topbottom != 0){
                                if(topbottom > 0){
                                    // Get top X entries (e.g., top 3)
                                    data = Object.fromEntries(scoresArray.slice(0, topbottom));
                                    console.log(data);
                                }
                                else{
                                    // Get bottom X entries (e.g., bottom 3)
                                    data = Object.fromEntries(scoresArray.slice(topbottom));
                                }
                            }
                            else{
                                data = Object.fromEntries(scoresArray);
                            }
                            dataLength = data.length;
                            // console.log(myPieChartInstance);

                            // Destroy the existing chart if it exists
                            if (myPieChartInstance != null) {
                                myPieChartInstance.destroy();
                            }

                            var ctx = document.getElementById('myPieChart').getContext('2d');
                            myPieChartInstance = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: Object.keys(data),
                                    datasets: [{
                                        label: 'Calls this week',
                                        data: Object.values(data),
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                        },
                                        tooltip: {
                                            enabled: true,
                                        }
                                    }
                                }
                            });

                        
                            
                        }
                        else {
                            console.log(obj);
                        
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        // var err = eval("(" + xhr.responseText + ")");
                        // alert(error.Message);
                        console.log(error);
                    }
                    
                });
            }




            function getResults(id){
                numResults = document.getElementById(id).value;

                if(id == "bottomResults"){
                    numResults = -numResults;
                }

                // canvas = document.getElementById('myPieChart');
                // canvas.remove();



                console.log(numResults);

                loadPie(numResults);


            }
        </script>
        <script src="populateUser.js"></script>
    </body>
</html>
