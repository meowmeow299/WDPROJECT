<html>
    <head>
        <title>MelodyMart|Login</title>
        <link rel="stylesheet" href="styleLP.css">
    </head>


    <body>

    <h1>Welcome to MelodyMart</h1>

		<?php
        include("config.php");
        ?>

        <?php

        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            if(!empty($_POST['userEmail']))
            {
                $e = mysqli_real_escape_string($connect, $_POST['userEmail']);
            }

            else
            {
                $e = FALSE;
                echo '<p class="error">You forgot to enter your email.</p>';
            }

            if(!empty($_POST['userPass']))
            {
                $p = mysqli_real_escape_string($connect, $_POST['userPass']);
            }

            else
            {
                $p = FALSE;
                echo '<p class="error">You forgot to enter your password.</p>';
            }

            if($e && $p)
            {
                $q = "SELECT  userPass, userName, userPhone, userAddress
                 FROM user WHERE
                (userEmail = '$e' AND userPass = '$p')";

                $result = mysqli_query($connect, $q);

                if(@mysqli_num_rows ($result)==1)
                {
                    session_start();
                    $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    header("Location: main.php");

                    exit ();

                    mysqli_free_result($result);
                    mysqli_close($connect);
                }

                else
                {
                    echo '<p class="error">The email and password entered do not match our records
                    <br>Perhaps you need to register, just click the Register button</p>';
                }
            }

            else
            {
                echo '<p class="error">Please try again.</p>';
            }

            mysqli_close($connect);
        }
        ?>
      


      <div class="container" id="container">

<div class="form-container sign-in-container">
    <form action="LoginPage.php" method="post">
        <h1>Sign in</h1>

        <input type="text" placeholder="Email (user@example.com)" name="userEmail" id="userEmail" size="30" maxlength="50"
            pattern="[a-z0-9._&+-]+@[a-z0-9]+\.[a-z]{2,}$" title="Please follow this format 'user@example.com'"
            required value="<?php if (isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>" />
        

        <input type="password" placeholder="Password" id="userPass" name="userPass" size="15" maxlength="60"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Must contain at least one number, one uppercase and lowercase letter and at least 8
        or more characters" required value="<?php if (isset($_POST['userPass'])) echo $_POST['userPass']; ?>">
        <button type="submit">Sign In</button>
    </form>
</div>
<div class="overlay-container">
    <div class="overlay">
        <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start
                <br>choose and buy your dream guitar</p>
            <button class="ghost" id="signUp"><a href="userRegister.php">Sign Up</a></button>
        </div>
    </div>
</div>
</div>

<footer>
<p>Author: Amirah Afiqah.</p>
      <ul>
        <li><a href="aamirah229@gmail.com">aamirah229@gmail.com</a></li>
      </ul>
</footer>
    </body>
</html>