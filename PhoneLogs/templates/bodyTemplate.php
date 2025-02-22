<!-- just for copy and paste, do not run -->


<?php include("loginCheck.php")?>
<!DOCTYPE html>
<html lang="en">
<?php include("navBar.php"); ?>
    <body>
        test
        <script src="user.js"></script>
        <script>
            reportName = "report";
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


        </script>
        <script src="populateUser.js"></script>
    </body>
</html>
