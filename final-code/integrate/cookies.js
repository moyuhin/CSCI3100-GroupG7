function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkNameCookie() {
    var user = getCookie("userName");
    if (user != "") {
        console.log(user);
        return user;
    } else {
        console.log("withoutLogin");
        return "withoutLogin";
    }
}

function checkIdCookie() {
    var user = getCookie("userId");
    if (user != "") {
        console.log(user);
        return user;
    } else {
        console.log("withoutLogin");
        return "withoutLogin";
    }
}

function deleteCookie() {
    document.cookie = "userName=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function logout() {
    deleteCookie();
    checkNameCookie();
    checkIdCookie();
}
