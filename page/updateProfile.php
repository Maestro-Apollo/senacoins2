<?php
session_start();
include('../class/database.php');
class updateProfile extends database
{
    protected $link;
    public function adminFunction()
    {
        $sql = "select * from admin";
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
$_SESSION['admin_id'] = $row['id'];

?>
<?php

class updatedProfile extends database
{
    protected $link;
    public function updateFunction()
    {

        if (isset($_POST['update'])) {
            $id = $_SESSION['admin_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $pass = password_hash("$password", PASSWORD_DEFAULT);
            // $email = $_POST['email'];

            $sql2 = "Update admin set username = '$username' , password = '$pass'  where id = $id";
            $res2 = mysqli_query($this->link, $sql2);
            if ($res2) {
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
    <title>Signin Template · Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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
    <style>
    h1,
    h3,
    p,
    a,
    span,
    button {
        font-family: 'Roboto', sans-serif;
    }
    </style>
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
</head>

<body class="text-center" style="background-color: #1c1d26">
    <form method="post" class="form-signin">

        <img class="mb-4" src="../images/senacoins3(1).png" alt="" width="100%">
        <h1 class="h3 mb-3 font-weight-normal text-light">Update Profile</h1>
        <?php if ($objUpDated) { ?>
        <div class="alert alert-success text-center">
            <h5>Updated</h5>
        </div>
        <?php } ?>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" name="username" id="inputUsername" class="form-control mb-2"
            value="<?php echo $row['username']; ?>" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password"" name=" password" id="password" class="form-control" placeholder="Password" required
            autofocus>


        <button name="update" class="btn btn-lg btn-success btn-block" type="submit">Update</button>
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
</body>

</html>