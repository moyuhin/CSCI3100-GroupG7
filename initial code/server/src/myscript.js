function validateID() {
    var pattern =  /^\d{1,11}$/;
    var id=document.getElementById("loginID").value;
    if(id.match(pattern))
    {
        document.getElementById("lblID").innerText="  ok";
    }
    else
    {
        document.getElementById("lblID").innerText="  User ID must be a 1-11 digit number";
        document.getElementById("loginID").focus();
    }
}
function validatePW() {
    var str=document.getElementById("pw").value;
    if(str.indexOf(' ') >= 0)
    {
        document.getElementById("lblPW").innerText="  Whitespace is not allowed for the password";
        document.getElementById("pw").focus();
    }else if(str===""){
        document.getElementById("lblPW").innerText="  Please Input the password!!";
        document.getElementById("pw").focus();
    }else{
        document.getElementById("lblPW").innerText="  ok";
    }
}

function clearLbl() {
    document.getElementById("lblID").innerText="  ";
    document.getElementById("lblPW").innerText="  ";
}

function checkQTY(maxAmount){
    var createQTY=document.getElementById("createQTY").value;
    if(createQTY!="") {
        if(createQTY<=0){
            document.getElementById("lblWarning").innerText="The order amount should not be\n less than or equal to zero!!";
            return false;
        } else if (maxAmount-createQTY<0) {
            document.getElementById("lblWarning").innerText="The order amount should\n less th stock amount!!";
            return false;
        }else if(maxAmount-createQTY>=0){
            return confirm('Are you sure to create this order?');
        }
    }else{
        document.getElementById("lblWarning").innerText="Please input the amount!";
        return false;
    }
}
function checkDesc() {
    var modifyDesc=document.getElementById("theDesc").value;
    if(modifyDesc!="") {
        return confirm("Are you sure to modify the description?");
    }else{
        document.getElementsByName("modifyDesc")[0].placeholder="Please input some descriptions!";
        return false;
    }
}