/*
    Rafael Marco Manubay
    Student ID: 22169755
    Student Username: dwx3625
    booking.js: A JavaScript file containing all the functions for validating user inputs, showing current date and time within form fields, and utilising XHR for client-server communication.
*/


// Get current date and format it
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();

if(dd < 10) 
{
    dd = "0" + dd;
} 
if(mm < 10) 
{
    mm = "0" + mm;
} 

var formattedDate = yyyy + "-" + mm + "-" + dd;
document.getElementById("currentDate").value = formattedDate;

// Get current time and format it
var hr = today.getHours();
var min = today.getMinutes();

if (hr < 10)
{
    hr = "0" + hr;
}
if (min < 10)
{
    min = "0" + min;
}

var formattedTime = hr + ":" + min;
document.getElementById("currentTime").value = formattedTime;

// Validating user form inputs
function validate()
{
    var cname = document.forms["formDetails"]["cname"].value.trim();
    var phone = document.forms["formDetails"]["phone"].value.trim();
    var snumber = document.forms["formDetails"]["snumber"].value.trim();
    var stname = document.forms["formDetails"]["stname"].value.trim();
    var date = document.forms["formDetails"]["date"].value.trim();
    var time = document.forms["formDetails"]["time"].value.trim();

    // Check for empty or whitespace-only required fields
    if (cname == "" || phone == "" || snumber == "" || stname == "" || date == "" || time === "") 
    {
        alert("Please fill in all required fields. Cannot be whitespaces!");
        return false;
    }

    // Validate customer name to contain only alphabetic characters
    if (!/^[a-zA-Z\s]+$/.test(cname))
    {
        alert("Name must only have alphabetic characters!");
        return false;
    }

    // Validate phone number to be all digits with length between 10-12
    if (!/^\d{10,12}$/.test(phone)) 
    {
        alert("Phone number must be all numbers with length between 10-12. Phone must have no special characters and must follow format like 02041732102.");
        return false;
    }
    
    // Ensure the pick-up date and time is not earlier than the current date and time
    var currentDateTime = new Date();
    var inputDateTime = new Date(date + 'T' + time);

    if (inputDateTime < currentDateTime) 
    {
        alert("Pick-up date and time cannot be earlier than the current date and time.");
        return false;
    }

    return true;
}

// Submit form using XHR
function submitForm()
{
    var xhr = new XMLHttpRequest();
    var form = document.forms["formDetails"];
    var formData = new FormData(form);
    var reference = document.getElementById("reference");
    xhr.open("POST", "booking.php", true);
    xhr.onreadystatechange = function()
    {
        if (xhr.readyState == 4 && xhr.status == 200)
            {
                reference.innerHTML = xhr.responseText;
            }
    }
    xhr.send(formData);
    return false;
}

