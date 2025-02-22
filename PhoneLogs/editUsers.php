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
            <div class="row" id="callLogsResult" style="display: none;">
                <div class="col-2">
                    <!-- <div class="reportOption" id="previousPageButton" onclick="previousPage()">Previous Page</div> -->
                </div>
                <div class="col-8" style="display:flex; flex-direction: column; align-items: center;" >
                    <div class="dashboardContainer">
                        <h3>Users</h3>
                        <div style="display: flex;justify-content: space-between;align-items: center;" id="tableOptions">
                            <input type="text" id="searchInput" onkeyup="searchNames()" placeholder="Search names.."title="Type in a name" style="width: 200px; margin-bottom: 10px;"/> 
                            <input type="text" id="searchInputUserNames" onkeyup="searchUserNumbers()" placeholder="Search usernames.."title="Type in a name" style="width: 200px; margin-bottom: 10px;"/> 
                            <input type="text" id="searchInputOtherEndNames" onkeyup="searchOtherEndNumbers()" placeholder="Search roles.."title="Type in a name" style="width: 200px; margin-bottom: 10px;"/> 
                                <!-- <input style="width: 200px; margin-bottom: 10px; visibility: hidden;" id="daterange" name="datetimes" />   -->
                        </div>
                        <!-- <button id="addResultsButton" onclick="toggleModal('#addResultsModal')">Add Users</button> -->
                        <div class="reportOption" id="addResultsButton" onclick="toggleModal('#addResultsModal')">
                            <div onclick="callsPerUser()">
                                Add Users
                            </div>
                        </div>

                        <table id="callLogsTable">
                                <tr>
                                    <th style=" display: none; width: 20% !important">ID</th>
                                    <th style="width: 20% !important">Name</th>
                                    <th style="width: 20% !important">Username</th>
                                    <th style="width: 20% !important">Role</th>
                                    <!-- <th style="width: 10% !important">Duration</th>
                                    <th style="width: 10% !important">Direction</th>
                                    <th style="width: 20% !important">Date</th> -->
                                </tr>
                            <tbody id="callLogsTableBody">

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

            let userList = [];
            getUsers();

            function getUsers(){
                jQuery.ajax({
                    type: "POST",
                    url: 'getUsers.php',
                    dataType: 'json',
                    // data: {logs: tempVar}, 
                    async: true,

                    success: function (obj) {
                        if( !('error' in obj) ) {

                            tempUsers = obj.result
                            // reset user list
                            userList = [];
                            for (i = 0; i < tempUsers.length; i++){
                                switch (tempUsers[i][3]) {
                                    case 'Admin':
                                        tempUser = new Admin(tempUsers[i][2], tempUsers[i][1], tempUsers[i][3]);
                                        tempUser.setID(tempUsers[i][0]);
                                        // user.listAccess();
                                        break;
                                    case 'Guest':
                                        tempUser = new Basic(tempUsers[i][2], tempUsers[i][1], tempUsers[i][3]);
                                        tempUser.setID(tempUsers[i][0]);
                                        // user.listAccess();
                                        break;
                                    default:
                                        console.log(tempUsers[i][3] + " is not a valid role");
                                }
                                userList.push(tempUser);

                            }
                            console.log( userList);


                            fillUsersTable();
                        
                            
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




            function fillUsersTable(){
                // document.getElementById("callLogsTableBody").innerHTML = "";

                document.getElementById("callLogsResult").style.display = "flex";

                table = document.getElementById("callLogsTableBody");
                table.innerHTML = "";

                for (i = 0; i < userList.length; i++){

                    row = document.createElement("tr");
                    table.appendChild(row);


                    idCell = document.createElement("td");
                    idCell.innerHTML = userList[i].id;
                    idCell.style.display = "none";
                    row.appendChild(idCell);

                    nameCell = document.createElement("td");
                    nameCell.innerHTML = userList[i].name;
                    row.appendChild(nameCell);

                    usernameCell = document.createElement("td");
                    usernameCell.innerHTML = userList[i].username;
                    row.appendChild(usernameCell);

                    roleCell = document.createElement("td");
                    roleCell.innerHTML = userList[i].role;
                    row.appendChild(roleCell);
                    
                }
            }
            
            function toggleModal(id){
                
                $(id).modal('toggle');
            }



            function submitResult(){
                name = document.getElementById("addResultNameInput").value;
                email = document.getElementById("addEmailInput").value;
                role = document.getElementById("addRoleInput").value;
                if(name.length == 0 || email.length == 0 || role.length == 0 || document.getElementById("addPasswordInput").value.length == 0 || document.getElementById("addConfirmPasswordInput").value.length == 0){
                    alert("Please fill out all fields");
                }
                else{
                    if(/[!@$%&#()=]/.test(name)){

                        alert("There are special characters in your name");
                    }
                    else if(/[!$%&#()=]/.test(email)){
                        alert("There are special characters in your email");
                    }
                    else if(!/[@]/.test(email)){
                        alert("That is not a valid email");
                    }
                    else if(/[!@$%&#()=]/.test(role)){
                        alert("There are special characters in your other end number");
                    }
                    else if(document.getElementById("addPasswordInput").value != document.getElementById("addConfirmPasswordInput").value){
                        alert("Passwords must match");
                    }
                    else{
                        console.log(name + ": " + email + ": " + role + ": " + document.getElementById("addPasswordInput").value);
                        // alert("Fix ajax before proceeding");
                        jQuery.ajax({
                                type: "POST",
                                url: 'addUser.php',
                                dataType: 'json',
                                async: false,
                                data: {name: name, email: email, role: role, password: document.getElementById("addPasswordInput").value},

                                success: function (obj) {
                                    if( !('error' in obj) ) {
                                        console.log(obj.result);    
                                        console.log("worked");

                                        if(obj.result == "Success"){
                                        // $('#feedbackModal').modal('toggle');
                                        getUsers();
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
                    document.getElementById("editUsernameInput").value = event.target.parentNode.childNodes[2].innerHTML;
                    document.getElementById("editRoleInput").value = event.target.parentNode.childNodes[3].innerHTML;
                    document.getElementById("userIDPlaceholder").innerHTML = event.target.parentNode.childNodes[0].innerHTML;

                    console.log(event.target.parentNode);



                    toggleModal('#editResultsModal');
                }
            }
            window.addEventListener('click', onClick);


            function submitEditResult(){
                name = document.getElementById("editResultNameInput").value;
                email = document.getElementById("editUsernameInput").value;
                role = document.getElementById("editRoleInput").value;
                if(name.length == 0 || email.length == 0 || role.length == 0 || document.getElementById("editPasswordInput").value.length == 0 || document.getElementById("editConfirmPasswordInput").value.length == 0){
                    alert("Please fill out all fields");
                }
                else{
                    if(/[!@$%&#()=]/.test(name)){

                        alert("There are special characters in your name");
                    }
                    else if(/[!$%&#()=]/.test(email)){
                        alert("There are special characters in your email");
                    }
                    else if(!/[@]/.test(email)){
                        alert("That is not a valid email");
                    }
                    else if(/[!@$%&#()=]/.test(role)){
                        alert("There are special characters in your other end number");
                    }
                    else if(document.getElementById("editPasswordInput").value != document.getElementById("editConfirmPasswordInput").value){
                        alert("Passwords must match");
                    }
                    else{
                        console.log(name + ": " + email + ": " + role + ": " + document.getElementById("editPasswordInput").value);
                        // alert("Fix ajax before proceeding");
                        jQuery.ajax({
                                type: "POST",
                                url: 'editUser.php',
                                dataType: 'json',
                                async: false,
                                data: {name: name, email: email, role: role, password: document.getElementById("editPasswordInput").value, id: document.getElementById("userIDPlaceholder").innerHTML},

                                success: function (obj) {
                                    if( !('error' in obj) ) {
                                        console.log(obj.result);    
                                        console.log("worked");

                                        if(obj.result == "Success"){
                                        // $('#feedbackModal').modal('toggle');
                                        getUsers();
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

            function deleteResult(){
                jQuery.ajax({
                    type: "POST",
                    url: 'deleteUser.php',
                    dataType: 'json',
                    async: false,
                    data: {id: document.getElementById("userIDPlaceholder").innerHTML},

                    success: function (obj) {
                        if( !('error' in obj) ) {
                            console.log(obj.result);    
                            console.log("worked");

                            if(obj.result == "Success"){
                                // $('#feedbackModal').modal('toggle');
                                alert ("Record deleted!");
                                getUsers();
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


            function displayRoles(selection){
                jQuery.ajax({
                        type: "POST",
                        url: 'getRoles.php',
                        dataType: 'json',
                        async: false,
                        // data: {name: name, email: email, role: role, password: document.getElementById("addPasswordInput").value},

                        success: function (obj) {
                            if( !('error' in obj) ) {
                                console.log(obj.result);  

                                roles = obj.result;

                                if(selection == "edit"){
                                    editUserRoles = document.getElementById("editUserDropdownRoles");
                                    editUserRoles.innerHTML = "";
                                }
                                else{

                                    addUserRoles = document.getElementById("addUserDropdownRoles");
                                    addUserRoles.innerHTML = "";

                                }
                                




                                for(i = 0; i < roles.length; i++){
                                    p = document.createElement("p");
                                    // Example of encapsulation
                                    p.innerHTML = roles[i];
                                    p.classList.add("versionChoice");
                                    // p.setAttribute("onclick","setVersion('" + versionArr.sort()[i] + "');");

              
                                    
                                    if(selection == "edit"){
                                        p.setAttribute("onclick", "fillRoleFieled('editRoleInput', '" + roles[i] + "')");

                                        // editUserRoles.onclick = function(tempRole){document.getElementById("editRoleInput").value = tempRole;};
                                        editUserRoles.appendChild(p);
                                    }
                                    else{
                                        p.setAttribute("onclick", "fillRoleFieled('addRoleInput', '" + roles[i] + "')");

                                        // addUserRoles.onclick = function(tempRole){document.getElementById("addRoleInput").value = tempRole;};
                                        addUserRoles.appendChild(p);
                                    }


                                }

                                
                                if(selection == "edit"){
                                    if(editUserRoles.style.display == "none"){
                                        editUserRoles.style.display = "block";
                                    }
                                    else{
                                        editUserRoles.style.display = "none";
                                    }
                                    // document.getElementById("editUserDropdownRoles").classList.toggle("show");
                                }
                                else{
                                    if(addUserRoles.style.display == "none"){
                                        addUserRoles.style.display = "block";
                                    }
                                    else{
                                        addUserRoles.style.display = "none";
                                    }
                                    // document.getElementById("addUserDropdownRoles").classList.toggle("show");
                                }

                                console.log(addUserRoles.style.display);
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


            function fillRoleFieled(elementId, role){
                document.getElementById(elementId).value = role;
            }

        </script>
        <script src="populateUser.js"></script>
    </body>
</html>
