// from cart.js

//global var
var x = 0;
var array2D = Array();
var array = Array(); //array for the amount of item
var array2 = Array(); //array for the name of the item
var array3 = Array(); //price
array2D[0] = array;
array2D[1] = array2;
array2D[2] = array3;
var Total_p = 0; //total price of the bills

//part1: Modal funciton
//get modal element
var modal = document.getElementById('shopping_cart');

//get open modal button
var modalBtn = document.getElementById('modalBtn');

//get close button
var closeBtn = document.getElementById('close');

//get the pay button
var payBtn = document.getElementById('payBtn');

//click event


//open the modal
function openModal() {
    document.getElementById('shopping_cart').style.display = 'block';
    display_array();
}

//close the modal
function closeModal() {
    document.getElementById('shopping_cart').style.display = 'none';
}

//fucntion clear the array and close the modal
// when click the buuton, reset the array
function payAction() {
    modal.style.display = 'none';
    array.length = 0;
    array2.length = 0;
    array3.length = 0;
    Total_p = 0;
    x = 0;
}

//Part2: Record System
// when everytime click button, the array would store the data pass thorugh the parameter
function add_element_to_array(item_name, amount, price) {
    var inVal = "rec" + amount;
    console.log(inVal);
    array[x] = document.getElementById(inVal).value;
    array2[x] = item_name;
    array3[x] = price;
    Total_p = Total_p + price * array[x];
    console.log(array[x]);
    console.log(JSON.stringify(array2D));
    alert("Item: " + array2[x] + "($" + array3[x] + ") with amount " + array[x] + " added to cart row " + (x + 1));
    x++;
}

//when the click button, the modal will print what user have store in the system
function display_array() {
    var e = "<p> Your cart record is: </p>";

    for (var y = 0; y < array.length; y++) {
        e += "Item: " + array2[y] + "($" + array3[y] + ")     Amount: " + array[y] + "<br/>";
    }

    e += "<br/>Total price: " + Total_p + "<br/>";

    document.getElementById("Result").innerHTML = e;
}

var xmlhttp;

function setOrder(cookiesId) {
    console.log(array2D);
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var values = Array();
    values[0] = cookiesId;
    values[1] = Total_p;
    console.log(values);
    var requestValue = JSON.stringify(values);
    xmlhttp.onreadystatechange = setOrderRespond;
    xmlhttp.open("POST", "../create/orders.php", true);
    xmlhttp.send(requestValue);
}

function setOrderRespond() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        console.log(xmlhttp.responseText);
        var obj = JSON.parse(xmlhttp.responseText);

        if (obj.success == "false") {
            document.getElementById('Result').innerHTML = "Cannot create this order!"
        } else {
            setOrdersItem(obj.OrderId);
        }
    }
}

function setOrdersItem(orderId) {
    console.log("setoi");
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var values2 = Array();
    values2[0] = orderId;
    values2[1] = array2D[0];
    values2[2] = array2D[1];
    values2[3] = array2D[2];
    console.log(values2);
    var requestValue = JSON.stringify(values2);
    xmlhttp.onreadystatechange = setOrdersItemRespond;
    xmlhttp.open("POST", "../create/ordersItem.php", true);
    xmlhttp.send(requestValue);
}

function setOrdersItemRespond() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        console.log("order success");
        alert("Order created successfully!");
        window.location.href = 'index.html';
    }
}
