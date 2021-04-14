$(document).ready(function () {
    $(window).on("load", function () {
        console.log("window loaded");
        recommendSearch();
    });
    $("#recommendOpen").click(function () {
        recommendSearch();
        topFunction();
    });
    $("#MeatOpen").click(function () {
        meatSearch();
        topFunction();
    });
    $("#VegetableOpen").click(function () {
        vegetableSearch();
        topFunction();
    });
    $("#FruitOpen").click(function () {
        fruitSearch();
        topFunction();
    });
    $("#SnackOpen").click(function () {
        snackSearch();
        topFunction();
    });
    $("#AlocholOpen").click(function () {
        alocholSearch();
        topFunction();
    });

    $(".recommendOpen").click(function () {
        recommendSearch();
        topFunction();
    });
});

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function recommendSearch() {
    $('#resultTable').html("");
    console.log("recommendSearch");
    $.ajax({
        type: 'GET',
        url: "../read/item/all.php",
        dataType: 'json',
        success: function (result) {
            window.searchResult = [];
            var rowCount = 0;
            var add_element;
            console.log(result);
            Object.keys(result).forEach(function (key) {
                if (result[key].Recommend == 1) {
                    console.log("Yes");
                    window.searchResult.push(result[key]);
                    console.log(window.searchResult);
                }
                console.log(window.searchResult.length);
            });
            sortName();
            add_element = "<div class='header' style='background:grey;'>Recommend</div>";
            $('#resultTable').inner
            $('#resultTable').append(add_element);
            console.log(window.searchResult);
            for (i = 0; i < window.searchResult.length; i++) {
                add_element = "<div class='item'>";
                add_element += "<img src='";
                add_element += window.searchResult[i].Path;
                add_element += "' class='pro_pic'";
                add_element += "<span class='pro_name'>&nbsp&nbsp&nbsp";
                add_element += window.searchResult[i].Name;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='price'>$";
                add_element += window.searchResult[i].Price;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='QTY'>Stock : ";
                add_element += window.searchResult[i].Quantity;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span>Amount : <input type='number' value='1' id='rec";
                add_element += i + 1;
                add_element += "'></span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='button' class='addToCart' id='";
                add_element += window.searchResult[i].Name;
                add_element += "' value='Enter' onclick='add_element_to_array(this.id," + (i + 1) + ",";
                add_element += window.searchResult[i].Price;
                add_element += ")'></span>";
                add_element += "</div>";
                $('#resultTable').append(add_element);
                add_element = "";
            }
        }
    });
}

function meatSearch() {
    $('#resultTable').html("");
    console.log("MeatSearch");
    $.ajax({
        type: 'GET',
        url: "../read/item/all.php",
        dataType: 'json',
        success: function (result) {
            window.searchResult = [];
            var rowCount = 0;
            var add_element;
            console.log(result);
            Object.keys(result).forEach(function (key) {
                if (result[key].Type == 1) {
                    console.log("Yes");
                    window.searchResult.push(result[key]);
                    console.log(window.searchResult);
                }
                console.log(window.searchResult.length);
            });
            sortName();
            add_element = "<div class='header' style='background:red;'>Meat</div>";
            $('#resultTable').append(add_element);
            console.log(window.searchResult);
            for (i = 0; i < window.searchResult.length; i++) {
                add_element = "<div class='item'>";
                add_element += "<img src='";
                add_element += window.searchResult[i].Path;
                add_element += "' class='pro_pic'";
                add_element += "<span class='pro_name'>&nbsp&nbsp&nbsp";
                add_element += window.searchResult[i].Name;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='price'>$";
                add_element += window.searchResult[i].Price;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='QTY'>Stock:";
                add_element += window.searchResult[i].Quantity;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='number' value='1' id='rec";
                add_element += i + 1;
                add_element += "'></span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='button' class='addToCart' id='";
                add_element += window.searchResult[i].Name;
                add_element += "' value='Enter' onclick='add_element_to_array(this.id," + (i + 1) + ",";
                add_element += window.searchResult[i].Price;
                add_element += ")'></span>";
                add_element += "</div>";
                $('#resultTable').append(add_element);
                add_element = "";
            }
        }
    });
}

function vegetableSearch() {
    $('#resultTable').html("");
    console.log("vagetableSearch");
    $.ajax({
        type: 'GET',
        url: "../read/item/all.php",
        dataType: 'json',
        success: function (result) {
            window.searchResult = [];
            var rowCount = 0;
            var add_element;
            console.log(result);
            Object.keys(result).forEach(function (key) {
                if (result[key].Type == 2) {
                    console.log("Yes");
                    window.searchResult.push(result[key]);
                    console.log(window.searchResult);
                }
                console.log(window.searchResult.length);
            });
            sortName();
            add_element = "<div class='header' style='background:green;'>Vegetable</div>";
            $('#resultTable').append(add_element);
            console.log(window.searchResult);
            for (i = 0; i < window.searchResult.length; i++) {
                add_element = "<div class='item'>";
                add_element += "<img src='";
                add_element += window.searchResult[i].Path;
                add_element += "' class='pro_pic'";
                add_element += "<span class='pro_name'>&nbsp&nbsp&nbsp";
                add_element += window.searchResult[i].Name;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='price'>$";
                add_element += window.searchResult[i].Price;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='QTY'>Stock:";
                add_element += window.searchResult[i].Quantity;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='number' value='1' id='rec";
                add_element += i + 1;
                add_element += "'></span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='button' class='addToCart' id='";
                add_element += window.searchResult[i].Name;
                add_element += "' value='Enter' onclick='add_element_to_array(this.id," + (i + 1) + ",";
                add_element += window.searchResult[i].Price;
                add_element += ")'></span>";
                add_element += "</div>";
                $('#resultTable').append(add_element);
                add_element = "";
            }
        }
    });
}

