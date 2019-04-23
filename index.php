<?php
require 'assets/php/phplogin.php'
?>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/login.css" />
    <link rel="shortcut icon" href="sicklogo.ico">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <h2 style="text-align:center">SICK Login</h2>
                <div class="col">
                    <div class="hide-md-lg">
                        <p>Or sign in manually:</p>
                    </div>

                    <input type="text" name="nomoridentitas" id="nomoridetitas1" placeholder="Username" required>
                    <input type="password" name="password" id="nomoridentitas1" placeholder="Password" required>
                    <input type="submit" name="submit" value="Login">
                </div>

            </div>
        </form>
    </div>

</body>