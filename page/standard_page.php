<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}
$name = $_SESSION['name'];
?>
<?php
include '../class/database.php';
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

?>

<?php

class Profile extends database
{
    protected $link;

    public function profileFunction()
    {
        $name = $_SESSION['name'];
        $sqlPro = "select * from standard_user where username = '$name' ";
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

class upgrade extends database
{
    protected $link;
    public function upgradeFunction()
    {
        if (isset($_POST['submitCode'])) {
            $code = $_POST['code'];
            // $sql = "select * from code where code = $code AND taken = 0 ";
            // $res = mysqli_query($this->link, $sql);


            $name = $_SESSION['name'];
            $sql2 = "select * from standard_user where username = '$name'";
            $res2 = mysqli_query($this->link, $sql2);
            if (mysqli_num_rows($res2) > 0) {
                $rowName = mysqli_fetch_assoc($res2);
                $fname = $rowName['fname'];
                $lname = $rowName['lname'];
                $username = $rowName['username'];
                $email = $rowName['email'];
                $password = $rowName['password'];
                $address1 = $rowName['address1'];
                $country = $rowName['country'];
                $image = $rowName['image'];
                $update_value = 1;

                $sqlName = "select * from premium_user where username = '$username' ";
                $resName = mysqli_query($this->link, $sqlName);
                if (mysqli_num_rows($resName) > 0) {
                    echo "Username Taken";
                } else {

                    $sqlCode = "select * from code where taken = 0 ";
                    $resCode = mysqli_query($this->link, $sqlCode);

                    if ($resCode) {
                        while ($rowCode = mysqli_fetch_assoc($resCode)) {
                            $key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
                            $encryption_key = base64_decode($key);
                            list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($rowCode['code']), 2), 2, null);

                            $reveal = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);





                            if (strcmp($reveal, $code) == 0) {



                                $enpyCode = $rowCode['code'];



                                $sql3 = "INSERT INTO `premium_user` (`id`, `fname`, `lname`, `username`, `email`, `password`, `address1`, `address2`, `country`, `state`, `zip`, `image`) VALUES (NULL, '$fname', '$lname', '$username', '$email', '$password', '$address1', NULL, '$country', '', '', '$image')";
                                mysqli_query($this->link, $sql3);
                                $time = gmdate('M-j-Y, H:i', strtotime('+ 1 hours'));
                                // $time = gmdate("l jS \of F Y h:i:s A");
                                $sql4 = "Delete from standard_user where username = '$name' ";
                                mysqli_query($this->link, $sql4);
                                $sql5 = "UPDATE `code` SET `taken`= 1, `updated` = '$time', `account` = 1 , `user` = '$username' WHERE code = '$enpyCode' ";
                                mysqli_query($this->link, $sql5);


                                $msg = "upgrade";

                                return $msg;
                            }
                        }
                    }
                    $sqlCode2 = "select * from code where taken = 1 ";
                    $resCode2 = mysqli_query($this->link, $sqlCode2);
                    if ($resCode2) {
                        $msg = "used";
                        return $msg;
                    }
                }
            }
        }
        if (isset($_POST['buy'])) {
            $msg = "buy";
            return $msg;
        }
        if (isset($_POST['code'])) {
            $msg = "code";
            return $msg;
        }
        # code...
    }
}
$objCode = new upgrade;
$objUpgrade = $objCode->upgradeFunction();

?>

<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minterrordatabase.com - Standard Page</title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css ">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
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

    a.dropdown-item.text-dark.bg-dark {
        display: block !important;
    }

    div#exampleModal {
        opacity: 1 !important;
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
    }
    </style>

</head>

