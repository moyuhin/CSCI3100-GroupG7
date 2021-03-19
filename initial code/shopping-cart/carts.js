//global var
var x = 0;
var array = Array();

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
modalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
payBtn.addEventListener('click', payAction);

//open the modal
function openModal(){
		modal.style.display = 'block';
}

//close the modal
function closeModal(){
		modal.style.display = 'none';
}

//fucntion clear the array and close the modal
// when click the buuton, reset the array
function payAction()
{
		for (var z = 0; z < array.length; z++)
		{
				array[z] = null;
		}
		modal.style.display = 'none';
}

//Part2: Record System
// when everytime click button, the array would store the data pass thorugh the parameter
function add_element_to_array(amount)
{
 array[x] =  amount;
 alert("Element: " + array[x] + " Added at index " + x);
 x++;
}

//when the click button, the modal will print what user have store in the system
   function display_array()
{
   var e = "<p> the record is: </p>";   
    
   for (var y=0; y<array.length; y++)
   {
     e += "Element " + y + " = " + array[y] + "<br/>";
   }
   document.getElementById("Result").innerHTML = e;
}
