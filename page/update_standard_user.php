<?php
include('../class/database.php');
class updateProfile extends database
{
    protected $link;
    public function adminFunction()
    {
        $name = $_GET['name'];
        $sql = "select * from standard_user where username = '$name' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new updateProfile;
$objAd = $obj->adminFunction();
$row = mysqli_fetch_assoc($objAd);

?>
<?php

class updatedProfile extends database
{
    protected $link;
    public function updateFunction()
    {

        if (isset($_POST['update'])) {
            $name = $_GET['name'];

            $password = $_POST['password'];
            $country = $_POST['country'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $img = time() . '_' . $_FILES['image']['name'];
            $target = '../user_img/' . $img;
            $pass = password_hash("$password", PASSWORD_DEFAULT);

            if ($_FILES['image']['name'] == '') {
                $sql2 = "Update standard_user set password = '$pass', country = '$country', fname = '$fname', lname = '$lname'  where username = '$name'";
            } else {
                $sql2 = "Update standard_user set password = '$pass', country = '$country', fname = '$fname', image = '$img', lname = '$lname'  where username = '$name'";
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }
            $res2 = mysqli_query($this->link, $sql2);
            if ($res2) {
                header('location:standard_page.php');
                return $res2;
            } else {
                return false;
            }
        }
    }
}
$ObjUpDate = new updatedProfile;
$objUpDated = $ObjUpDate->updateFunction();

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
        <div class="text-center">
            <a href="http://www.senacoins.com/">
                <img class="mb-4 wow fadeIn" src="../images/senacoins3(1).png" alt="" width="30%">
            </a>


        </div>



        <div class="row">

            <div class="col-md-12 order-md-1 wow fadeInUp">
                <?php if ($objUpDated) { ?>
                <div class="alert alert-success text-center">
                    <h5>Updated</h5>
                </div>
                <?php } ?>
                <h4 class="mb-3">Update Information</h4>
                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="fname" class="form-control" id="firstName" placeholder=""
                                value="<?php echo $row['fname']; ?>" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="lname" class="form-control" id="lastName" placeholder=""
                                value="<?php echo $row['lname']; ?>" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
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
                                Please enter a valid password.
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
                        <div class="col-md-10 mb-3">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" placeholder="Country"
                                value="<?php echo $row['country']; ?>" name="country" required>

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
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <div class="invalid-feedback">
                                Image required.
                            </div>
                        </div>
                    </div>





                    <button name="update" class="btn btn-success btn-lg btn-block" type="submit">Update</button>
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