<body style="background-color: #1c1d26">
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#"><?php echo $_SESSION['name']; ?></a>
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
                    <li class="nav-item">
                        <a class="nav-link" href="./pending.php">Pending Certificate
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pending_coins.php">Pending Coins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#">MESSAGGI - INBOX
                            <sup><b><?php echo $rowC['total']; ?></b></sup> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="today.php">OGGI - TODAY</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            BANCA DATI - DATABASE
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">

                            <?php if ($objCon) { ?>
                            <?php while ($rowCon = mysqli_fetch_assoc($objCon)) { ?>
                            <a class="dropdown-item text-dark bg-dark"
                                href="countries_standard.php?code=<?php echo $rowCon['code']; ?>"><?php echo $rowCon['name']; ?></a>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="submission.php?name=<?php echo $_SESSION['name']; ?>">INSERISCI MONETE
                            - INSERT COINS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="update_standard_user.php?name=<?php echo $_SESSION['name']; ?>">AGGIORNA PROFILO -
                            UPDATE PROFILE</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">ESCI - LOGOUT</a>
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
        <p class="mt-2"><a href="deleteReplyMsg.php?id= <?php echo $rowR['id']; ?> " class="btn btn-danger">OK</a>
        </p>

    </div>
    <?php }  ?>
    <div class="container">

        <?php if (strcmp($objUpgrade, 'buy') == 0) { ?>
        <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong class="text-center text-capitalize">Prenota il "Manuale del collezionista di errori di coniazione"
                di Alessio Sena tramite la chat servizio clienti presente nella nostra piattaforma. Il prezzo è di 49,90
                Euro e include il codice segreto per effettuare l'upgrade a profilo premium. Si spedisce verso tutto il
                mondo. The book costs 49,90 euros and includes the
                unique
                code switch account to premium. Contact Alessio Sena via the customer service chat to book your
                copy.</strong>
        </div>

        <?php } ?>
        <?php if (strcmp($objUpgrade, 'code') == 0) { ?>
        <div class="alert alert-info alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong class="text-center text-capitalize">Il costo del codice univoco singolo (manuale non incluso) per
                rinnovare il tuo abbonamento annuale premium è di 30 euro. Richiedi il codice univoco tramite la chat
                servizio clienti presente nella piattaforma. The cost of 30 euros per year to purchase the unique code
                without the book.</strong>
        </div>

        <?php } ?>

        <?php if (strcmp($objUpgrade, 'used') == 0) { ?>
        <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong class="text-center text-capitalize">Codice errato o utilizzato. Acquista il "Manuale del
                collezionista di errori di coniazione" di Alessio Sena per ottenere il codice. Prenota la tua copia
                tramite la chat servizio clienti presente nella piattaforma. Buy the book or the code is used</strong>
        </div>
        <?php } ?>

    </div>
    <div class="container">
        <?php if (strcmp($objUpgrade, 'upgrade') == 0) { ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong class="text-center text-capitalize">Il tuo account è stato aggiornato a PREMIUM! Si prega di
                effettuare nuovamente l'accesso al proprio account per rendere effettive le modifiche al suo piano
                tariffario. Your account is upgraded to premium account. Please sign in
                again</strong>
        </div>
        <?php } ?>

    </div>




    <div class="p-5 text-center">
        <div class="row">
            <div class="col-md-12 wow fadeInUp">
                <div class=" text-center"
                    style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px">
                    <div class="row">
                        <div class="col-md-4">
                            <img style="width: 100%;" src="../user_img/<?php echo $rowProfile['image']; ?>"
                                class="card-img-top" alt="...">
                        </div>
                        <div class="col-md-6 offset-lg-1">
                            <div class="row">
                                <div class="col-md-6 pt-4 text-lg-left">
                                    <h2 class="mt-5 text-light"><?php echo $rowProfile['fname']; ?>
                                        <?php echo $rowProfile['lname']; ?>
                                    </h2>
                                    <p class="lead mt-4 text-light"><?php echo $rowProfile['email']; ?></p>
                                    <p class="lead mt-4 text-light"><?php echo $rowProfile['country']; ?></p>
                                    <a href="./standard_coins_list.php" class="btn btn-primary">Ricerca globale | Global
                                        search</a>
                                    <!-- <a href="./pending.php" class="btn btn-primary mt-3">Pending Certificate</a> -->
                                </div>
                                <div class="col-md-6 pt-4 text-lg-right">
                                    <div class="text-light mt-5" style="font-size: 30px;">
                                        <span>Total Coins: </span>
                                        <span style="font-weight: 600" class="num"> <?php echo $objNumberCoin; ?></span>
                                    </div>
                                    <div class="text-light mt-4 mb-3" style="font-size: 30px;">
                                        <span>My coins: </span>
                                        <span style="font-weight: 600" class="num">
                                            <?php echo $rowNum['totalNum']; ?></span>
                                    </div>
                                    <div class="powr-ecommerce" id="a3d504c3_1613861434"></div>
                                    <script src="https://www.powr.io/powr.js?platform=html"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container">
            <form action="" method="post">
                <p class="mt-4 mb-3 lead text-white">Inserisci il codice segreto presente nel "Manuale del collezionista
                    di errori di coniazione" di Alessio Sena per attivare l'abbonamento annuale PREMIUM. Consulta il
                    valore e l'indice di rarità di ogni moneta presente nella nostra banca dati. Il primo servizio al
                    mondo che valuta la tua collezione di varianti ed errori di coniazione! Upgrade Your Profile to
                    Unlock New Features!</p>
                <input type="number" name="code"
                    class="mx-auto form-control bg-light border-0 rounded w-50 p-4 mb-4 shadow-sm"
                    placeholder="codice - Code">



                <button type="submit" name="submitCode" class="btn btn-success m-1">UPGRADE - PASSA A PREMIUM</button>
                <button type="submit" name="code" class="btn btn-success m-1">RICHIEDI CODICE - REQUEST CODE</button>

            </form>
        </div>
        <div class="row">
            <div class="col-md-12 kami">
                <div class="">
                    <h1 class="text-center text-light pb-4 wow slideInLeft mt-4">↓COLLEZIONE↓ ↓MY COLLECTION↓</h1>
                    <div class="container-fluid" style="background: white;padding: 20px;">
                        <div class="table-responsive table-striped table-hover table-condensed container-fluid">
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



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-muted" id="exampleModalLabel">Message</h5>
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
                            <div class="col-md-6 ">
                                <div class="">

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

                                    <!-- <img data-src="../coin_img/<?php echo $row2['image']; ?>" style="width: 30%" alt="">
                                    <img data-src="../coin_img/<?php echo $row2['image2']; ?>" style="width: 30%" alt="">
                                    <img data-src="../coin_img/<?php echo $row2['image3']; ?>" style="width: 30%" alt="">
                                    <img data-src="../coin_img/<?php echo $row2['image4']; ?>" style="width: 30%" alt="">
                                    <img data-src="../coin_img/<?php echo $row2['image5']; ?>" style="width: 30%" alt=""> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a type="button" href="deleteMessage.php?id=<?php echo $row2['id']; ?>"
                            class="btn btn-danger">Delete</a>
                    </div>

                    <?php } ?>
                    <?php } else { ?>
                    <p>No Message</p>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="codeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upgrade To Premium</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="number" name="code" class="form-control bg-light border-0 rounded p-4 shadow-sm"
                            placeholder="Code">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submitCode" class="btn btn-success">Upgrade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>



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
            'url': 'ajaxfile2.php',
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