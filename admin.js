var xhr = new XMLHttpRequest();

// Function to get booking data based on the search input
function getData(dataSource, reference, pbsearch) 
{
    if (xhr) 
    {
        var obj = document.getElementById(reference);
        var requestbody = "bsearch=" + encodeURIComponent(pbsearch);

        xhr.open("POST", dataSource, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () 
        {
            if (xhr.readyState == 4 && xhr.status == 200) 
            {
                obj.innerHTML = xhr.responseText;
            }
        };
        xhr.send(requestbody);
    }
}

// Function to assign a booking based on the booking number
function assignBooking(dataSource, reference, bookingNo) 
{
    if (xhr) 
    {
        var requestbody = "assign=true&bsearch=" + encodeURIComponent(bookingNo);

        xhr.open("POST", dataSource, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () 
        {
            if (xhr.readyState == 4 && xhr.status == 200) 
            {
                // Update the booking status in the table row
                var statusCell = document.querySelector(`tr[data-reference='${bookingNo}'] .status`);
                statusCell.textContent = 'ASSIGNED';

                // Disable the assign button after assignment
                var assignButtonCell = document.querySelector(`tr[data-reference='${bookingNo}'] .assign`);
                assignButtonCell.innerHTML = 'Assigned';
                assignButtonCell.classList.add('greyed-out');
                
                document.getElementById(reference).innerHTML = xhr.responseText;
            }
        };
        xhr.send(requestbody);
    }
}
