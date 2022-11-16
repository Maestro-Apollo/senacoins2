<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}
include('../class/database.php');
class marketPlace extends database
{
    public function marketFunction()
    {
        $sql = "SELECT * from market_tbl left join data_tbl on market_tbl.market_coin_id = data_tbl.id order by market_tbl.market_id DESC";
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


?>

<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace | Minterrordatabase.com</title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nicebord.css">


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
    </style>

</head>

<body style="background: radial-gradient(silver,#fff)">
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

                    <li class="nav-item">
                        <?php if (isset($_SESSION['p_user'])) { ?>
                        <a class="nav-link" href="./premium_page.php">HOME | ACCOUNT</a>
                        <?php } else { ?>
                        <a class="nav-link" href="./standard_page.php">HOME | ACCOUNT</a>
                        <?php } ?>

                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="p-3">

        <div class="text-center">

            <h5 class="text-dark font-weight-bold mb-4">Benvenuto nel Marketplace di Minterrordatabase.com ! Sezione in
                fase di collaudo finale. Il servizio sarà attivo e gratuito per tutti gli utenti standard e premium
                della nostra piattaforma il giorno Lunedì 25 Ottobre 2021.
            </h5>

        </div>

        <div class="owl-carousel text-center">
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

        <div class="">
            <div class="row ">
                <?php if ($objMarket) { ?>
                <?php while ($row = mysqli_fetch_assoc($objMarket)) { ?>
                <div class="col-md-3 wow zoomIn">
                    <div class="card border-0 example">
                        <img class="card-img-top" src="../coin_img/<?php echo $row['image']; ?>"
                            alt="SenaCoin MarketPlace">
                        <div class="card-body text-center">
                            <!-- <h5 class="card-title font-weight-bold"><?php echo $row['title']; ?></h5> -->
                            <!-- <p class="card-text show-less-div mb-0">Price: <?php echo $row['price']; ?></p> -->
                            <h5 class="card-title mb-0">Price / Prezzo : <span class="font-weight-bold"
                                    style="color: goldenrod;">€<?php echo $row['price']; ?></span></h5>
                            <p class="card-text show-less-div mb-0">On sale from / In vendita dal :
                                <?php echo date("M jS, Y", strtotime($row['created_at'])); ?></p>
                            <p class="card-text show-less-div mb-0">Type of Coin / Tipo di moneta :
                                <?php echo $row['type_of_coin']; ?>
                            </p>
                            <p class="card-text show-less-div mb-0">Year / Anno : <?php echo $row['year']; ?></p>
                            <p class="card-text show-less-div mb-0">Category / Categoria :
                                <?php echo $row['category']; ?></p>
                            <p class="card-text show-less-div mb-0">Sub-Category/ Sub-categoria:
                                <?php echo $row['sub_category']; ?>
                            </p>
                            <p class="card-text show-less-div mb-0">Description / Descrizione :
                                <?php echo $row['description']; ?></p>
                            <p class="card-text show-less-div mb-0">Reference / Riferimento :
                                <?php echo $row['reference']; ?></p>
                            <a href="product-details.php?id=<?php echo $row['market_id']; ?>" class="btn text-white"
                                style="background-color: darkgoldenrod">SEE DETAILS | VEDI DETTAGLI</a>
                        </div>
                    </div>
                </div>

                <?php } ?>
                <?php } ?>

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
<!-- <script src="../js/showmoreless.min.js"></script> -->
<script src="../js/nicebord.js"></script>
<script>
new WOW().init();
</script>

<script>
// $(function() {
//     $('.show-less-div').myOwnLineShowMoreLess({
//         showLessLine: 3,
//         showLessText: 'Read Less',
//         showMoreText: 'Read More'
//     });
// })
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
</script>


</html>