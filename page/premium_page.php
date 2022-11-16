<?php
session_start();
include '../class/database.php';
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}
$name = $_SESSION['name'];
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

class countClass extends database
{
    protected $link;
    public function countFunction()
    {

        $name = $_SESSION['name'];

        $sqlC = "Select count(id) as total from message where user = '$name' ";
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

class standNumber extends database
{
    protected $link;
    public function standNumberFunction()
    {
        $name = $_SESSION['name'];
        $sqlNum = "select count(id) as totalNum from data_tbl where user = '$name' ";
        $resNum = mysqli_query($this->link, $sqlNum);
        if ($resNum) {
            return $resNum;
        } else {
            return false;
        }
        # code...
    }
}
$objNum = new standNumber;
$objNumber = $objNum->standNumberFunction();
$rowNum = mysqli_fetch_assoc($objNumber);

?>
<?php

class totalNumberCoin extends database
{
    protected $link;
    public function totalNumberCoinFunction()
    {
        $sqlNum = "select * from data_tbl";
        $resNum = mysqli_query($this->link, $sqlNum);
        if ($resNum) {
            $countCoin = mysqli_num_rows($resNum);
            return $countCoin;
        } else {
            return false;
        }
        # code...
    }
}
$objNumCoin = new totalNumberCoin;
$objNumberCoin = $objNumCoin->totalNumberCoinFunction();
// $rowCoins = mysqli_fetch_assoc($objNumber);

?>



<?php
header('Content-Type: text/html; charset=utf-8');
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium page - Minterrordatabase.com</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css ">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="icon" href="../images/source file1.png" type="image/gif" sizes="100x100">
    <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <style>
    body,
    h1,
    h3,
    p,
    a,
    span,
    button {
        font-family: 'Roboto', sans-serif;
    }

    button.navbar-toggler.d-lg-none {
        position: absolute;
        right: 5%;
    }

    a.dropdown-item.text-dark.bg-dark {
        display: block !important;
    }

    div#exampleModal {
        opacity: 1 !important;
    }

    img.col-md-6.img-fluid {
        margin: 15px 0px 20px 0px;
        max-width: 33% !important;
        display: block;
        float: left;
        padding: 5px;
        max-height: 170px;
    }

    .navbar-collapse {
        -ms-flex-preferred-size: 100%;
        flex-basis: 0%;
        -ms-flex-positive: 1;
        flex-grow: 1;
        -ms-flex-align: center;
        align-items: center;
    }

    @media only screen and (max-width: 600px) {
        .p-5 {
            padding: 0rem !important;
        }

        .col-md-12.kami {
            margin: 0px auto !important;
            padding: 0 !important;
        }

        .container-fluid {
            padding: 0px !important;
        }

        .navbar .navbar-brand {
            width: 0px !important;
        }

    }

    @media only screen and (min-width: 1201px) {
        .nav.navbar.navbar-expand-sm.navbar-dark.bg-light .container {
            display: contents !important;
        }

        .text-center {

            max-width: initial !important;
            padding: 0;
        }

        table#empTable {
            width: -webkit-fill-available !important;
        }

        .col-md-12.kami {
            padding: 0px;
            margin: 0px auto;
        }

        .wow .row {
            margin: 0px auto;
            padding: 0;
        }

        .row.kami {
            width: -webkit-fill-available;
            padding: 0 50px 0 50px;
        }
    }
    </style>

</head>

