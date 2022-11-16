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
            $username = trim($_POST['username']);
            $email = $_POST['email'];
            // $address1 = $_POST['address1'];
            // $address2 = $_POST['address2'];
            $country = $_POST['country'];
            // $state = $_POST['state'];
            // $zip = $_POST['zip'];
            $password = trim($_POST['password']);
            $image = time() . '_' . $_FILES['image']['name'];
            $target = '../user_img/' . $image;
            $pass = password_hash("$password", PASSWORD_DEFAULT);

            $sqlF = "Select * from standard_user where username = '$username' OR email = '$email' ";
            $resf = mysqli_query($this->link, $sqlF);
            $sqlG = "SELECT * from premium_user where username = '$username' OR email = '$email' ";
            $resG = mysqli_query($this->link, $sqlG);
            if (mysqli_num_rows($resf) > 0 || mysqli_num_rows($resG) > 0) {
                $msg = "Username OR Email is Already Taken";
                return $msg;

                header('location:standardSignUp.php');
            } else {
                $sql = "INSERT INTO `standard_user` (`id`, `fname`, `lname`, `username`, `email`,`password`, `address1`, `address2`, `country`, `state`, `zip`,`image`) VALUES (NULL, '$fname', '$lname', '$username', '$email','$pass', '', '', '$country', '', '','$image')";

                move_uploaded_file($_FILES['image']['tmp_name'], $target);

                $res = mysqli_query($this->link, $sql);
                if ($res) {
                    $_SESSION['name'] = $username;
                    header('location:standard_page.php');
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
    <title>Modulo standard</title>

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
    <link rel="stylesheet" href="../css/fontawesme.min.css">


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
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body class="text-light">
    <div class="container">
        <div class="py-5 text-center">
            <a href="http://www.minterrordatabase.com/">
                <img class="mb-4 wow fadeIn" src="../images/source file1.png" alt="" width="30%">
            </a>

            <h2 class="wow fadeIn">Iscrizione standard - standard subscription</h2>
            <p class="lead wow fadeIn">Il modulo deve essere compilato con le seguenti informazioni personali:</p>
            <br> The form must be completed with the following personal information: <br />
        </div>

        <?php if ($objStand) { ?>

        <div class="alert alert-danger text-center">
            <span class="text-center">Nome utente in uso. Scegli un altro nome utente.</span>
        </div>

        <?php } ?>

        <div class="row">

            <div class="col-md-12 order-md-1 wow fadeInUp">
                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nome - Name</label>
                            <input type="text" name="fname" class="form-control" id="firstName" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                E' richiesto un nome valido. A valid name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Cognome - Last name</label>
                            <input type="text" name="lname" class="form-control" id="lastName" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                E' richiesto un cognome valido. A valid surname is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Nome utente - Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username"
                                required>
                            <div class="invalid-feedback" style="width: 100%;">
                                E' richiesto un nome utente. A username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="you@example.com" required>
                            <div class="invalid-feedback">
                                E' richiesta una email valida per confermare l'iscrizione. A valid email is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Password</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" id="email" placeholder="*******"
                                required>
                            <div class="invalid-feedback">
                                E' richiesta una password valida. A valid password is required.
                            </div>
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
                        <div class="col-md-12 mb-3">
                            <label for="country">Nazione - Country</label>
                            <input type="text" class="form-control" id="country" placeholder="Country" name="country"
                                required>

                            <div class="invalid-feedback">
                                E' richiesta una nazione valida. A valid country is required.
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

                    </div>
                    <div class="row mb-4 mt-2">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input accept="image/*" type="file" name="image" class="custom-file-input"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Upload profile picture</label>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                <label class="form-check-label" for="invalidCheck2">
                                    <p>I accept the <a
                                            href="../files/minterrordatabase.com - Termini e condizioni del servizio.pdf"
                                            target="__blank" class="text-danger font-weight-bold">terms and
                                            condition</a>
                                        and <a href="../files//Website_Privacy_Policy_Final.pdf" target="__blank"
                                            class="text-danger font-weight-bold">privacy
                                            policy</a>
                                    </p>

                                </label>
                            </div>
                        </div>
                    </div>





                    <button name="submit" class="btn btn-danger btn-lg btn-block" type="submit">Conferma -
                        Confirm</button>
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
    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

</body>




</html>