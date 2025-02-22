<?php include("loginCheck.php")?>
<!DOCTYPE html>
<html lang="en">
<?php include("navBar.php"); ?>
    <body>
    <canvas id="lastMonthChart" width="400" height="200"></canvas>
        <script src="user.js"></script>
        <script>
            reportName = "callsLastMonth";
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

            

            now = new Date();
                
            // Get the first day of the previous month
            firstDayOfLastMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
            // Get the last day of the previous month
            lastDayOfLastMonth = new Date(now.getFullYear(), now.getMonth(), 0);

            formatDate = (date) => {
                year = date.getFullYear();
                month = String(date.getMonth() + 1).padStart(2, '0');
                day = String(date.getDate()).padStart(2, '0');
                hours = String(date.getHours()).padStart(2, '0');
                minutes = String(date.getMinutes()).padStart(2, '0');
                seconds = String(date.getSeconds()).padStart(2, '0');
                
                return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            };
            
            // Get the formatted date range
            startDate = new Date(firstDayOfLastMonth.setHours(0, 0, 0, 0)); // Start of the last month at 00:00:00
            endDate = new Date(lastDayOfLastMonth.setHours(23, 59, 59, 999)); // End of the last month at 23:59:59




            






            jQuery.ajax({
                type: "POST",
                url: 'getLogs.php',
                dataType: 'json',
                data: {date: [formatDate(startDate), formatDate(endDate)], startRowNum: 0, endRowNum: 0}, 
                // data: {logs: tempVar}, 
                async: true,

                success: function (obj) {
                    if( !('error' in obj) ) {
                        console.log( obj.result);

                        logs = obj.result;

                        month = {
                            "Week 1": 0,
                            "Week 2": 0,
                            "Week 3": 0,
                            "Week 4": 0                        
                        };


                        for(i = 0; i < logs.length; i++){
                            month[getWeekOfRandomDate(logs[i][6])]++;

                        }




                        // Get the context of the canvas element
                        var ctx = document.getElementById('lastMonthChart').getContext('2d');

                        // Create a new chart
                        var lastMonthChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Week1', 'Week2', 'Week3', 'Week4'],
                                datasets: [{
                                    label: 'Calls Per Week',
                                    data: [month["Week 1"], month["Week 2"], month["Week 3"], month["Week 4"]],
                                    fill: false,
                                    borderColor: '#446c89',
                                    tension: 0.1 
                                }]
                            },
                            options: {
                                responsive: true
                                // scales: {
                                //     y: {
                                //         beginAtZero: true
                                //     }
                                // }
                            }
                        });

                        console.log(month);

                    
                        
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















            function getWeekOfRandomDate(dateString) {
                now = new Date();
                
                // Get the first day of the last month
                firstDayOfLastMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                
                // Get the last day of the last month
                lastDayOfLastMonth = new Date(now.getFullYear(), now.getMonth(), 0);
                
                // Total days in last month
                totalDays = lastDayOfLastMonth.getDate(); // Get the day of the last month (number of days in the month)
                
                // Parse the random date
                tempDate = new Date(dateString);

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

                // Function to get the start and end of a given week
                getWeekRange = (startDay) => {
                    weekStart = new Date(firstDayOfLastMonth);
                    weekStart.setDate(startDay);
                    weekStart.setHours(0, 0, 0, 0); // Set the time to start of the day
                    
                    weekEnd = new Date(firstDayOfLastMonth);
                    weekEnd.setDate(startDay + 6); // Add 6 days to get the end of the week
                    weekEnd.setHours(23, 59, 59, 999); // Set time to end of the day
                    
                    // Ensure we don't exceed the last day of the month
                    if (weekEnd > lastDayOfLastMonth) {
                        weekEnd.setTime(lastDayOfLastMonth.getTime());

                    }

                    return { start: weekStart, end: weekEnd };
                };
                
                // Calculate the 4 weeks of the last month (break into 4 equal ranges)
                daysInWeek = Math.floor(totalDays / 4);
                
                // Find the range for each week
                weeks = [];
                for (let i = 0; i < 4; i++) {
                    startDay = i * daysInWeek + 1;
                    weeks.push(getWeekRange(startDay));
                }
                // Check which week the random date falls into
                for (let i = 0; i < weeks.length; i++) {
                    week = weeks[i];
                    if (tempDate >= week.start && tempDate <= week.end) {
                        return `Week ${i + 1}`;
                    }
                }
                
                return `Date is outside of the last month range`;
                
            }

            // Example usage:

            randomDate = "2024-10-12 14:30:00"; // Random date from last month (October 2024)

            console.log(`${randomDate} falls into: ${getWeekOfRandomDate(randomDate)}`);



            // console.log(getLastMonthDateRange());


        </script>
        <script src="populateUser.js"></script>
    </body>
</html>
