<?php
session_start();
include '../class/database.php';
class standardSignUp extends database
{
    protected $link;
    public function standFunction()
    {


        if (isset($_POST['submit'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            // $address1 = $_POST['address1'];
            // $address2 = $_POST['address2'];
            $country = $_POST['country'];
            // $state = $_POST['state'];
            // $zip = $_POST['zip'];
            $password = $_POST['password'];
            $image = time() . '_' . $_FILES['image']['name'];
            $target = '../user_img/' . $image;
            $pass = password_hash("$password", PASSWORD_DEFAULT);

            $find = "SELECT * FROM premium_user where username = '$username'";
            $findRes = mysqli_query($this->link, $find);
            if (mysqli_num_rows($findRes) > 0) {
                $msg = "Username Taken";
                return $msg;
                header('location:premiumSignUp.php');
            } else {
                $sql = "INSERT INTO `premium_user` (`id`, `fname`, `lname`, `username`, `email`,`password`, `address1`, `address2`, `country`, `state`, `zip`,`image`) VALUES (NULL, '$fname', '$lname', '$username', '$email','$pass', '', '', '$country', '', '','$image')";

                move_uploaded_file($_FILES['image']['tmp_name'], $target);

                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    $_SESSION['name'] = $username;

                    header('location:premium_page.php');
                    echo "Data Added";
                } else {
                    echo "Not Added";
                }
            }
        }
        # code...
    }
}
$obj = new standardSignUp;
$objStand = $obj->standFunction();

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Checkout example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <link rel="stylesheet" href="../css/animate.css">


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
    <link href="../css/form-validation.css" rel="stylesheet">
</head>

<body class="text-light">
    <div class="container">
        <div class="py-5 text-center">
            <img class="mb-4 wow fadeIn" src="../images/senacoins3(1).png" alt="" width="30%">

            <h2 class="wow fadeIn">Premium form</h2>
            <p class="lead wow fadeIn">Premium form to be filled in with the following personal data</p>
        </div>

        <?php if ($objStand) { ?>

        <div class="alert alert-danger text-center">
            <span class="text-center">Username Taken. Please Enter New Username.</span>
        </div>

        <?php } ?>

        <div class="row">

            <div class="col-md-12 order-md-1 wow fadeInUp">
                <h4 class="mb-3">Personal Information</h4>
                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="fname" class="form-control" id="firstName" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="lname" class="form-control" id="lastName" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                                required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com"
                            required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="******"
                            required>
                        <div class="invalid-feedback">
                            Please enter a valid password address for shipping updates.
                        </div>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address1" id="address" placeholder="1234 Main St"
                            required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div> -->

                    <!-- <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" name="address2" class="form-control" id="address2"
                            placeholder="Apartment or suite">
                    </div> -->

                    <div class="row">
                        <div class="col-md-10 mb-3">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" placeholder="Country" name="country"
                                required>

                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <!-- <div class="col-md-3 mb-3">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" placeholder="State" name="state"
                                required>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div> -->
                        <!-- <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="Zip" name="zip" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div> -->
                        <div class="col-md-2 mb-3">
                            <label for="Image">Profile</label>
                            <input type="file" class="form-control" id="Image" name="image" required>
                            <div class="invalid-feedback">
                                Image required.
                            </div>
                        </div>
                    </div>





                    <button name="submit" class="btn btn-danger btn-lg btn-block" type="submit">Confirm</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <!-- <p class="mb-1">&copy; 2017-2019 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul> -->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script>
    window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.4/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous">
    </script>
    <script src="../js/form-validation.js"></script>
    <script src="../js/wow.js"></script>
    <script>
    new WOW().init();
    </script>
</body>




</html>