# CabsOnline
 As part of my coursework, I developed a cab booking system named 'CabsOnline.' This system is designed to facilitate cab bookings through a user-friendly form, which then sends the requests to the admin side for processing and management. Admins can prioritize viewing and managing all booking requests within a 2-hour window. 
 
 ## Technologies Used:
 - HTML/CSS: For a responsive and enjoyable web design interface
 - JavaScript and AJAX: For client-server communication
 - PHP: For server-side processing
 - MySQL: Utilized for storing all customer and booking information

## How to use the application:
- Clone repo: `git clone https://github.com/rafaelmarcoo/CabsOnline`
- Open XAMPP and start Apache and MySQL
- In phpMyAdmin, create a database named 'cabsonline'
- Paste SQL table creation script sqlTableCreation.sql
- Run booking.html for customer side and admin.html for admin side using XAMPP

### Booking Side
An HTML page containing a form for users to fill out to make a taxi booking request. It also implements validation to check users' for validity, like date and time cannot be earlier than current time, etc. The webpage then updates dynamically with the use of Asynchronous JavaScript and XML (AJAX).
![image](https://github.com/user-attachments/assets/ccd20636-ca41-49f5-83d9-806c63d70c2b)
![image](https://github.com/user-attachments/assets/30ef1435-d212-4f67-a50b-7f5e55d8de41)
![image](https://github.com/user-attachments/assets/b9f5644a-3d5d-4b95-b555-5bd4e927e90b)
![image](https://github.com/user-attachments/assets/8c1e6cff-43e7-4445-b91f-e20a09e8fb65)

### Admin Side
The admin side has the ability to view all booking requests by using a search input, and assign these requests to a taxi.
![image](https://github.com/user-attachments/assets/4d8f6fb4-7d9d-4139-a3e6-e1176a2d616f)
To search for booking requests, go on to admin.html which contains a search input. You must follow the booking format of BRN00000. Enter a booking reference number and it will retrieve the booking request matching the booking reference number along with all the relevant details, including an assign button to assign the booking to a taxi.
![image](https://github.com/user-attachments/assets/2d920eac-3151-42b9-96a8-660d7ebae7f3)
When the assign button is clicked, a confirmation message will appear dynamically and the assign button will change colors and be disabled.
![image](https://github.com/user-attachments/assets/ac105441-f0a3-4abb-baa0-b5b12c36db76)
To view all the booking requests within 2 hours from the current time, leave the search input empty and press the search button and it will retrieve all the booking requests within 2 hours from the current time, including all the relevant details regarding the booking request and an assign button.
![image](https://github.com/user-attachments/assets/67ad6a0e-06f2-44b9-bfb9-532de558e468)








