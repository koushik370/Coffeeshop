<?php
// Database connection
$servername = "localhost";  // Change to your database host if not on localhost
$username = "root";         // Your database username (default for XAMPP is "root")
$password = "";             // Your database password (default for XAMPP is an empty string)
$dbname = "contact_form";   // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Insert data into the database
    $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for contacting us. We will get back to you shortly!";
    } else {
        $message = "There was an error, please try again later.";
    }
    
    // Close the connection
    $conn->close();
}
?>

<!-- HTML Form for input (shown before form submission) -->
<?php if ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
    <form action="contact.php" method="POST">
        <h3>Get in touch</h3>
        <div class="inputBox">
            <span class="fas fa-user"></span>
            <input type="text" name="name" placeholder="Name" required>
        </div>
        <div class="inputBox">
            <span class="fas fa-envelope"></span>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="inputBox">
            <span class="fas fa-phone"></span>
            <input type="text" name="phone" placeholder="Phone Number" required>
        </div>
        <input type="submit" value="Contact Now" class="btn">
    </form>
<?php else: ?>
    <!-- Thank You Message after Form Submission -->
    <div class="thank-you-message">
        <h2><?php echo $message; ?></h2>
    </div>
<?php endif; ?>

<!-- Styling -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    
    form {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }
    
    .inputBox {
        margin-bottom: 20px;
        position: relative;
    }
    
    .inputBox input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        outline: none;
        font-size: 14px;
    }

    .inputBox input:focus {
        border-color: #007bff;
    }

    .inputBox span {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #007bff;
    }

    .btn {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    /* Thank you message styling */
    .thank-you-message {
        background-color: #fff;
        padding: 40px;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .thank-you-message h2 {
        color: #28a745;
        font-size: 24px;
        margin: 0;
    }
</style>
