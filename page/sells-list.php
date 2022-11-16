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
        $username = $_SESSION['name'];
        $sql = "SELECT * from market_tbl left join data_tbl on market_tbl.market_coin_id = data_tbl.id where market_tbl.username = '$username' ";
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
    <title>Minterrordatabase.com - </title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">


    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
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

    /* .rolling-border-box {

        left: 0;
        top: 0;
        width: auto;
        height: auto;

    } */

    /* .list-group-item {
        transition: 0.7s;
    }

    .list-group-item:hover {
        background-color: goldenrod;
        color: #fff;
    } */
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

                    <li class="nav-item">
                        <a class="nav-link" href="javascript:history.back()">Home</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="p-3">

        <div class="text-center">

            <h5 class="text-light font-weight-bold mb-4">Users Coins List
            </h5>

        </div>

        <div class="p-3">
            <div class="">
                <div class="">
                    <?php if ($objMarket) { ?>
                    <?php while ($row = mysqli_fetch_assoc($objMarket)) { ?>
                    <div class="row bg-white mb-4">
                        <div class="col-md-2 bg-white">
                            <img src="../coin_img/<?php echo $row['image']; ?>" alt="">
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex w-100 justify-content-between">
                                <!-- <h5 class="mb-1"><?php echo $row['title']; ?></h5> -->
                                <h5 class="font-weight-bold mt-5" style="color: black">Price:
                                    <span>€<?php echo $row['price']; ?></span>
                                </h5>

                            </div>
                            <p class="font-weight-bold">Coin on sale since:
                                <span><?php echo date("M jS, Y", strtotime($row['created_at'])); ?></span>
                            </p>
                            <p class="font-weight-bold">Country:
                                <span><?php echo $row['code']; ?></span>
                            </p>
                            <p class="font-weight-bold mb-5">Historical Period:
                                <span><?php echo $row['timeperiod']; ?></span>
                            </p>
                            <a href="./coinsell-edit.php?id=<?php echo $row['market_coin_id']; ?>" class="btn btn-info">
                                Edit
                            </a>
                            <a href="product-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            <a href="./seller-coin-switch.php?id=<?php echo $row['id'] ?>&market_id=<?php echo $row['market_id']; ?>"
                                class="btn btn-success">Switch</a>
                        </div>
                        <div class="col-md-2 mt-5">
                            <p class="font-weight-bold">Type of coin: <?php echo $row['type_of_coin']; ?> </p>
                            <p class="font-weight-bold"> Category: <?php echo $row['category'] ?></p>
                            <p class="font-weight-bold"> Sub Category:
                                <span class="font-weight-bold">€<?php echo $row['sub_category']; ?></span>
                            </p>
                        </div>
                        <div class="col-md-2 mt-5">
                            <h4 class="font-weight-bold">Shipping Information</h4>
                            <p class="">Country: <?php echo $row['country']; ?> </p>
                            <p> City: <?php echo $row['city'] ?></p>
                            <p> Price & Method:
                                <span class="font-weight-bold">€<?php echo $row['shipping_price']; ?></span>
                            </p>
                        </div>
                        <div class="col-md-2">
                            <?php if (isset($_SESSION['p_user'])) { ?>
                            <h4 class="font-weight-bold">Minterrordatabase.com Evaluation</h4>
                            <p class="">Rarity: <?php echo $row['rarity']; ?> </p>
                            <p> ECZ: <?php echo $row['ecz'] ?></p>
                            <p> FDC:
                                <?php echo $row['fdc'] ?>
                            </p>
                            <p> SPL:
                                <?php echo $row['spl'] ?>
                            </p>
                            <p> BB:
                                <?php echo $row['bb'] ?>
                            </p>
                            <p> MB:
                                <?php echo $row['mb'] ?>
                            </p>
                            <?php } ?>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <?php } ?>

                <?php } else { ?>
                <h1 class="text-white">No sells product</h1>
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
<script src="../js/showmoreless.min.js"></script>
<script>
new WOW().init();
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
</script>


</html>