<body style="background: radial-gradient(silver,#fff)">
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: darkgoldenrod !important">
        <div class="row kami">
            <a class="navbar-brand text-light display-4" href="#"><?php echo $_SESSION['name']; ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Banca dati - Database
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
                        <a class="nav-link" href="./pending.php">Trasferimenti in sospeso - Pending transfer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pending_coins.php">Richieste in sospeso - Pending requests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#">Messaggi - Inbox
                            <sup><b><?php echo $rowC['total']; ?></b></sup> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="today.php">Oggi - Today</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="submission.php?name=<?php echo $_SESSION['name']; ?>">Nuova moneta -
                            Insert coins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="update_premium_user.php?name=<?php echo $_SESSION['name']; ?>">Aggiorna profilo -
                            Update profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Esci - Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <script>
    $crisp.push(["safe", true]);
    $(".dropdown-toggle").click(function() {
        //alert('working');
        $(".bg-dark").toggle();
    });

    $(".navbar-toggler").click(function() {
        //alert('working');
        $(".navbar-collapse").toggle();
    });
    </script>
    <div class="p-3"></div>

    <?php if ($ObjRMsg) { ?>
    <div class="alert alert-success w-25 mx-auto text-center">
        <span>Buone notizie! La tua moneta è stata approvata! Good News! Your coin has been approved!</span>
        <?php $rowR = mysqli_fetch_assoc($ObjRMsg) ?>
        <p class="mt-2"><a href="deleteReplyMsg.php?id= <?php echo $rowR['id']; ?> " class="btn btn-danger ">OK</a>
        </p>

    </div>
    <?php }  ?>


    <div class="p-3">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class=" text-center"
                        style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="../user_img/<?php echo $rowProfile['image']; ?>" class="card-img-top"
                                    alt="...">
                            </div>
                            <div class="col-md-6 offset-lg-1">
                                <div class="row">
                                    <div class="col-md-6 pt-4 text-lg-left">
                                        <h2 class="mt-4 text-light"><?php echo $rowProfile['fname']; ?>
                                            <?php echo $rowProfile['lname']; ?>
                                        </h2>
                                        <p class="lead mt-4 text-light"><?php echo $rowProfile['country']; ?></p>
                                        <p class="lead mt-4 text-light"><?php echo $rowProfile['email']; ?></p>
                                        <a href="./premium_users_coins_list.php" class="btn btn-block text-white"
                                            style="background-color: darkgoldenrod">Ricerca globale |
                                            Global
                                            search</a>
                                        <a href="./market-place.php" class="btn btn-block text-white mt-3"
                                            style="background-color: darkgoldenrod">Negozio | Marketplace</a>
                                        <a href="./sells-list.php" class="btn btn-block text-white mt-3"
                                            style="background-color: darkgoldenrod">Monete in vendita | Coins for
                                            sale</a>
                                        <!-- <a href="./pending.php" class="btn btn-primary mt-3">Pending Certificate</a> -->
                                    </div>
                                    <div class="col-md-6 pt-1 text-lg-right">
                                        <div class="text-light mt-5" style="font-size: 25px;">
                                            <span>Total Coins: </span>
                                            <span style="font-weight: 500" class="num">
                                                <?php echo $objNumberCoin; ?></span>
                                        </div>
                                        <div class="text-light mt-4 mb-3" style="font-size: 25px;">
                                            <span>My collection: </span>
                                            <span style="font-weight: 500" class="num">
                                                <?php echo $rowNum['totalNum']; ?></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 kami">
                    <div class="">
                        <h4 class="text-center pb-4 wow slideInLeft mt-4" style="color:darkgoldenrod">↓ MY COLLECTION↓
                        </h4>
                        <div class="container-fluid" style="background: radial-gradient(silver,#fff);padding: 20px;">
                            <div class="table-responsive table-striped table-hover table-condensed container-fluid"
                                style="background: radial-gradient(silver,#fff)">
                                <table class="display dataTable container-fluid" id="empTable">
                                    <thead>
                                        <tr>
                                            <div class="text-light">
                                                <th scope="col"></th>

                                            </div>
                                        </tr>
                                    </thead>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    <h5 class="modal-title" id="exampleModalLabel">Message</h5>
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
                            <div class="col-md-5">
                                <div>
                                    <div class="row">

                                        <div class="col-md-4 col-4">
                                            <img src="../coin_img/<?php echo $row2['image']; ?>" alt="">
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <img src="../coin_img/<?php echo $row2['image2']; ?>" alt="">
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <img src="../coin_img/<?php echo $row2['image3']; ?>" alt="">
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <img src="../coin_img/<?php echo $row2['image4']; ?>" alt="">
                                        </div>
                                        <div class="col-md-4 col-4">
                                            <img src="../coin_img/<?php echo $row2['image5']; ?>" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <a type="button" href="deleteMessage.php?id=<?php echo $row2['id']; ?>"
                            class="btn btn-danger">Delete</a>
                    </div>

                    <?php } ?>
                    <?php } else { ?>
                    <p>No Message . Nessun messaggio.</p>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>

    <script src="../js/popper.min.js"></script>




    <script src="../js/wow.js"></script>
    <script>
    new WOW().init();
    </script>
    <script>
    $(document).ready(function() {
        $('#empTable').DataTable({
            'processing': true,
            'serverSide': true,
            // 'info':false,
            'serverMethod': 'post',


            'ajax': {
                'url': 'ajaxfile3.php',
                "data": {
                    "user": '<?php echo $name; ?>'
                }

            },
            'columns': [{
                    data: 'content'
                },



            ]
        });
    });
    </script>

    <script>
    const images = document.querySelectorAll("[data-src]");

    function preloadImage(img) {

        const src = img.getAttribute("data-src");
        if (!src) {
            return;
        }
        img.src = src;

    }

    const imgOptions = {
        threshold: 0,
        rootMargin: "0px 0px 200px 0px"
    };

    const imgObserver = new IntersectionObserver((entries, imgObserver) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                preloadImage(entry.target);
                imgObserver.unobserve(entry.target);
            }
        })
    }, imgOptions);

    images.forEach(image => {
        imgObserver.observe(image);
    })
    </script>

</html>