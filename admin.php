<!--
    Rafael Marco Manubay
    Student ID: 22169755
    Student Username: dwx3625
    admin.php: A PHP file that contains all the scripts used for processing the search term, retrieval of booking requests rows, and creation of table.
-->


<?php

// Database connection
require_once("../../files/settings.php"); 
$dbConnect = @mysqli_connect($host, $user, $pswd);
mysqli_select_db($dbConnect, $dbnm);

$bsearch = mysqli_real_escape_string($dbConnect, $_POST["bsearch"]);

// Check if the request is to assign a booking
if (isset($_POST["assign"])) 
{
    $assignReference = mysqli_real_escape_string($dbConnect, $_POST['bsearch']);
    $sqlAssign = "UPDATE `CabsOnline` SET status = 'ASSIGNED' WHERE booking_no = '$assignReference'";
    $sqlAssignResult = mysqli_query($dbConnect, $sqlAssign);

    echo "<h3 class=\"congrats\">Congratulations!!! The booking with reference number $assignReference has been assigned.</h3>";

    exit;
}

// Search for bookings if no specific reference is provided
if (empty($bsearch)) 
{
    // Query to retrieve bookings within the next 2 hours
    $sqlSearch = "SELECT booking_no, cust_name, phone_number, suburb, destination_suburb, 
    CONCAT(DATE_FORMAT(pickup_date, '%d/%m/%Y'), ' ', TIME_FORMAT(pickup_time,'%H:%i')) as pickup_datetime, status 
    FROM CabsOnline 
    WHERE CONCAT(pickup_date, ' ', pickup_time) BETWEEN NOW() AND NOW() + INTERVAL 2 HOUR";

    $sqlSearchResult = mysqli_query($dbConnect, $sqlSearch);
    if (!$sqlSearchResult) 
    {
        die("Query failed: " . mysqli_error($dbConnect));
    }

    // Display the booking in a table
    if (mysqli_num_rows($sqlSearchResult) > 0) 
    {
        echo "<h2 class=\"Content\">Showing booking requests within 2 hours:</h2>";
        echo "<br><table class=\"tableContent\" width='100%' border='1'>";
        echo "<tr>
                <th>Booking Reference Number</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Pickup Suburb</th>
                <th>Destination Suburb</th>
                <th>Pickup Date and Time</th>
                <th>Status</th>
                <th>Assign</th>
            </tr>";
        
        while ($row = mysqli_fetch_assoc($sqlSearchResult)) 
        {
            
            $isAssigned = ($row['status'] === 'ASSIGNED');
        
            echo "<tr data-reference='{$row['booking_no']}'>
                    <td>{$row['booking_no']}</td>
                    <td>{$row['cust_name']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['suburb']}</td>
                    <td>{$row['destination_suburb']}</td>
                    <td>{$row['pickup_datetime']}</td>
                    <td class='status'>{$row['status']}</td>
                    <td class='assign'>";
            
            
            if (!$isAssigned) 
            {
                echo "<button class=\"buttonTable\" onClick=\"assignBooking('admin.php', 'assignReference', '{$row['booking_no']}')\">Assign</button>";
            } 
            else 
            {
                echo "<button class=\"greyed-out\"disabled>Assigned</button>"; 
            }
        
            echo "</td></tr>";
        }
        
        echo "</table>";
    } 
    else 
    {
        echo "<h2 class=\"Content\">No booking requests within 2 hours! Please try again later!</h2>";
    }
} 
else 
{
    // Search for bookings based on a booking reference number
    $sqlSearch = "SELECT booking_no, cust_name, phone_number, suburb, destination_suburb, 
    CONCAT(DATE_FORMAT(pickup_date, '%d-%m-%Y'), ' ', pickup_time) as pickup_datetime, status 
    FROM CabsOnline 
    WHERE booking_no LIKE '$bsearch'";

    $sqlSearchResult = mysqli_query($dbConnect, $sqlSearch);
    if (!$sqlSearchResult) 
    {
        die("Query failed: " . mysqli_error($dbConnect));
    }

    // Display the booking in a table
    if (mysqli_num_rows($sqlSearchResult) > 0) 
    {
        echo "<br><table class=\"tableContent\" width='100%' border='1'>";
        echo "<tr>
                <th>Booking Reference Number</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Pickup Suburb</th>
                <th>Destination Suburb</th>
                <th>Pickup Date and Time</th>
                <th>Status</th>
                <th>Assign</th>
            </tr>";
        
        
        while ($row = mysqli_fetch_assoc($sqlSearchResult)) 
        {
            
            $isAssigned = ($row['status'] === 'ASSIGNED');
        
            echo "<tr data-reference='{$row['booking_no']}'>
                    <td>{$row['booking_no']}</td>
                    <td>{$row['cust_name']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['suburb']}</td>
                    <td>{$row['destination_suburb']}</td>
                    <td>{$row['pickup_datetime']}</td>
                    <td class='status'>{$row['status']}</td>
                    <td class='assign'>";
            
            
            if (!$isAssigned) 
            {
                echo "<button class=\"buttonTable\" onClick=\"assignBooking('admin.php', 'assignReference', '{$row['booking_no']}')\">Assign</button>";
            } 
            else 
            {
                echo "<button class=\"greyed-out\"disabled>Assigned</button>"; 
            }
        
            echo "</td></tr>";
        }
        
        echo "</table>";
    } 
    else 
    {
        echo "<h2 class=\"Content\">No matching results! Booking reference number must be in format BRN00000!</h2>";
    }
}





mysqli_close($dbConnect);
?>
