<?php
if (isset($_POST['submit'])) {
    // Get form values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobel'];  // Renamed from $mobel to $mobile
    $city = $_POST['city'];

    // Database credentials
    $host = 'mysql_container';
    $user = 'root';
    $pass = '';
    $dbname = 'saq';

    // Create connection
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL query with placeholders
    $sql = "INSERT INTO student (username, email, mobile, city) VALUES (?, ?, ?, ?)";  // Updated column name to 'mobile'

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters (s stands for strings)
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $mobile, $city);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Adding a gradient background with blue and purple */
        body {
            background: linear-gradient(to bottom, #4c6ef5, #7b5fff, #b44cff); /* Gradient from blue to purple */
            background-size: cover; /* Ensures the gradient covers the entire page */
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        /* Form styling */
        form {
            margin: 0 auto;
            width: 300px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly more opaque white background for form */
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            margin-top: 100px; /* Adds space from the top */
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #6c63ff; /* Purple button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #5a4df5; /* Darker purple on hover */
        }

        /* Add responsiveness */
        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }

        /* Error message styling */
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <form action="#" method="POST" onsubmit="return validateForm()">
        <h2>Enter Your Details</h2>
        Name: <input type="text" name="username" required><br>
        Email: <input type="email" name="email" required><br>
        Mobile No: <input type="number" name="mobel" id="mobel" required><br>
        <span id="mobelError" class="error"></span><br>
        City: <input type="text" name="city" required><br>
        <input type="submit" name="submit" value="Send Data">
    </form>

    <script>
        function validateForm() {
            var mobile = document.getElementById("mobel").value;
            var mobelError = document.getElementById("mobelError");

            // Clear previous error message
            mobelError.textContent = "";

            // Check if mobile number is valid (only numbers and 10 digits)
            var mobilePattern = /^[0-9]{10}$/;
            if (!mobilePattern.test(mobile)) {
                mobelError.textContent = "Please enter a valid 10-digit mobile number.";
                return false; // Prevent form submission
            }

            return true; // Allow form submission if validation passes
        }
    </script>

</body>
</html>

