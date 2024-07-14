<?php

// Database connection
require_once ("../../files/settings.php"); 
$dbConnect = @mysqli_connect($host, $user, $pswd);
mysqli_select_db($dbConnect, $dbnm);

$cname = mysqli_real_escape_string($dbConnect, $_POST["cname"]);
$phone = mysqli_real_escape_string($dbConnect, $_POST["phone"]);
$unumber = mysqli_real_escape_string($dbConnect, $_POST["unumber"]);
$snumber = mysqli_real_escape_string($dbConnect, $_POST["snumber"]);
$stname = mysqli_real_escape_string($dbConnect, $_POST["stname"]);
$sbname = mysqli_real_escape_string($dbConnect, $_POST["sbname"]);
$dsbname = mysqli_real_escape_string($dbConnect, $_POST["dsbname"]);
$date = mysqli_real_escape_string($dbConnect, $_POST["date"]);
$time = mysqli_real_escape_string($dbConnect, $_POST["time"]);

// Retrieve the highest booking number from the database
$sqlHighest = "SELECT MAX(booking_no) AS maxBooking FROM CabsOnline";
$sqlHighestResult = mysqli_query($dbConnect, $sqlHighest);
if ($sqlHighestResult) 
{
    $row = mysqli_fetch_assoc($sqlHighestResult);
    $highestBookingNo = $row['maxBooking'];
    $bookingNo = "";
    $highestBookingNoArr = str_split($highestBookingNo, 1);

    // Extracting the numeric part of the highest booking number
    for ($i = 0; $i < count($highestBookingNoArr); $i++)
    {
        if (ctype_digit($highestBookingNoArr[$i])) 
        {
            $bookingNo .= $highestBookingNoArr[$i];
        }
    }

    // Increment booking number for new booking
    $bookingNo += 1;
    $bookingRef = "BRN" . str_pad($bookingNo, 5, '0', STR_PAD_LEFT);

    $status = "unassigned";

    // Insert new booking into the database
    $sqlInsert = "INSERT INTO `CabsOnline`(`booking_no`, `cust_name`, `phone_number`, `unit_number`, `street_number`, `street_name`, `suburb`, `destination_suburb`, `pickup_date`, `pickup_time`, `status`) VALUES ('$bookingRef','$cname','$phone','$unumber','$snumber','$stname','$sbname','$dsbname','$date','$time','$status')";

    if (mysqli_query($dbConnect, $sqlInsert)) 
    {
        echo "Thank You for your booking! <br><br>";
        echo "Booking reference number: " . $bookingRef . "<br>";
        echo "Pickup time: " . $time . "<br>";

        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        $date = $dateObj->format('d/m/Y');
        echo "Pickup date: " . $date;
    } 
    else 
    {
        echo "Error: " . $sqlInsert . "<br>" . mysqli_error($dbConnect);
    }
} 
else 
{
    echo mysqli_error($dbConnect);
}


mysqli_close($dbConnect);
?>
