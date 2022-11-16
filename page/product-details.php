<?php
session_start();
// if ($_SESSION['name']) {
// } else {
//     header('location:../index.php');
// }
include('../class/database.php');
class marketPlace extends database
{
    public function marketFunction()
    {
        $id = $_GET['id'];
        $sql = "SELECT * from market_tbl left join data_tbl on market_tbl.market_coin_id = data_tbl.id where market_id = $id ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new marketPlace;
$objMarket = $obj->marketFunction();
$row = mysqli_fetch_assoc($objMarket);

$arr = array();

$arr[0] = $row['image'];
$arr[1] = $row['image2'];
$arr[2] = $row['image3'];
$arr[3] = $row['image4'];
$arr[4] = $row['image5'];

// echo var_dump($arr);

// $a = 'How are you?.';

// if (strpos($a, '.') !== false) {
//     echo 'true';
// } else {
//     echo 'false';
// }
?>


<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy / Compra | Minterrordatabase.com</title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nicebord.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.css">


    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="icon" href="../images/source file1.png" type="image/gif" sizes="100x100">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">



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

    .rolling-border-box {

        left: 0;
        top: 0;
        width: auto;
        height: auto;

    }

    .profileImg {
        width: 400px;
        height: 400px;
        object-fit: cover;
        object-position: center;
    }

    .contact {
        position: relative;
    }

    .box1 {
        border: 2px solid #000;
        display: inline-block;
        padding: 20px;
        width: 100%;
    }

    @media (min-width: 576px) {
        .contact .box {
            position: fixed;
            bottom: 10px;
            right: 10px;
        }

        .shipping {
            position: fixed;
            bottom: 100px;
            right: 20px;
            text-align: right;
            max-width: 20%;
        }



        .premium {
            position: fixed;
            bottom: 250px;
            right: 20px;
            text-align: right;
        }
    }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#"><?php if (isset($_SESSION['name'])) {
                                                            echo $_SESSION['name'];
                                                        } ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:history.back()">MARKETPLACE | NEGOZIO</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="p-3">

