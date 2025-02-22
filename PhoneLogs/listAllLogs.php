
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
                        <h5 class="modal-title" id="adminPanelLongTitle">Administration Pannel</h5>
                        <button type="button" class="close" onclick="toggleModal('#addResultsModal')" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div style="display:block">
                                <p>Name</p>
                                <input type="text" id="addResultNameInput" placeholder="Enter Name" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Number</p>
                                <input type="text" id="addResultNumberInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Other End</p>
                                <input type="text" id="addResultOtherEndNumberInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Duration</p>
                                <input type="text" id="addResultDurationInput" placeholder="Enter Seconds" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Direction</p>
                                <input type="text" id="addResultDirectionInput" placeholder="Enter In or Out" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Date</p>
                                <input type="text" id="addResultDateInput" placeholder="Enter yyyy/mm/dd hh:mm:ss 24 hr format" title="Type in a name" style="margin-bottom: 10px;"/> 

                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="toggleModal('#addResultsModal')" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitResult()">Save Log</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Results Panel -->
        <div class="modal fade" id="editResultsModal" tabindex="-1" role="dialog" aria-labelledby="adminModalTitle">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminPanelLongTitle">Administration Pannel</h5>
                        <button type="button" class="close" onclick="toggleModal('#editResultsModal')" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div style="display:block">
                                <p>Name</p>
                                <input type="text" id="editResultNameInput" placeholder="Enter Name" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Number</p>
                                <input type="text" id="editResultNumberInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Other End</p>
                                <input type="text" id="editResultOtherEndNumberInput" placeholder="Enter Number" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Duration</p>
                                <input type="text" id="editResultDurationInput" placeholder="Enter Seconds" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Direction</p>
                                <input type="text" id="editResultDirectionInput" placeholder="Enter In or Out" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p>Date</p>
                                <input type="text" id="editResultDateInput" placeholder="Enter yyyy/mm/dd hh:mm:ss 24 hr format" title="Type in a name" style="margin-bottom: 10px;"/> 
                                <p id="callIDPlaceholder"></p>

                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="toggleModal('#editResultsModal')" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitEditResult()">Save Log</button>
                        <button type="button" class="btn btn-danger" onclick="deleteResult()">Delete Log</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row" id="callLogsResult" style="display: none;">
                <div class="col-2">
                    <div class="reportOption" id="previousPageButton" onclick="previousPage()">Previous Page</div>
                </div>
                <div class="col-8" style="display:flex; flex-direction: column; align-items: center;" >
                    <div class="dashboardContainer">
                        <h3>Logs</h3>
                        <div style="display: flex;justify-content: space-between;align-items: center;" id="tableOptions">
                            <input type="text" id="searchInput" onkeyup="searchNames()" placeholder="Search names.."title="Type in a name" style="width: 200px; margin-bottom: 10px;"/> 
                            <input type="text" id="searchInputUserNames" onkeyup="searchUserNumbers()" placeholder="Search user numbers.."title="Type in a name" style="width: 200px; margin-bottom: 10px;"/> 
                            <input type="text" id="searchInputOtherEndNames" onkeyup="searchOtherEndNumbers()" placeholder="Search other end numbers.."title="Type in a name" style="width: 200px; margin-bottom: 10px;"/> 
                                <!-- <input style="width: 200px; margin-bottom: 10px; visibility: hidden;" id="daterange" name="datetimes" />   -->
                        </div>
                        <button id="addResultsButton" onclick="toggleModal('#addResultsModal')">Add Results</button>

                        <table id="callLogsTable">
                                <tr>
                                    <th style=" display: none; width: 20% !important">ID</th>
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
        <script src="user.js"></script>
        <script>
            reportName = "listAllLogs";
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


            pageNumber = 1;
            let logs = [];
            getLogs(pageNumber);

            function getLogs(pageNumber){


                pageSize = 100000;
                startRowNum = pageNumber * pageSize;
                endRowNum = startRowNum + pageSize;
                
                jQuery.ajax({
                        type: "POST",
                        url: 'getLogs.php',
                        dataType: 'json',
                        data: {date: "all", startRowNum: startRowNum, endRowNum: endRowNum}, 
                        // data: {logs: tempVar}, 
                        async: true,

                        success: function (obj) {
                            if( !('error' in obj) ) {
                                console.log( obj.result);

                                logs = obj.result;

                                fillLogs();

                                // // clear error tags for multiple tries
                                // document.getElementById("emailError").innerHTML = "";
                                // document.getElementById("passwordError").innerHTML = "";

                                // if(obj.result == "Login Validated"){
                                //     window.location.href = "index.php";
                                // }
                                // else if(obj.result == "Email does not exist"){
                                //     document.getElementById("emailError").innerHTML = obj.result;
                                // }
                                // else if(obj.result == "Password Incorrect"){
                                //     document.getElementById("passwordError").innerHTML = obj.result;
                                // }

                            
                                
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

            function previousPage(){
                pageNumber = pageNumber - 1;
                fillLogs();
            }

            function nextPage(){
                pageNumber = pageNumber + 1;
                fillLogs();
            }

            function fillLogs(){
                console.log(pageNumber);
                document.getElementById("callLogsTableBody").innerHTML = "";

                startResults = pageNumber * 1000;
                if(pageNumber == 1){
                    document.getElementById("previousPageButton").style.display = "none";
                }
                else{
                    document.getElementById("previousPageButton").style.display = "block";
                }

                if(startResults + 1000 > startResults + 1000){
                    document.getElementById("nextPageButton").style.display = "none";
                }
                else{
                    document.getElementById("nextPageButton").style.display = "block";
                }
                resultNumber = startResults;
                // console.log(logs);

                document.getElementById("callLogsResult").style.display = "flex";

                table = document.getElementById("callLogsTableBody");

                for (resultNumber = startResults; resultNumber < (startResults + 1000); resultNumber++){

                    if(resultNumber > logs.length){
                        break;
                    }

                    row = document.createElement("tr");
                    table.appendChild(row);


                    idCell = document.createElement("td");
                    idCell.innerHTML = logs[resultNumber][0];
                    idCell.style.display = "none";
                    row.appendChild(idCell);

                    nameCell = document.createElement("td");
                    nameCell.innerHTML = logs[resultNumber][5];
                    row.appendChild(nameCell);

                    numberCell = document.createElement("td");
                    numberCell.innerHTML = logs[resultNumber][2];
                    row.appendChild(numberCell);

                    otherEndNumberCell = document.createElement("td");
                    otherEndNumberCell.innerHTML = logs[resultNumber][3];
                    row.appendChild(otherEndNumberCell);

                    durationCell = document.createElement("td");
                    durationCell.innerHTML = logs[resultNumber][4];
                    row.appendChild(durationCell);


                    directionCell = document.createElement("td");
                    directionCell.innerHTML = logs[resultNumber][1];
                    row.appendChild(directionCell);
                    
                    dateCell = document.createElement("td");
                    dateCell.innerHTML = logs[resultNumber ][6];
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

            function searchUserNumbers() {
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

            function searchOtherEndNumbers() {
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

            function toggleModal(id){
                
                $(id).modal('toggle');
            }

            function submitResult(){
                name = document.getElementById("addResultNameInput").value;
                number = document.getElementById("addResultNumberInput").value;
                otherEndNumber = document.getElementById("addResultOtherEndNumberInput").value;
                duration = document.getElementById("addResultDurationInput").value;
                direction = document.getElementById("addResultDirectionInput").value;
                date = document.getElementById("addResultDateInput").value;
                if(name.length == 0 || number.length == 0 || otherEndNumber.length == 0 || duration.length == 0 || direction.length == 0 || date.length == 0){
                    alert("Please fill out all fields");
                }
                else{
                    if(/[!@$%&#()=]/.test(name)){

                        alert("There are special characters in your name");
                        }
                        else if(/[!@$%&#()=]/.test(number)){
                        alert("There are special characters in your number");
                        }
                        else if(/[!@$%&#()=]/.test(otherEndNumber)){
                        alert("There are special characters in your other end number");
                        }
                        else if(/[!@$%&#()=]/.test(duration)){
                        alert("There are special characters in your duration");
                        }
                        else if(/[!@$%&#()=]/.test(direction)){
                        alert("There are special characters in your direction");
                        }
                        else if(/[!@$%&#()=]/.test(date)){
                        alert("There are special characters in your date");
                        }
                        else{
                        jQuery.ajax({
                                type: "POST",
                                url: 'submitRecord.php',
                                dataType: 'json',
                                async: false,
                                data: {name: name, number: number, otherEndNumber: otherEndNumber, duration: duration, direction: direction, date: date},

                                success: function (obj) {
                                    if( !('error' in obj) ) {
                                        console.log(obj.result);    
                                        console.log("worked");

                                        if(obj.result == "Success"){
                                        // $('#feedbackModal').modal('toggle');
                                        alert ("Record added!");
                                        }
                                        
                                    }
                                    else {
                                        console.log(obj.result);
                                        console.log("didnt");
                                    }
                                },
                                error: function(xhr, status, error) {

                                    console.log(xhr);
                                    console.log("did not");
                                    // var err = eval("(" + xhr.responseText + ")");
                                    // alert(err.Message);
                                }
                            
                        });
                    }
                }


            }


            const onClick = (event) => {
                
                // console.log(event.target.tagName);
                if(event.target.tagName == "TD"){


                    document.getElementById("editResultNameInput").value = event.target.parentNode.childNodes[1].innerHTML;
                    document.getElementById("editResultNumberInput").value = event.target.parentNode.childNodes[2].innerHTML;
                    document.getElementById("editResultOtherEndNumberInput").value = event.target.parentNode.childNodes[3].innerHTML;
                    document.getElementById("editResultDurationInput").value = event.target.parentNode.childNodes[4].innerHTML;
                    document.getElementById("editResultDirectionInput").value = event.target.parentNode.childNodes[5].innerHTML;
                    document.getElementById("editResultDateInput").value = event.target.parentNode.childNodes[6].innerHTML;
                    document.getElementById("callIDPlaceholder").innerHTML = event.target.parentNode.childNodes[0].innerHTML;

                    // console.log(event.target.parentNode.childNodes[0].innerHTML);



                    toggleModal('#editResultsModal');
                }
            }
            window.addEventListener('click', onClick);






            function submitEditResult(){
                name = document.getElementById("editResultNameInput").value;
                number = document.getElementById("editResultNumberInput").value;
                otherEndNumber = document.getElementById("editResultOtherEndNumberInput").value;
                duration = document.getElementById("editResultDurationInput").value;
                direction = document.getElementById("editResultDirectionInput").value;
                date = document.getElementById("editResultDateInput").value;

                callID = document.getElementById("callIDPlaceholder").innerHTML;
                if(name.length == 0 || number.length == 0 || otherEndNumber.length == 0 || duration.length == 0 || direction.length == 0 || date.length == 0){
                    alert("Please fill out all fields");
                }
                else{
                    if(/[!@$%&#()=]/.test(name)){

                        alert("There are special characters in your name");
                        }
                        else if(/[!@$%&#()=]/.test(number)){
                        alert("There are special characters in your number");
                        }
                        else if(/[!@$%&#()=]/.test(otherEndNumber)){
                        alert("There are special characters in your other end number");
                        }
                        else if(/[!@$%&#()=]/.test(duration)){
                        alert("There are special characters in your duration");
                        }
                        else if(/[!@$%&#()=]/.test(direction)){
                        alert("There are special characters in your direction");
                        }
                        else if(/[!@$%&#()=]/.test(date)){
                        alert("There are special characters in your date");
                        }
                        else if(!/^\d+$/.test(number)){
                            alert("The number field is not a number");
                        }
                        else if(!/^\d+$/.test(otherEndNumber)){
                            alert("The other end number field is not a number");
                        }
                        else{
                        jQuery.ajax({
                                type: "POST",
                                url: 'editRecord.php',
                                dataType: 'json',
                                async: false,
                                data: {name: name, number: number, otherEndNumber: otherEndNumber, duration: duration, direction: direction, date: date, id: callID},

                                success: function (obj) {
                                    if( !('error' in obj) ) {
                                        console.log(obj.result);    
                                        console.log("worked");

                                        if(obj.result == "Success"){
                                        // $('#feedbackModal').modal('toggle');
                                        alert ("Record edited!");
                                        getLogs(pageNumber)
                                        }
                                        
                                    }
                                    else {
                                        console.log(obj.result);
                                        console.log("didnt");
                                    }
                                },
                                error: function(xhr, status, error) {

                                    console.log(xhr);
                                    console.log("did not");
                                    // var err = eval("(" + xhr.responseText + ")");
                                    // alert(err.Message);
                                }
                            
                        });
                    }
                }
            }

            function deleteResult(){

                callID = document.getElementById("callIDPlaceholder").innerHTML;
                jQuery.ajax({
                    type: "POST",
                    url: 'deleteRecord.php',
                    dataType: 'json',
                    async: false,
                    data: {id: callID},

                    success: function (obj) {
                        if( !('error' in obj) ) {
                            console.log(obj.result);    
                            console.log("worked");

                            if(obj.result == "Success"){
                            // $('#feedbackModal').modal('toggle');
                            alert ("Record deleted!");
                            getLogs(pageNumber)
                            }
                            
                        }
                        else {
                            console.log(obj.result);
                            console.log("didnt");
                        }
                    },
                    error: function(xhr, status, error) {

                        console.log(xhr);
                        console.log("did not");
                        // var err = eval("(" + xhr.responseText + ")");
                        // alert(err.Message);
                    }
                
            });

            }

        </script>
        <script src="populateUser.js"></script>
    </body>
</html>
