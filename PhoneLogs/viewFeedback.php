<?php include("loginCheck.php")?>

<!DOCTYPE html>
<html lang="en">
<?php include("navBar.php"); ?>
    <body>
        <!-- Add Results Panel -->
        <div class="modal fade" id="addResultsModal" tabindex="-1" role="dialog" aria-labelledby="adminModalTitle">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminPanelLongTitle">Add User</h5>
                        <button type="button" class="close" onclick="toggleModal('#addResultsModal')" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div style="display:block">
                                <p>Name</p>
                                <input type="text" id="addResultNameInput" placeholder="Enter Name" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Email</p>
                                <input type="text" id="addEmailInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Role</p>
                                <input type="text" id="addRoleInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;"readonly onclick="displayRoles('add')"/> 
                                <div id="addUserDropdownRoles" style="border: 1px solid black; display: none;">

                                </div>
                                <p>Password</p>
                                <input type="text" id="addPasswordInput" placeholder="Enter Seconds" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Confirm Password</p>
                                <input type="text" id="addConfirmPasswordInput" placeholder="Enter In or Out" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <!-- <p>Date</p>
                                <input type="text" id="addResultDateInput" placeholder="Enter yyyy/mm/dd hh:mm:ss 24 hr format" title="Type in a name" style="margin-bottom: 10px;"/>  -->

                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="toggleModal('#addResultsModal')" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitResult()">Save User</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Results Panel -->
        <div class="modal fade" id="editResultsModal" tabindex="-1" role="dialog" aria-labelledby="adminModalTitle">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminPanelLongTitle">Edit User</h5>
                        <button type="button" class="close" onclick="toggleModal('#editResultsModal')" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div style="display:block">
                                <p>Name</p>
                                <input type="text" id="editResultNameInput" placeholder="Enter Name" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Username</p>
                                <input type="text" id="editUsernameInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Role</p>
                                <input type="text" id="editRoleInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;" readonly onclick="displayRoles('edit')"/> 
                                <div id="editUserDropdownRoles" style="border: 1px solid black; display: none;">

                                </div>
                                <p>New Password</p>
                                <input type="text" id="editPasswordInput" placeholder="Enter Seconds" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Confirm Password</p>
                                <input type="text" id="editConfirmPasswordInput" placeholder="Enter In or Out" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <!-- <p>Date</p>
                                <input type="text" id="editResultDateInput" placeholder="Enter yyyy/mm/dd hh:mm:ss 24 hr format" title="Type in a name" style="margin-bottom: 10px;"/>  -->
                                <p id="userIDPlaceholder"></p>

                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="toggleModal('#editResultsModal')" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitEditResult()">Save User</button>
                        <button type="button" class="btn btn-danger" onclick="deleteResult()">Delete User</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row" id="feedbackResult" style="display: none;">
                <div class="col-2">
                    <!-- <div class="reportOption" id="previousPageButton" onclick="previousPage()">Previous Page</div> -->
                </div>
                <div class="col-8" style="display:flex; flex-direction: column; align-items: center;" >
                    <div class="dashboardContainer">
                        <h3>Feedback</h3>
                        <div style="display: flex;justify-content: space-between;align-items: center;" id="tableOptions">
                            <input type="text" id="searchInput" onkeyup="searchNames()" placeholder="Search names.." style="width: 200px; margin-bottom: 10px;"/> 
                            <input type="text" id="searchInputUserNames" onkeyup="searchUsernames()" placeholder="Search usernames.." style="width: 200px; margin-bottom: 10px;"/> 
                            <input type="text" id="searchInputOtherEndNames" onkeyup="searchMessages()" placeholder="Search messages.." style="width: 200px; margin-bottom: 10px;"/> 
                                <!-- <input style="width: 200px; margin-bottom: 10px; visibility: hidden;" id="daterange" name="datetimes" />   -->
                        </div>


                        <table id="callLogsTable">
                                <tr>
                                    <!-- <th style=" display: none; width: 20% !important">ID</th> -->
                                    <th style="width: 20% !important">Name</th>
                                    <th style="width: 20% !important">Username</th>
                                    <th style="width: 40% !important">Message</th>
                                    <!-- <th style="width: 10% !important">Duration</th>
                                    <th style="width: 10% !important">Direction</th> -->
                                    <th style="width: 20% !important">Date</th>
                                </tr>
                            <tbody id="feedbackTableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-2">
                    <!-- <div class="reportOption" id="nextPageButton" onclick="nextPage()">Next Page</div> -->
                </div>
            </div>


        </div>
        <script src="user.js"></script>
        <script>
            reportName = "adminPanel";
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

            if(user.listAccess()[reportName] == false || user.listAccess()[reportName] == undefined){
                window.location.href = "redirect.php";
            }

            let feedbackList = [];
            getFeedback();

            function getFeedback(){
                jQuery.ajax({
                    type: "POST",
                    url: 'getFeedback.php',
                    dataType: 'json',
                    // data: {logs: tempVar}, 
                    async: true,

                    success: function (obj) {
                        if( !('error' in obj) ) {

                            feedbackList = obj.result
                            // console.log(feedbackList);
                            // reset user list
                            // feedbackList = [];
                            // for (i = 0; i < tempFeedback.length; i++){
                            //     switch (tempFeedback[i][3]) {
                            //         case 'Admin':
                            //             tempUser = new Admin(tempFeedback[i][2], tempFeedback[i][1], tempFeedback[i][3]);
                            //             tempUser.setID(tempFeedback[i][0]);
                            //             // user.listAccess();
                            //             break;
                            //         case 'Guest':
                            //             tempUser = new Basic(tempFeedback[i][2], tempFeedback[i][1], tempFeedback[i][3]);
                            //             tempUser.setID(tempFeedback[i][0]);
                            //             // user.listAccess();
                            //             break;
                            //         default:
                            //             console.log(tempFeedback[i][3] + " is not a valid role");
                            //     }
                            //     feedback.push(tempFeedback);

                            // }
                            // console.log( feedbackList);


                            fillFeedbackTable();
                        
                            
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




            function fillFeedbackTable(){
                // document.getElementById("feedbackTableBody").innerHTML = "";

                document.getElementById("feedbackResult").style.display = "flex";

                table = document.getElementById("feedbackTableBody");
                table.innerHTML = "";
                console.log(feedbackList);

                for (i = 0; i < feedbackList.length; i++){

                    row = document.createElement("tr");
                    table.appendChild(row);


                    nameCell = document.createElement("td");
                    nameCell.innerHTML = feedbackList[i][0] + " " + feedbackList[i][1];
                    row.appendChild(nameCell);

                    UsernameCell = document.createElement("td");
                    UsernameCell.innerHTML = feedbackList[i][2];
                    row.appendChild(UsernameCell);

                    messageCell = document.createElement("td");
                    messageCell.innerHTML = feedbackList[i][3];
                    row.appendChild(messageCell);

                    dateCell = document.createElement("td");
                    dateCell.innerHTML = feedbackList[i][4];
                    row.appendChild(dateCell);
                    
                }
            }

            function searchNames() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("callLogsTable");
                tr = table.getElementsByTagName("tr");


                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }
                }
            }
            

            function searchUsernames() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInputUserNames");
                filter = input.value.toUpperCase();
                table = document.getElementById("callLogsTable");
                tr = table.getElementsByTagName("tr");


                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }
                }
            }

            function searchMessages() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInputOtherEndNames");
                filter = input.value.toUpperCase();
                table = document.getElementById("callLogsTable");
                tr = table.getElementsByTagName("tr");


                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }
                }
            }


            



            


        </script>
        <script src="populateUser.js"></script>
    </body>
</html>
