$(document).ready(function () {
    $(window).on("load", function () {
        console.log("window loaded");
        getUser();
    });
});

function doesLogin() {
    if (checkNameCookie() != "withoutLogin") {
        document.getElementById('logoutBtn').innerHTML = checkNameCookie() + ": Logout";
        console.log("doeslogin");
    } else {
        window.location.href = 'index.html';
    }
}

function getUser() {
    var values = Array();
    values[0] = checkIdCookie();
    var requestValue = JSON.stringify(values);
    console.log("getUser");
    console.log(values);
    $.ajax({
        type: 'POST',
        url: "../read/normalUserId.php",
        dataType: 'json',
        data: requestValue,
        success: function (result) {
            console.log("success");
            window.searchResult = [];
            var rowCount = 0;
            var add_element;
            console.log(result);
            Object.keys(result).forEach(function (key) {
                window.searchResult.push(result[key]);
                console.log(window.searchResult);
                console.log(window.searchResult.length);
            });
            $('#showId').html("User ID : "+window.searchResult[1]);
            $('#showName').html("Name : "+window.searchResult[2]);
            $('#showEmail').html("Email : "+window.searchResult[3]);
        }
    });
}