function fruitSearch() {
    $('#resultTable').html("");
    console.log("fruitSearch");
    $.ajax({
        type: 'GET',
        url: "../read/item/all.php",
        dataType: 'json',
        success: function (result) {
            window.searchResult = [];
            var rowCount = 0;
            var add_element;
            console.log(result);
            Object.keys(result).forEach(function (key) {
                if (result[key].Type == 3) {
                    console.log("Yes");
                    window.searchResult.push(result[key]);
                    console.log(window.searchResult);
                }
                console.log(window.searchResult.length);
            });
            sortName();
            add_element = "<div class='header' style='background:orange;'>fruit</div>";
            $('#resultTable').append(add_element);
            console.log(window.searchResult);
            for (i = 0; i < window.searchResult.length; i++) {
                add_element = "<div class='item'>";
                add_element += "<img src='";
                add_element += window.searchResult[i].Path;
                add_element += "' class='pro_pic'";
                add_element += "<span class='pro_name'>&nbsp&nbsp&nbsp";
                add_element += window.searchResult[i].Name;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='price'>$";
                add_element += window.searchResult[i].Price;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='QTY'>Stock:";
                add_element += window.searchResult[i].Quantity;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='number' value='1' id='rec";
                add_element += i + 1;
                add_element += "'></span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='button' class='addToCart' id='";
                add_element += window.searchResult[i].Name;
                add_element += "' value='Enter' onclick='add_element_to_array(this.id," + (i + 1) + ",";
                add_element += window.searchResult[i].Price;
                add_element += ")'></span>";
                add_element += "</div>";
                $('#resultTable').append(add_element);
                add_element = "";
            }
        }
    });
}

function snackSearch() {
    $('#resultTable').html("");
    console.log("snackSearch");
    $.ajax({
        type: 'GET',
        url: "../read/item/all.php",
        dataType: 'json',
        success: function (result) {
            window.searchResult = [];
            var rowCount = 0;
            var add_element;
            console.log(result);
            Object.keys(result).forEach(function (key) {
                if (result[key].Type == 4) {
                    console.log("Yes");
                    window.searchResult.push(result[key]);
                    console.log(window.searchResult);
                }
                console.log(window.searchResult.length);
            });
            sortName();
            add_element = "<div class='header' style='background:brown;'>snacks</div>";
            $('#resultTable').append(add_element);
            console.log(window.searchResult);
            for (i = 0; i < window.searchResult.length; i++) {
                add_element = "<div class='item'>";
                add_element += "<img src='";
                add_element += window.searchResult[i].Path;
                add_element += "' class='pro_pic'";
                add_element += "<span class='pro_name'>&nbsp&nbsp&nbsp";
                add_element += window.searchResult[i].Name;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='price'>$";
                add_element += window.searchResult[i].Price;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='QTY'>Stock:";
                add_element += window.searchResult[i].Quantity;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='number' value='1' id='rec";
                add_element += i + 1;
                add_element += "'></span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='button' class='addToCart' id='";
                add_element += window.searchResult[i].Name;
                add_element += "' value='Enter' onclick='add_element_to_array(this.id," + (i + 1) + ",";
                add_element += window.searchResult[i].Price;
                add_element += ")'></span>";
                add_element += "</div>";
                $('#resultTable').append(add_element);
                add_element = "";
            }
        }
    });
}

function alocholSearch() {
    $('#resultTable').html("");
    console.log("alocholSearch");
    $.ajax({
        type: 'GET',
        url: "../read/item/all.php",
        dataType: 'json',
        success: function (result) {
            window.searchResult = [];
            var rowCount = 0;
            var add_element;
            console.log(result);
            Object.keys(result).forEach(function (key) {
                if (result[key].Type == 5) {
                    console.log("Yes");
                    window.searchResult.push(result[key]);
                    console.log(window.searchResult);
                }
                console.log(window.searchResult.length);
            });
            sortName();
            add_element = "<div class='header' style='background:lightblue;'>alochol</div>";
            $('#resultTable').append(add_element);
            console.log(window.searchResult);
            for (i = 0; i < window.searchResult.length; i++) {
                add_element = "<div class='item'>";
                add_element += "<img src='";
                add_element += window.searchResult[i].Path;
                add_element += "' class='pro_pic'";
                add_element += "<span class='pro_name'>&nbsp&nbsp&nbsp";
                add_element += window.searchResult[i].Name;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='price'>$";
                add_element += window.searchResult[i].Price;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span class='QTY'>Stock:";
                add_element += window.searchResult[i].Quantity;
                add_element += "</span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='number' value='1' id='rec";
                add_element += i + 1;
                add_element += "'></span>&nbsp&nbsp&nbsp";
                add_element += "<span><input type='button' class='addToCart' id='";
                add_element += window.searchResult[i].Name;
                add_element += "' value='Enter' onclick='add_element_to_array(this.id," + (i + 1) + ",";
                add_element += window.searchResult[i].Price;
                add_element += ")'></span>";
                add_element += "</div>";
                $('#resultTable').append(add_element);
                add_element = "";
            }
        }
    });
}


function sortName() {
    window.searchResult.sort(function (a, b) {
        if (a.Name < b.Name)
            return -1;
        if (a.Name > b.Name)
            return 1;
        return 0;
    });
}
