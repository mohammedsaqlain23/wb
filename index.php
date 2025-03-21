<?php
if (isset($_POST['submit'])) {
    // Get form values and sanitize input
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);  // Fixed field name
    $city = htmlspecialchars($_POST['city']);

    // Database credentials
    $host = 'mysql_container';
    $user = 'root';
    $pass = 'rootpass';  // Use the correct password
    $dbname = 'saq';

    // Create connection
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check connection
    if (!$conn) {
        die("<p style='color:red;'>❌ Connection failed: " . mysqli_connect_error() . "</p>");
    }

    // Prepare SQL query with placeholders
    $sql = "INSERT INTO student (username, email, mobile, city) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $mobile, $city);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<p style='color:green;'>✅ Data inserted successfully.</p>";
    } else {
        echo "<p style='color:red;'>⚠️ Error: " . mysqli_error($conn) . "</p>";
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
    <title>Submit Your Details</title>
    <style>
        body {
            background: linear-gradient(to bottom, #4c6ef5, #7b5fff, #b44cff);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 350px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #6c63ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #5a4df5;
        }

        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <form action="#" method="POST" onsubmit="return validateForm()">
        <h2>Enter Your Details</h2>
        <input type="text" name="username" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email Address" required><br>
        <input type="number" name="mobile" id="mobile" placeholder="Mobile Number" required><br>
        <span id="mobileError" class="error"></span><br>
        <input type="text" name="city" placeholder="City" required><br>
        <input type="submit" name="submit" value="Send Data">
    </form>

    <script>
        function validateForm() {
            var mobile = document.getElementById("mobile").value;
            var mobileError = document.getElementById("mobileError");

            mobileError.textContent = "";

            var mobilePattern = /^[0-9]{10}$/;
            if (!mobilePattern.test(mobile)) {
                mobileError.textContent = "Please enter a valid 10-digit mobile number.";
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
