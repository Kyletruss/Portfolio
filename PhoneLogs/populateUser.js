


userInfoDropdownContent = document.getElementById("userInfoDropdownContent");
p = document.createElement("p");
// Example of encapsulation
p.innerHTML = user.getName();
p.classList.add("versionChoice");
// p.setAttribute("onclick","setVersion('" + versionArr.sort()[i] + "');");

userInfoDropdownContent.appendChild(p);


p = document.createElement("p");
p.innerHTML = user.getRole();
p.classList.add("versionChoice");


userInfoDropdownContent.appendChild(p);



p = document.createElement("p");
p.innerHTML = "Logout";
p.classList.add("versionChoice");


p.onclick = function() { user.logout(); };
userInfoDropdownContent.appendChild(p);