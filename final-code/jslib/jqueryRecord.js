$(document).ready(function () {
    $(window).on("load", function () {
        console.log("window loaded");
        orderSearch();
    });
});

$(document).on('click', '.detail', function (e) {
    console.log(this.id);
    ordersItemSearch(this.id);
});

function doesLogin() {
    if (checkNameCookie() != "withoutLogin") {
        document.getElementById('logoutBtn').innerHTML = checkNameCookie() + ": Logout";
    } else {
        window.location.href = 'index.html';
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function orderSearch() {
    var values = Array();
    values[0] = checkIdCookie();
    var requestValue = JSON.stringify(values);
    $('#resultTable1').html("");
    console.log("orderSearch");
    $.ajax({
        type: 'POST',
        url: "../read/order/all.php",
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
            sortID();


            for (i = 0; i < window.searchResult.length; i++) {
                if (i == 0) {
                    add_element = "<tbody>";
                    add_element += "<tr><th>Order ID.</th><th>Total Price</th><th>Created Date</th><th>Approved</th><th>Details</th></tr>";
                    $('#resultTable1').append(add_element);
                }

                add_element = "<tr>";
                add_element += "<td>";
                add_element += window.searchResult[i].OrderId;
                add_element += "</td>";
                add_element += "<td>";
                add_element += window.searchResult[i].TotalPrice;
                add_element += "</td>";
                add_element += "<td>";
                add_element += window.searchResult[i].PurchaseDate;
                add_element += "</td>";
                add_element += "<td>";
                add_element += window.searchResult[i].Approved;
                add_element += "</td>";
                add_element += "<td><button class='detail' id='";
                add_element += window.searchResult[i].OrderId;
                add_element += "'>check</button></td>";
                add_element += "</tr>";
                $('#resultTable1').append(add_element);
                add_element = "";

            }
            add_element = "</tbody>";
            $('#resultTable1').append(add_element);

        }
    });
}

function ordersItemSearch(theId) {
    var values = Array();
    values[0] = theId;
    var requestValue = JSON.stringify(values);
    $('#resultTable2').html("");
    console.log("orderItemSearch");
    $.ajax({
        type: 'POST',
        url: "../read/ordersItem/all.php",
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
            sortID();

            for (i = 0; i < window.searchResult.length; i++) {
                if (i == 0) {
                    add_element = "<tbody>";
                    add_element += "<tr><th>Order ID.</th><th>ItemId</th><th>ItemName</th><th>OrderQuantity</th></tr>";
                    $('#resultTable2').append(add_element);
                }

                add_element = "<tr>";
                add_element += "<td>";
                add_element += window.searchResult[i].OrderId;
                add_element += "</td>";
                add_element += "<td>";
                add_element += window.searchResult[i].ItemId;
                add_element += "</td>";
                add_element += "<td>";
                add_element += window.searchResult[i].ItemName;
                add_element += "</td>";
                add_element += "<td>";
                add_element += window.searchResult[i].OrderQuantity;
                add_element += "</td>";
                add_element += "</tr>";
                $('#resultTable2').append(add_element);
                add_element = "";

            }
            add_element = "</tbody>";
            $('#resultTable2').append(add_element);


        }
    });
}



function sortID() {
    window.searchResult.sort(function (a, b) {
        if (a.OrderId < b.OrderId)
            return -1;
        if (a.OrderId > b.OrderId)
            return 1;
        return 0;
    });
}
