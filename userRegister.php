<html>
    <head>
        <title>MelodyMart</title>
        <link rel="stylesheet" href="styleUP.css">
    </head>

    <body>

    <?php

include("config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input fields
    $error = array();

    // Check if email is empty
    if (empty($_POST['userEmail'])) {
        $error[] = 'You forgot to enter your email.';
    } else {
        $e = mysqli_real_escape_string($connect, trim($_POST['userEmail']));
    }

    // Check if email format is correct
    if (!preg_match("/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i", $e)) {
        $error[] = 'Please enter a valid email address in the format \'user@example.com\'.';
    }

    // Check if password is empty
    if (empty($_POST['userPass'])) {
        $error[] = 'You forgot to enter password.';
    } else {
        $p = mysqli_real_escape_string($connect, trim($_POST['userPass']));
    }

    // Check if name is empty
    if (empty($_POST['userName'])) {
        $error[] = 'You forgot to enter your name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['userName']));
    }

    // Check if phone number is empty
    if (empty($_POST['userPhone'])) {
        $error[] = 'You forgot to enter your phone number.';
    } else {
        $ph = mysqli_real_escape_string($connect, trim($_POST['userPhone']));
    }

    // Check if address is empty
    if (empty($_POST['userAddress'])) {
        $error[] = 'You forgot to enter your address.';
    } else {
        $ad = mysqli_real_escape_string($connect, trim($_POST['userAddress']));
    }

    // Check if there are any errors
    if (empty($error)) {
        // Check if email already exists in the database
        $check_email_query = "SELECT userEmail FROM user WHERE userEmail = '$e'";
        $check_email_result = mysqli_query($connect, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            // Email already exists, notify the user
            echo '<p class="error">The email you entered is already in use. Please choose a different email.</p>';
        } else {
            // Email is available, proceed with registration
            $insert_query = "INSERT INTO user(userEmail, userPass, userName, userPhone, userAddress)
                            VALUES ('$e', '$p', '$n', '$ph', '$ad')";
            $insert_result = mysqli_query($connect, $insert_query);

            if ($insert_result) {
                echo '<h1>Thank You.</h1>';
                echo '<p><a href="LoginPage.php">Go back to Login</a></p>';
                exit();
            } else {
                echo '<h1>System Error.</h1>';
                echo '<p>' . mysqli_error($connect) . '<br><br>Query : ' . $insert_query . '</p>';
            }
        }
    } else {
        // Display errors if any
        foreach ($error as $err) {
            echo '<p class="error">' . $err . '</p>';
        }
    }

    mysqli_close($connect);
}
?>

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="userRegister.php" method="post">
            <h1>User Register</h1>
            <input type="text" placeholder="Email (user@example.com)" name="userEmail" id="userEmail" size="30" maxlength="50"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="Please enter a valid email address in the format 'user@example.com'"
                required value="<?php if (isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>" />
            <input type="password" placeholder="Password" id="userPass" name="userPass" size="15" maxlength="60"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one number, one uppercase and lowercase letter and at least 8 or more characters"
                required value="<?php if (isset($_POST['userPass'])) echo $_POST['userPass']; ?>" />
            <input type="text" placeholder="Name" name="userName" id="userName" size="30" maxlength="50"
                required value="<?php if (isset($_POST['userName'])) echo $_POST['userName']; ?>" />
            <input type="tel" placeholder="Phone No." name="userPhone" id="userPhone" size="15" maxlength="20"
                pattern="[0-9]{3}-[0-9]{7}"
                required value="<?php if (isset($_POST['userPhone'])) echo $_POST['userPhone']; ?>" />
            <textarea placeholder="Address" name="userAddress" id="userAddress" size="30" maxlength="50"
                required><?php if (isset($_POST['userAddress'])) echo $_POST['userAddress']; ?></textarea>
            <button type="submit">Register</button>
        </form>
    </div>
</div>
    </body>
</html>