<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../class/database.php');
class loginPage extends database
{

    protected $link;

    public function loginFunction()
    {
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            // $email = $_POST['email'];
            $password = $_POST['password'];
            $msg = "Wrong Username - Nome utente errato";
            $msg_style = "alert-danger";

            $sql = "Select * from premium_user where username = '$username'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $passValid = password_verify($password, $row['password']);
                if ($passValid == true) {
                    if (isset($_GET['location'])) {
                        $location = $_GET['location'];
                        $_SESSION['name'] = $username;
                        $_SESSION['p_user'] = $username;
                        header("location:" . $location);
                        return $res;
                    } else {
                        $_SESSION['name'] = $username;
                        $_SESSION['p_user'] = $username;
                        header('location:premium_page.php?username=' . $username);
                        return $res;
                    }
                } else {
                    $msgPass = "Wrong Password - Password errata";
                    return $msgPass;
                }
            } else {
                $sql2 = "Select * from standard_user where username = '$username'";
                $res2 = mysqli_query($this->link, $sql2);
                if (mysqli_num_rows($res2) > 0) {

                    $row = mysqli_fetch_assoc($res2);
                    $passValid = password_verify($password, $row['password']);
                    if ($passValid == true) {

                        if (isset($_GET['location'])) {
                            $location = $_GET['location'];
                            $_SESSION['name'] = $username;
                            $_SESSION['s_user'] = $username;
                            header("location:" . $location);
                            return $res2;
                        } else {
                            $_SESSION['name'] = $username;
                            $_SESSION['s_user'] = $username;
                            header('location:standard_page.php?username=' . $username);
                            return $res2;
                        }
                    } else {
                        $msgPass = "Wrong Password - Password errata";
                        return $msgPass;
                    }
                } else {
                    $sql3 = "Select * from admin where username = '$username' ";
                    $res3 = mysqli_query($this->link, $sql3);
                    if (mysqli_num_rows($res3) > 0) {
                        $row = mysqli_fetch_assoc($res3);
                        $passValid = password_verify($password, $row['password']);
                        if ($passValid == true) {


                            if (isset($_GET['location'])) {
                                $location = $_GET['location'];
                                $_SESSION['name'] = $username;
                                $_SESSION['admin_user'] = $username;
                                header("location:" . $location);
                                return $res3;
                            } else {
                                $_SESSION['name'] = $username;
                                $_SESSION['admin_user'] = $username;
                                header('location:admin.php');
                                return $res3;
                            }
                        } else {
                            $msgPass = "Wrong Password";
                            return $msgPass;
                        }
                    } else if (mysqli_num_rows($res3) == 0) {
                        $sql3 = "Select * from moderator where username = '$username' ";
                        $res3 = mysqli_query($this->link, $sql3);
                        if (mysqli_num_rows($res3) > 0) {
                            $row = mysqli_fetch_assoc($res3);
                            $passValid = password_verify($password, $row['password']);
                            if ($passValid == true) {


                                if (isset($_GET['location'])) {
                                    $location = $_GET['location'];
                                    $_SESSION['name'] = $username;
                                    header("location:" . $location);
                                    return $res3;
                                } else {
                                    $_SESSION['name'] = $username;
                                    header('location:moderator.php');
                                    return $res3;
                                }
                            } else {
                                $msgPass = "Wrong Password";
                                return $msgPass;
                            }
                        }
                    } else {
                        return $msg;
                    }
                }
            }
        }
        # code...
    }
}
$obj = new loginPage;
$objLog = $obj->loginFunction();

// echo $_GET['location'];
// echo '<br>';
// echo htmlspecialchars($_GET['location']);

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Accesso - Login - Minterror DB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/animate.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

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

<body class="text-center" style="background-color: #1c1d26;">
    <form method="post" class="form-signin">

        <img class="mb-4 wow fadeIn" src="../images/source file1.png" alt="" width="90%">
        <!-- <h1 class="h3 mb-3 font-weight-normal text-light wow fadeInUp">LOG IN</h1> -->
        <?php if ($objLog) { ?>
        <div class="alert alert-danger wow fadeIn"><?php echo $objLog; ?></div>

        <?php } ?>
        <label for="inputUsername" class="sr-only wow fadeInUp">Username|Nome Utente</label>
        <input type="text" name="username" id="inputUsername" class="form-control wow fadeInUp" placeholder="Username"
            data-wow-delay=".5s" required autofocus>
        <label for="inputPassword" class="sr-only wow fadeInUp">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control mt-2 wow fadeInUp"
            placeholder="Password" data-wow-delay=".7s" required autofocus>
        <!-- <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required> -->

        <button name="submit" class="btn btn-lg btn-danger btn-block wow fadeInUp" data-wow-delay=".9s"
            type="submit">LOGIN | ACCEDI</button>
        <a class="text-danger wow fadeInUp" data-wow-delay="1s" href="./forget_password.php">Forgot Password | Password
            dimenticata</a>

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