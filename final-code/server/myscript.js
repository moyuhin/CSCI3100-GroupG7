function validateID() {
    var pattern = /^\d{1,11}$/;
    var id = document.getElementById("loginID").value;
    if (id.match(pattern)) {
        document.getElementById("lblID").innerText = "  ok";
    } else {
        document.getElementById("lblID").innerText = "  User ID must be a 1-11 digit number";
        document.getElementById("loginID").focus();
    }
}

function validatePW() {
    var str = document.getElementById("pw").value;
    if (str.indexOf(' ') >= 0) {
        document.getElementById("lblPW").innerText = "  Whitespace is not allowed for the password";
        document.getElementById("pw").focus();
    } else if (str === "") {
        document.getElementById("lblPW").innerText = "  Please Input the password!!";
        document.getElementById("pw").focus();
    } else {
        document.getElementById("lblPW").innerText = "  ok";
    }
}

function clearLbl() {
    document.getElementById("lblID").innerText = "  ";
    document.getElementById("lblPW").innerText = "  ";
}
