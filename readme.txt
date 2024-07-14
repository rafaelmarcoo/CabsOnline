booking.html:
    An HTML page containing a form for users to fill out to make
    a taxi booking request
booking.js
    A JavaScript file containing all the functions for validating user inputs, showing current date and time within form fields, and utilising XHR for client-server communication.
booking.php
    A PHP file which contains receiving user inputs for processing through the database.
admin.html
    An HTML page containing a search form to retrieve booking requests.
admin.js
    A JavaScript file containing the functions that retrieve the user search term and assigning booking requests. And utilising XHR for client-server communication.
admin.php
    A PHP file that contains all the scripts used for processing the search term, retrieval of booking requests rows, and creation of table.
styles.css
    A CSS file containing all the scripts for styling.
mysqlcommand.txt
    A text file containing all the SQL statements used throughout the assignment.
readme.txt  
    Brief instructions on how to use the system.



Instruction on how to use the system:

    Booking Side: booking.html, booking.js, booking.php

        To book a taxi, you must go to booking.html, which contains the form to be filled out for a booking request.

        After filling it out and submitting the form, a confirmation message will appear containing the booking reference number, pickup date and pick up time.
    
    Admin Side: admin.html, admin.js, admin.php

        The admin side has the ability to view all booking requests by using a search input, and assign these requests to a taxi.

        To search for booking requests, go on to admin.html which contains a search input. You must follow the booking format of BRN00000. Enter a booking reference number and it will retrieve the booking request matching the booking reference number along with all the relevant details, including an assign button to assign the booking to a taxi.

        When the assign button is clicked, a confirmation message will appear and the assign button will change colors and be disabled.

        To view all the booking requests within 2 hours from the current time, leave the search input empty and press the search button and it will retrieve all the booking requests within 2 hours from the current time, including all the relevant details regarding the booking request and an assign button.

        And when the assign button is clicked, a confirmation message will appear and the assign button will change colors and be disabled.


