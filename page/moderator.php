<?php
session_start();
include '../class/database.php';
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}

?>
<?php
class continents extends database
{
    protected $link;
    public function continentsFunction()
    {

        $sqlCon = "Select * from continents";
        $resCon = mysqli_query($this->link, $sqlCon);
        if (mysqli_num_rows($resCon) > 0) {
            return $resCon;
        } else {
            return false;
        }
        # code...
    }
}
$objCo = new continents;
$objCon = $objCo->continentsFunction();


?>
<?php


class message extends database
{
    protected $link;
    public function msgFunction()
    {
        $name = $_SESSION['name'];
        $sql2 = "Select * from message where user = '$name' ";
        $res2 = mysqli_query($this->link, $sql2);
        if (mysqli_num_rows($res2) > 0) {
            return $res2;
        } else {
            return false;
        }
        # code...
    }
}
$objM = new message;
$ObjMsg = $objM->msgFunction();
// $row2 = mysqli_fetch_assoc($ObjMsg);

?>
<?php


class findUser extends database
{
    protected $link;
    public function userFunction()
    {
        $name = $_SESSION['name'];
        $sql = "select * from data_tbl where user = '$name' ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$objFind = new findUser;
$ObjFindUser = $objFind->userFunction();


?>

<?php


class messageR extends database
{
    protected $link;
    public function msgFunction()
    {
        $name = $_SESSION['name'];
        $sql2 = "Select * from return_msg where user = '$name' ";
        $res2 = mysqli_query($this->link, $sql2);
        if (mysqli_num_rows($res2) > 0) {
            return $res2;
        } else {
            return false;
        }
        # code...
    }
}
$objR = new messageR;
$ObjRMsg = $objR->msgFunction();
// $row2 = mysqli_fetch_assoc($ObjMsg);

?>
<?php

class Profile extends database
{
    protected $link;

    public function profileFunction()
    {
        $name = $_SESSION['name'];
        $sqlPro = "select * from premium_user where username = '$name' ";
        $resPro = mysqli_query($this->link, $sqlPro);
        if ($resPro) {
            return $resPro;
        } else {
            return false;
        }
        # code...
    }
}
$objPro = new Profile;
$objProfile = $objPro->profileFunction();
$rowProfile = mysqli_fetch_assoc($objProfile);

?>
<?php

class countClass extends database
{
    protected $link;
    public function countFunction()
    {

        $sqlC = "Select count(id) as total from request";
        $resC = mysqli_query($this->link, $sqlC);
        if ($resC) {
            return $resC;
        } else {
            return false;
        }
        # code...
    }
}
$objCount = new countClass;
$objC = $objCount->countFunction();
$rowC = mysqli_fetch_assoc($objC);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Document</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css ">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
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
</head>

<body style="background-color: #1c1d26">
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-light display-4" href="#"><?php echo $_SESSION['name']; ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="request.php">Request
                            <sup><b><?php echo $rowC['total']; ?></b></sup>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="update_moderator_user.php?name=<?php echo $_SESSION['name']; ?>">Update</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Continents
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">

                            <?php if ($objCon) { ?>
                            <?php while ($rowCon = mysqli_fetch_assoc($objCon)) { ?>
                            <a class="dropdown-item text-dark bg-dark"
                                href="countries_premium.php?code=<?php echo $rowCon['code']; ?>"><?php echo $rowCon['name']; ?></a>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <div class="text-center p-3">
        <p class="lead pt-3 text-light">Check out all the data!</p>
    </div>

    <?php if ($ObjRMsg) { ?>
    <div class="alert alert-success w-25 mx-auto text-center">
        <span>Good News! Your coin has been approved!</span>
        <?php $rowR = mysqli_fetch_assoc($ObjRMsg) ?>
        <p><a href="deleteReplyMsg.php?id= <?php echo $rowR['id']; ?> " class="btn btn-danger">Cancel</a></p>

    </div>
    <?php }  ?>





    <div class="container">

        <!-- <table class="table table-responsive table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Type Of Coin</th>
                    <th scope="col">Year</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub-Category</th>
                    <th scope="col">Rarity</th>
                    <th scope="col">Reference</th>
                    <th scope="col">BB</th>
                    <th scope="col">SPL</th>
                    <th scope="col">FDC</th>
                    <th scope="col">ECZ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($objpUser) { ?>
                <?php while ($row = mysqli_fetch_assoc($objpUser)) { ?>
                <tr>
                    <th scope="row"><?php echo $row['type_of_coin']; ?></th>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['sub_category']; ?></td>
                    <td><?php echo $row['rarity']; ?></td>
                    <td><?php echo $row['reference']; ?></td>
                    <td><?php echo $row['bb']; ?></td>
                    <td><?php echo $row['spl']; ?></td>
                    <td><?php echo $row['fdc']; ?></td>
                    <td><?php echo $row['ecz']; ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <p>No Data</p>
                <?php } ?>
            </tbody>
        </table> -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if ($ObjMsg) { ?>
                    <?php while ($row2 = mysqli_fetch_assoc($ObjMsg)) { ?>

                    <div class="card card-body mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <span>Type Of Coin: </span>
                                <span class="text-muted"><?php echo $row2['type_of_coin']; ?></span><br><br>
                                <span>Submitted Date: </span>

                                <span class="text-muted"><?php echo $row2['date']; ?></span><br><br>
                                <?php echo $row2['message']; ?>
                            </div>
                            <div class="col-md-6" style="justify-content: center;align-items: center; display:flex">
                                <div class="d-flex" style="justify-content: center;align-items: center; display:flex">
                                    <img style="width: 40%;" src="../coin_img/<?php echo $row2['image']; ?>" alt="">
                                    <img style="width: 40%;" src="../coin_img/<?php echo $row2['image2']; ?>" alt="">
                                    <img style="width: 40%;" src="../coin_img/<?php echo $row2['image3']; ?>" alt="">
                                    <img style="width: 40%;" src="../coin_img/<?php echo $row2['image4']; ?>" alt="">
                                    <img style="width: 40%;" src="../coin_img/<?php echo $row2['image5']; ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php } ?>
                    <?php } else { ?>
                    <p>No Message</p>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" href="deleteMessage.php?name=<?php echo $_SESSION['name']; ?>"
                        class="btn btn-primary">Ok</a>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/jquery-3.3.1.min.js">
    </script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src=" //cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js "></script>
    <script src="../js/wow.js"></script>
    <script>
    new WOW().init();
    </script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'pdf', 'csv'
            ]
        });
    });
    </script>
</body>

</html>