<?php
  // detect if there is a session
  if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if(!isset($loggedIn)){
    $loggedIn = false;
  }

  $rootDir = "http://localhost/d424-software-engineering-capstone/PhoneLogs/";
  // echo(__DIR__);
?>

<head>
<title>TalentBridge Phone Reporting</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <!-- <link href="assets/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="<?php echo($rootDir);?>css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />

    <link rel="icon" type="image/x-icon" href="<?php echo($rootDir);?>assets/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="<?php echo($rootDir);?>assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <!-- <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/aes.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<!-- Responsive navbar-->
 
<nav class="navbar navbar-expand-lg navbar-dark bg-black">

        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->


    <img class="image-header" src="<?php echo($rootDir);?>assets/TBSolutionWording.png" onclick="location.href='index.php';">
    <div class="collapse navbar-collapse" id="navbarText">
        <div id="adminPanelButton" style="color: grey;"></div>

    </div>

    <div style="display: flex; flex-direction: row-reverse;">
      <div class="dropdown">
        <div id="pfpImage" style="display: none;">
            <div id="versionDropdown" class="versionDropdownButton">
              <img src="<?php echo($rootDir);?>assets/pfp.png" onclick="userInfoToggle()" class="pfpIcon">
              <div id="userInfoDropdownContent" class="version-dropdown-content">

              </div>
            </div>

                <!-- <div style="display: flex; flex-direction: row-reverse;">
      <div class="dropdown">
        <div id="versionDropdown" class="versionDropdownButton" onclick="versionDropdown()" style="color: grey;">Versions</div>
          <div id="versionDropdownContent" class="version-dropdown-content">

          </div>
        </div>
    </div> -->


        </div>
        </div>

        </div>
    </div>

</nav>
<div>
    
</div>

<!-- Admin Pannel -->
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalTitle">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="adminPanelLongTitle">Administration Pannel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="toggleModal('#adminModal')">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="reportGrid" id="reportGrid">
              <div class="reportOption">
                  <div onclick="goToGenSampLogs()">
                      Generate Sample Logs
                  </div>
              </div>
              <div class="reportOption">
                  <div onclick="editUsers()">
                      Edit Users
                  </div>
              </div>
              <div class="reportOption">
                  <div onclick="viewFeedback()">
                      View Feedback
                  </div>
              </div>
              <!-- <button onclick="location.href='https://zoomreports.dexian.com/dashboard?version=dashboardV2'">dashboardV2</button>
              <button onclick="location.href='https://zoomreports.dexian.com/dashboard?version=dashboardV2.1'">dashboardV2 Beta</button>
              <hr>
              <button class="btn btn-success" onclick="location.href='https://zoomreports.dexian.com/dashboard?subSite=meraki'">Meraki API</button> -->
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="toggleModal('#adminModal')">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<!-- Feedback Pannel -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalTitle">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="feedbackPanelLongTitle">Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="toggleModal('#feedbackModal')">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="display:block">
          <input type="firstName" id="input-firstName" placeholder="First Name" style="display: none;" readonly>
          <input type="lastName" id="input-lastName" placeholder="Last Name" style="display: none;" readonly>
          <input type="email" id="input-email" placeholder="Email" style="display: none;" readonly>

          <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="toggleModal('#feedbackModal')">Close</button>
        <button type="button" class="btn btn-primary" onclick="postFeedback()" onclick="toggleModal('#feedbackModal')">Submit</button>
      </div>
    </div>
  </div>
</div>

<button class="feedbackButton" id="feedbackButton" onclick="openfeedbackModal()">Feedback</button>
<script>
    if('<?php echo($loggedIn); ?>' == true){
      document.getElementById("pfpImage").style.display = "block";
    }



    $userRole = "administrator";

    if($userRole == "administrator"){
      adminPanelButton = document.getElementById("adminPanelButton");
      adminPanelButton.innerHTML = "Administration";
      adminPanelButton.setAttribute("onclick", "openAdminPannel()");

    }
    // else{
    //   document.getElementById("feedbackButton").style.display = "none";
    // }


    function openAdminPannel(){
        $('#adminModal').modal('toggle');
    }

    $('#adminModal').on('shown.bs.modal', function () {
        $('#adminModal').trigger('focus')
    })



    $('#adminModal').on('shown.bs.modal', function () {
        $('#feedbackModal').trigger('focus')
    })

    function openfeedbackModal(){


      // alert("This feature is currently in development and testing, please disregard if there is a popup labeled 'feedback popup' as it does not work- Zoom Reports Dev Team");
      $('#feedbackModal').modal('toggle');
    }
    

    name = '<?php echo($userName); ?>';
    // console.log(name);
    try{
      document.getElementById("input-firstName").value = name.split(" ")[0];
      document.getElementById("input-lastName").value = name.split(" ")[1];
    }
    catch{
      console.log("Could not determine first and last name for the feedback form");
    }

    document.getElementById("input-email").value = '<?php echo($userEmail); ?>';


    function postFeedback(){


      firstName = (document.getElementById("input-firstName").value);
      lastName = (document.getElementById("input-lastName").value);
      email = (document.getElementById("input-email").value);
      message = (document.getElementById("input-message").value);

      if(firstName.length == 0 || lastName.length == 0 || email.length == 0 || message.length == 0){
        alert("Please fill out all fields");
      }
      else{
          if(/[!@$%&#()=]/.test(firstName)){

            alert("There are special characters in your first name");
            }
            else if(/[!@$%&#()=]/.test(lastName)){
            alert("There are special characters in your last name");

            }
            else if(/[!$%&#()=]/.test(email)){
            alert("There are special characters in your email");
            }
            else if(/[!@$%&#()=]/.test(message)){
            alert("There are special characters in your message");
            }
            else{
              jQuery.ajax({
                    type: "POST",
                    url: 'submitFeedback.php',
                    dataType: 'json',
                    async: false,
                    data: {firstName: firstName, lastName: lastName, email: email, message: message},

                    success: function (obj) {
                        if( !('error' in obj) ) {
                            console.log(obj.result);    
                            console.log("worked");

                            if(obj.result == "Success"){
                              $('#feedbackModal').modal('toggle');
                              alert ("Thank you for your feedback!");
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










  function userInfoToggle() {
        document.getElementById("userInfoDropdownContent").classList.toggle("show");
  }







  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    // console.log(event.target);
    if (!event.target.matches('.pfpIcon') &&  !event.target.matches('#userInfoDropdownContent')) {
      var dropdowns = document.getElementsByClassName("version-dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }


  function goToGenSampLogs(){
    if (confirm('Are you sure? Going here will delete all existing call logs and generate new ones, this process will take about 30 minutes. Please use wisely, refreshing the page will not stop the log generation process, it will only add to the total logs.')) {
        location.href='sampleDatabase/genSampLogs.php';
    } 
  }

  function editUsers(){

    location.href='editUsers.php';


  }

  function viewFeedback(){
    location.href='viewFeedback.php';
  }

  function toggleModal(id){
      $(id).modal('toggle');
  }



</script>