<?php
include '../class/prem_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <div class="form_section">
        <div class="container">
            <h2 class="text-center">Our Premium User</h2>
            <form action="" method="post" enctype="multipart/form-data" class="form-group">

                <input type="text" name="username" placeholder="Enter username" class="form-control  mb-4">
                <input type="email" name="email" placeholder="Enter email" class="form-control  mb-4">
                <input type="password" name="password" placeholder="Enter password" class="form-control  mb-4">
                <!-- <label for="">Enter your Image</label>
                <input type="file" name="image" value="upload your photo" class="form-control  mb-4"> -->
                <input type="submit" name="submit" value="Confirm" class="btn btn-success">


            </form>
        </div>
    </div>

</body>

<script src="../js/jquery-3.3.1.min.js">
</script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>