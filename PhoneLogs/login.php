<?php

  // detect if there is a session
  if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
    // echo("Session started<br>");
  }
//   if(isset($_SESSION["login"])){

//     if($_SESSION["login"] != true){
//         echo("Not logged in<br>");
    
//     }
//     else{
//         echo("Logged in<br>");
//     }

//   }
//   else{
//     echo("No login session variable<br>");

//   }
//   echo session_id();
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("navBar.php"); ?>
    <body>
        <div class="loginFlex">
            <div class="loginForm">
                <div class="logoContainer">
                    <img class="logo" src="assets/TBSolutionsLogo.png">
                </div>
                <div class="email">
                    <label for="email">Email Address</label>
                    <div class="sec-2">
                        <input type="email" name="email" id="emailField" placeholder="Example@email.com"/>
                        <span id="emailError"></span>
                    </div>
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <div class="sec-2">
                        <input class="pas" type="password" name="password" id="passwordField" placeholder="············"/>
                        <span id="passwordError"></span>
                    </div>
                </div>
                <button class="login" onclick="login()">Login</button>
            </div>
        </div>
 
        <script src="user.js"></script>
        <script>


            let user1 = new Admin("Kyle Truss", "kyletruss", "myPassword");
            user1.listAccess();

            let user2 = new Basic("Peter Parker", "peterparker", "myPassword");
            user2.listAccess();

            function login(){
                console.log("in login");
                jQuery.ajax({
                    type: "POST",
                    url: 'checkAuth.php',
                    dataType: 'json',
                    data: {email: document.getElementById("emailField").value, password: document.getElementById("passwordField").value}, 
                    async: true,

                    success: function (obj) {
                        if( !('error' in obj) ) {
                            console.log(obj.result);

                            // clear error tags for multiple tries
                            document.getElementById("emailError").innerHTML = "";
                            document.getElementById("passwordError").innerHTML = "";

                            if(obj.result == "Login Validated"){
                                window.location.href = "index.php";
                            }
                            else if(obj.result == "Email does not exist"){
                                document.getElementById("emailError").innerHTML = obj.result;
                            }
                            else if(obj.result == "Password Incorrect"){
                                document.getElementById("passwordError").innerHTML = obj.result;
                            }
                           
                            
                        }
                        else {
                            console.log(obj);
                          
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        // var err = eval("(" + xhr.responseText + ")");
                        // alert(err.Message);
                        console.log("error");
                    }
                    
                });
            }



        </script>



    </body>
</html>

