const account={uid:"123", pwd:"321"}

function login(){
	if (account.uid == document.getElementById("userid").value){
		if (account.pwd == document.getElementById("password").value)
			alert("Logged in");
		else
			alert("Wrong password")}
	else
		alert("Wrong ID");

	alert("YESS");
	alert(document.getElementById("userid").value)};

