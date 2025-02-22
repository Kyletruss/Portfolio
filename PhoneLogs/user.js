class User {
    constructor(name, username, role) {
        this.name = name;
        this.username = username;
        this.role = role;
        this.listAllLogs = false;
        this.adminPanel = false;
        this.callsLastMonth = true;

    }
    // This methodology could possibly be used to add more reports later on, use an optional reports array
    setID(id){
        this.id = id;
    }
    getID(){
        return this.id;
    }

    getName(){
        return this.name;
    }
    getRole(){
        return this.role;
    }
    logout(){

        jQuery.ajax({
            type: "POST",
            url: 'logoutUser.php',
            dataType: 'json',
            data: {email: this.username}, 
            async: true,

            success: function (obj) {
                if( !('error' in obj) ) {
                    console.log(obj.result);

                    // refresh the page if logout is successfull, if done correctly, it should redirect to the login page.
                    if(obj.result == "Logout successfull"){
                        location.reload(); 
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


}  

class Basic extends User {
    constructor(name, username, role) {
        // Example of inheretance
        super(name, username, role);
        // Example of polymorphism
        this.callsPerUser = true;
    }

    listAccess() {
        let access = {};
        access["name"] = this.getName();
        access["listAllLogs"] = this.listAllLogs;
        access["adminPanel"] = this.adminPanel;
        access["callsLastMonth"] = this.callsLastMonth;
        access["callsPerUser"] = this.callsPerUser;
        return(access);

        // return this.showName() + '- report1: ' + this.accessToReport1 + 'report2: ' + this.accessToReport2 + 'report2: ' + this.accessToReport3 + 'report4: ' + this.accessToReport4;
    }

}


class Admin extends User {
    constructor(name, username, role) {
        super(name, username, role);
        this.listAllLogs = true; 
        this.adminPanel = true;
        this.callsPerUser = true;
    }

    listAccess() {
        let access = {};
        access["name"] = this.getName();
        access["listAllLogs"] = this.listAllLogs;
        access["adminPanel"] = this.adminPanel;
        access["callsLastMonth"] = this.callsLastMonth;
        access["callsPerUser"] = this.callsPerUser;
        return(access);
        // return this.showName() + '- report1: ' + this.accessToReport1 + 'report2: ' + this.accessToReport2 + 'report2: ' + this.accessToReport3 + 'report4: ' + this.accessToReport4;
    }

}



class Call{
    constructor(userNumber, userName, otherEndNumber, direction, duration, dateTime) {
        this.userNumber = userNumber;
        this.userName = userName;
        this.otherEndNumber = otherEndNumber;
        this.direction = direction;
        this.duration = duration;
        this.dateTime = dateTime;
    }

}



