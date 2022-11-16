<?php
session_start();

include('../class/database.php');
class loginPage extends database
{

    protected $link;

    public function loginFunction()
    {
        if (isset($_POST['submit'])) {
            $hash = $_GET['recovery'];
            $code = trim($_POST['code']);
            $username = addslashes(trim($_POST['username']));

            $sqlP = "SELECT * from premium_user where username = '$username' ";
            $resP = mysqli_query($this->link, $sqlP);
            $sqlS = "SELECT * from standard_user where username = '$username' ";
            $resS = mysqli_query($this->link, $sqlS);
            $x = 0;
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                . '0123456789'); // and any other characters
            shuffle($seed); // probably optional since array_is randomized; this may be redundant
            $rand = '';
            foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];

            $codeUpdate = $rand;


            if (mysqli_num_rows($resP) > 0) {
                $row = mysqli_fetch_assoc($resP);
                $rowHash = $row['hash'];
                $rowCode = $row['code'];

                if (strcmp($rowHash, $hash) == 0 and strcmp($rowCode, $code) == 0) {
                    $x = 1;
                    $sql = "UPDATE `premium_user` SET `code`= '$codeUpdate' WHERE username = '$username'";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        $_SESSION['name'] = $username;
                        header('location:reset_password.php');
                    }
                } else {
                    return "Invalid Information";
                }
            }
            if (mysqli_num_rows($resS) > 0) {
                $row = mysqli_fetch_assoc($resS);
                $rowHash = $row['hash'];
                $rowCode = $row['code'];

                if (strcmp($rowHash, $hash) == 0 and strcmp($rowCode, $code) == 0) {
                    $x = 1;
                    $sql = "UPDATE `standard_user` SET `code`= '$codeUpdate' WHERE username = '$username'";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        $_SESSION['name'] = $username;
                        header('location:reset_password.php');
                    }
                } else {
                    return "Invalid Information";
                }
            }
            if ($x == 0) {
                return 'Sign Up first';
            }
        }
        # code...
    }
}
$obj = new loginPage;
$objLog = $obj->loginFunction();
// $seed = str_split('abcdefghijklmnopqrstuvwxyz'
//     . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
//     . '0123456789'); // and any other characters
// shuffle($seed); // probably optional since array_is randomized; this may be redundant
// $rand = '';
// foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];

// echo '<h1 class="text-white">' . $rand . '</h1>';


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Recovery Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/animate.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/parsley.css">

    <!-- Favicons -->



    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">

</head>

<body class="text-center" style="background-color: #1c1d26">
    <form method="post" class="form-signin">


        <img class="wow fadeIn" src="../images/senacoins3(1).png" alt="" width="100%">
        <h1 class="h3 mb-3 font-weight-bold text-light wow fadeInUp">Recovery Code</h1>
        <?php if ($objLog) { ?>
        <div class="alert alert-danger wow fadeIn"><?php echo $objLog; ?></div>
        <?php } ?>
        <label for="inputUsername" class="sr-only wow fadeInUp">Username</label>
        <input type="text" name="username" id="inputUsername" class="form-control wow fadeInUp"
            placeholder="Enter Username" data-wow-delay=".5s" required autofocus>
        <input type="hidden" name="hash" id="hash" class="form-control wow fadeInUp"
            value="<?php echo $_GET['recovery']; ?>" placeholder="Enter Username" data-wow-delay=".5s" required
            autofocus>
        <label for="code" class="sr-only wow fadeInUp mt-3">Code</label>
        <input type="text" name="code" id="code" class="form-control wow fadeInUp mt-3" placeholder="Enter Code"
            data-wow-delay=".5s" required autofocus>

        <!-- <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required> -->

        <button name="submit" class="btn btn-lg btn-danger btn-block wow fadeInUp mt-3" data-wow-delay=".9s"
            type="submit">Recovery</button>
    </form>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="../js/wow.js"></script>
    <script>
    new WOW().init();
    </script>
</body>

</html>