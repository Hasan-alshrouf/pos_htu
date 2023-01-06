<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/css/login/styles.css">
    <title> Login</title>
</head>

<body>

    <form method="POST" action="/authenticate">

        <div class="login">
            <h2 class="active"> Login Dashboard </h2>
            <hr>
            <div class="inp">

                <input type="email" class="text" name="email" required>
                <span>email</span>
                <br>
                <br>

                <input type="text" class="text" name="username" required>
                <span>username</span>

                <br>

                <br>

                <input type="password" class="text" name="password">
                <span>password</span>
                <br>

                <input type="checkbox" id="checkbox" class="checkboxx" name="remember_me">
                <label for="checkbox">Remember Me</label>

                <button class="signin">
                    Sign In
                </button>
                <br>
                <?php if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                <div class="error">
                    <?= $_SESSION['error'] ?>
                </div>
                <?php
                $_SESSION['error'] = null;
                endif; 
                ?>






            </div>

        </div>
    </form>
</body>

</html>