        <div class="owl-carousel text-center" id="two">
            <div class="text-center mx-auto"> <a href="https://www.facebook.com/groups/466202596862547" target="_blank">
                    <img src="../ad/cnrl.jpeg" class="d-block text-center mx-auto w-50" alt="">
                </a>
            </div>
            <div class="text-center mx-auto"> <a
                    href="https://senacoins.com/negozio/index.php?route=product/product&product_id=132" target="_blank">
                    <img src="../ad/premiumsubscription.png" class="d-block text-center mx-auto w-50" alt="">
                </a>
            </div>
            <div class="text-center mx-auto"> <a
                    href="https://senacoins.com/negozio/index.php?route=product/product&product_id=54" target="_blank">
                    <img src="../ad/senabook.jpeg" class="d-block text-center mx-auto w-50" alt=""></a>
            </div>
            <div class="text-center mx-auto"> <a href="https://martinserrorcoins.com/" target="_blank">
                    <img src="../ad/martinserrorcoinsbanner.png" class="d-block text-center mx-auto w-50" alt=""></a>
            </div>
            <div class="text-center mx-auto"> <a href="http://www.clippedcoins.com/fr/" target="_blank">
                    <img src="../ad/clippedcoinsbanner.jpg" class="d-block text-center mx-auto w-50" alt=""></a>
            </div>
            <div class="text-center mx-auto"> <a href="https://senacoins.com/" target="_blank">
                    <img src="../ad/senacoinsofficial.png" class="d-block text-center mx-auto w-50" alt="">
                </a>
            </div>

        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="owl-carousel" id="one">
                    <?php for ($i = 0; $i < count($arr); $i++) { ?>
                    <?php if (strpos($arr[$i], '.') !== false) { ?>
                    <div class="item mb-0">
                        <a href="./coinimg.php?id=<?php echo $row['id']; ?>" target="_blank"><img class="img-fluid"
                                src="../coin_img/<?php echo $arr[$i]; ?>" alt=""></a>
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
                <small class="mt-0 text-center d-block">Click to view / Clicca per vedere</small>
            </div>
            <div class="col-md-4 text-center">

                <h3 class="font-weight-bold mt-5" style="color: darkgoldenrod">Price / Prezzo
                    <span>€<?php echo $row['price']; ?></span>
                </h3>
                <h5 class="font-weight-bold">On sale since / In vendita dal :
                    <span><?php echo date("M jS, Y", strtotime($row['created_at'])); ?></span>
                </h5>
                <h5 class="font-weight-bold">Seller / Venditore :
                    <span><?php echo $row['username']; ?></span>
                </h5>
                <h5 class="font-weight-bold"> Reference / Riferimento :
                    <span><?php echo $row['reference'] ?></span>
                </h5>
                <h5 class="font-weight-bold">Country:
                    <span><?php echo $row['code']; ?></span>
                </h5>
                <h5 class="font-weight-bold mb-5">Historical Period:
                    <span><?php echo $row['timeperiod']; ?></span>
                </h5>
                <div class="">
                    <h5 class="font-weight-bold">Type of coin / Tipo di moneta :
                        <span><?php echo $row['type_of_coin']; ?></span>
                    </h5>
                    <h5 class="font-weight-bold"> Year / Anno: <span><?php echo $row['year'] ?></span></h5>
                    <h5 class="font-weight-bold"> Category / Categoria:
                        <span><?php echo $row['category'] ?></span>
                    </h5>
                    <h5 class="font-weight-bold"> Sub-category / Sub-categoria :
                        <span><?php echo $row['sub_category'] ?></span>
                    </h5>
                    <h5 class="font-weight-bold"> Description / Descrizione :
                        <span><?php echo $row['description'] ?></span>
                    </h5>
                    <h5 class="font-weight-bold"> More Info / Informazioni aggiuntive:
                        <span><?php echo $row['details'] ?></span>
                    </h5>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <?php if (isset($_SESSION['p_user'])) { ?>
                <div class="mt-5">
                    <h3 class="font-weight-bold mt-5" style="color: darkgoldenrod">Minterrordatabase.com Rating | Valore
                    </h3>
                    <h5 class="font-weight-bold mt-5" style="color: red">Rarity | Rarità = <?php echo $row['rarity']; ?>
                    </h5>
                    <?php if (strcmp($row['timeperiod'], 'UNIONE EUROPEA') == 0) { ?>
                    <h5 style="color: green">MS 69 | ECZ = <?php echo $row['fdc'] ?>
                    </h5>
                    <h5 style="color: green">MS 65 | FDC =
                        <?php echo $row['spl'] ?>
                    </h5>
                    <h5 style="color: green">AU 58 | SPL =
                        <?php echo $row['bb'] ?>
                    </h5>
                    <h5 style="color: green">XF | BB =
                        <?php echo $row['mb'] ?>
                    </h5>
                    <h5 style="color: green">VF - MB =
                        <?php echo $row['ecz'] ?>
                    </h5>
                    <?php } else { ?>
                    <h5 style="color: green">MS 69 | ECZ = <?php echo $row['ecz'] ?>
                    </h5>
                    <h5 style="color: green">MS 65 | FDC =
                        <?php echo $row['fdc'] ?>
                    </h5>
                    <h5 style="color: green">AU 58 | SPL =
                        <?php echo $row['spl'] ?>
                    </h5>
                    <h5 style="color: green">XF | BB =
                        <?php echo $row['bb'] ?>
                    </h5>
                    <h5 style="color: green">VF - MB =
                        <?php echo $row['mb'] ?>
                    </h5>
                    <?php } ?>

                </div>
                <?php } ?>
                <div class="mt-5">
                    <h4 class="font-weight-bold" style="color: darkgoldenrod">Location / Posizione</h4>
                    <p class="">Country: <?php echo $row['country']; ?> </p>
                    <p> City: <?php echo $row['city'] ?></p>
                    <p> Shipment / Spedizione:
                        <span class="font-weight-bold"><?php echo $row['shipping_price']; ?></span>
                    </p>
                </div>
                <div class="mt-5">
                    <div class="">
                        <h4 class="font-weight-bold" style="color: gdarkgoldenrod">Contact me | Contattami</h4>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $row['whatsapp']; ?>"
                            class="btn btn-success font-weight-bold" data-toggle="tooltip" data-placement="top"
                            title="<?php echo $row['whatsapp']; ?>"><i class="fab fa-whatsapp"></i></a>
                        <a href="tel:<?php echo $row['phone']; ?>" class="btn btn-info font-weight-bold"
                            data-toggle="tooltip" data-placement="top" title="<?php echo $row['phone']; ?>"><i
                                class="fas fa-phone"></i></a>
                        <a href="mailto:<?php echo $row['email']; ?>" class="btn btn-danger font-weight-bold"
                            data-toggle="tooltip" data-placement="top" title="<?php echo $row['email']; ?>"><i
                                class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>


    </div>


    </div>








</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="../js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>



<script src="../js/wow.js"></script>
<script src="../js/showmoreless.min.js"></script>
<script src="../js/nicebord.js"></script>
<script src="../js/owl.carousel.js"></script>
<script>
new WOW().init();
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
$(function() {
    $('.show-less-div').myOwnLineShowMoreLess({
        showLessLine: 3,
        showLessText: 'Read Less',
        showMoreText: 'Read More'
    });
})
$('.example').nicebord({
    color: 'gold',
    orientation: 'ckw',
    size: 5,
    pos: 'top,right,bottom,left',
    speed: 500,
    direction: false,
    fix: false,
    center: false
});
$(document).ready(function() {
    let one = $('#one');
    let two = $('#two');
    one.owlCarousel({
        loop: true,
        margin: 10,
        center: true,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    two.owlCarousel({
        loop: true,
        margin: 10,
        center: true,
        nav: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })

});
</script>


</html>