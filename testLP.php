<html>
    <head>
        <title>MelodyMart</title>
    </head>

    <body>
        <?php
        include("header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['userEmail'])) {
        $e = mysqli_real_escape_string($connect, $_POST['userEmail']);
    } else {
        $e = FALSE;
        echo '<p class="error">You forgot to enter your email.</p>';
    }


    if (!empty($_POST['userPass'])) {
        $p = mysqli_real_escape_string($connect, $_POST['userPass']);
    } else {
        $p = FALSE;
        echo '<p class="error">You forgot to enter your password.</p>';
    }

    if ($e && $p) {
        $q = "SELECT userPass, userName, userPhone, userAddress
            FROM user WHERE
            (userEmail = '$e' AND userPass = '$p')";

        $result = mysqli_query($connect, $q);

        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

        
            exit();
        } else {
            echo '<p class="error">The email and password entered do not match our records.
                <br>Perhaps you need to register, just click the Register button.</p>';
        }
    } else {
        echo '<p class="error">Please try again.</p>';
    }

    mysqli_close($connect);
}
        ?>

        <h2>LOGIN</h2>

        <form action="userLogin.php" method = "post"> 
            <div>
            <input type="text" placeholder="Email" name="userEmail" id="userEmail" size="30" maxlength="50"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                title="Please enter a valid email address in the format 'user@example.com'"
                required value="<?php if (isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>" />
            </div>

            <div>
                <input type="password" id="userPass" name="userPass" size="15" maxlength="60" 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase and lowercase letter and at least 8
                or more characters" required value="<?php if(isset($_POST['userPass'])) echo $_POST['userPass']; ?>">
            </div>

            <div>
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </div>

            <div>
                <label>Don't have an account ? <a href="userRegister.php">Sign Up</a>
            </label>
            </div>
        </form>
    </body>
</html>