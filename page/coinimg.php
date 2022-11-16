<?php
// Turn off error reporting
session_start();

error_reporting(0);


include '../class/database.php';
class coinImg extends database
{

    public function coinFunction()
    {
        $id = $_GET['id'];
        $sql = "SELECT *
        FROM coin_data
        INNER JOIN data_tbl
        ON coin_data.item_id = data_tbl.id where coin_data.item_id = $id ";
        // $sql = "SELECT * from coin_data where item_id = $id ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function checkFunction()
    {
        $user = $_SESSION['name'];
        $sql = "SELECT * from premium_user where username = '$user' ";
        $res = mysqli_query($this->link, $sql);
        $sql2 = "SELECT * from `admin` where username = '$user' ";
        $res2 = mysqli_query($this->link, $sql2);
        if (mysqli_num_rows($res) > 0 || mysqli_num_rows($res2) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new coinImg;
$objImg = $obj->coinFunction();
$objCheck = $obj->checkFunction();
$row = mysqli_fetch_assoc($objImg);
// $page = basename(__FILE__, '.php');
// $_SESSION['login'] = $page;
?>
<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>© Sena Coins - All rights reserved.</title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/source file1.png" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.css">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        -webkit-user-select: none;
        -webkit-touch-callout: none;
    }

    h1,
    h3,
    p,
    span,
    a,
    button {
        font-family: 'Roboto', sans-serif;
    }

    #footer {
        background: #272833;
        padding: 6em 0;
        text-align: center;
    }

    #footer .icons .icon.alt {
        text-decoration: none;
    }

    #footer .icons .icon.alt:before {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        text-transform: none !important;
        font-family: 'Font Awesome 5 Free';
        font-weight: 400;
    }

    #footer .icons .icon.alt:before {
        color: #272833 !important;
        text-shadow: 1px 0 0 rgba(255, 255, 255, 0.5), -1px 0 0 rgba(255, 255, 255, 0.5), 0 1px 0 rgba(255, 255, 255, 0.5), 0 -1px 0 rgba(255, 255, 255, 0.5);
    }

    #footer .copyright {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.8em;
        line-height: 1em;
        margin: 2em 0 0 0;
        padding: 0;
        text-align: center;
    }

    #footer .copyright li {
        border-left: solid 1px rgba(255, 255, 255, 0.3);
        display: inline-block;
        list-style: none;
        margin-left: 1.5em;
        padding-left: 1.5em;
    }

    #footer .copyright li:first-child {
        border-left: 0;
        margin-left: 0;
        padding-left: 0;
    }

    #footer .copyright li a {
        color: inherit;
    }

    .icon {
        text-decoration: none;
        border-bottom: none;
        position: relative;
    }

    .icon:before {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        text-transform: none !important;
        font-family: 'Font Awesome 5 Free';
        font-weight: 400;
    }

    table {
        white-space: nowrap
    }

    @media (max-width: 575.98px) {
        .title {
            font-size: 20px;
        }

        .title2 {
            font-size: 15px;
        }
    }

    .navbar {
        background-color: #D01110;
    }

    /* .product-img {
        object-fit: cover;
        object-position: center;
        height: 150px;
        width: 150px;
    } */
    </style>
</head>

<body style=" background-color: #fff" onselectstart='return false;'>

    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #D01110 !important;">
        <div class="container">

            <!-- <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->

            <ul class="navbar-nav mx-auto mt-2 mt-lg-0">

                <div class="d-flex">
                    <?php if (isset($_SESSION['s_user'])) { ?>

                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold" href="./standard_page.php">Home</a>
                    </li>
                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold" href="./logout.php">Logout</a>
                    </li>
                    <?php } else if (isset($_SESSION['p_user'])) { ?>

                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold" href="./premium_page.php">Home</a>
                    </li>
                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold" href="./logout.php">Logout</a>
                    </li>
                    <?php } else if (isset($_SESSION['admin_user'])) { ?>

                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold" href="./admin.php">Home</a>
                    </li>
                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold" href="./logout.php">Logout</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold"
                            href="./login.php?location=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>&id=<?php echo $_GET['id']; ?>">Login
                            | Accedi</a>
                    </li>
                    <li class="nav-item ml-3 mr-3">
                        <a class="nav-link text-white font-weight-bold" href="./standardSignUp.php">Sign up for free |
                            Iscriviti gratis</a>
                    </li>
                    <?php } ?>


                </div>

            </ul>

        </div>
    </nav>


    <div class="pr-3 pl-3">






        <?php if ($objImg) { ?>

        <div class="">



            <div class="">
                <div class="">
                    <div class="">

                        <div class="mt-4 text-center container">
                            <div class="owl-carousel text-center">
                                <div class="text-center mx-auto"> <a
                                        href="https://senacoins.com/negozio/index.php?route=product/product&product_id=132"
                                        target="_blank">
                                        <img src="../ad/premiumsubscription.png"
                                            class="d-block text-center mx-auto w-50" alt="">
                                    </a>
                                </div>
                                <div class="text-center mx-auto"> <a
                                        href="https://senacoins.com/negozio/index.php?route=product/product&product_id=54"
                                        target="_blank">
                                        <img src="../ad/senabook.jpeg" class="d-block text-center mx-auto w-50"
                                            alt=""></a>
                                </div>
                                <div class="text-center mx-auto"> <a href="https://senacoins.com/" target="_blank">
                                        <img src="../ad/senacoinsofficial.png" class="d-block text-center mx-auto w-50"
                                            alt="">
                                    </a>
                                </div>

                            </div>

                            <h5 class="text-dark demo title font-weight-bold mt-4">
                                <?php echo $row['description']; ?>
                                <?php echo $row['reference']; ?>
                            </h5>



                            <!--<h3 class="text-white title2 demo font-weight-bold"><?php echo $row['type_of_coin']; ?>-->
                            <!--</h3>-->

                        </div>




                        <div class="row mt-2">
                            <div class="col-md-4 mt-2">
                                <img class="block__pic img-fluid" src="../coin_img/<?php echo $row['image']; ?>"
                                    alt="sena coins" onerror='this.style.display = "none"'>
                            </div>
                            <!-- <div class="col-md-4 mt-2">
                                <img style="color: #1c1d26;" class="block__pic img-fluid"
                                    src="../coin_img/<?php echo $row['image1']; ?>" alt="sena coins"
                                    onerror='this.style.display = "none"'>
                            </div> -->
                            <div class="col-md-4 mt-2">
                                <img class="block__pic img-fluid" src="../coin_img/<?php echo $row['image2']; ?>"
                                    alt="sena coins" onerror='this.style.display = "none"'>
                            </div>
                            <div class="col-md-4 mt-2">
                                <img class="block__pic img-fluid" src="../coin_img/<?php echo $row['image3']; ?>"
                                    alt="sena coins" onerror='this.style.display = "none"'>
                            </div>
                            <div class="col-md-4 mt-2">
                                <img style="color: #1c1d26;" class="block__pic img-fluid"
                                    src="../coin_img/<?php echo $row['image4']; ?>" alt="sena coins"
                                    onerror='this.style.display = "none"'>
                            </div>

                            <div class="col-md-4 mt-2">
                                <img style="color: #1c1d26;" class="block__pic img-fluid"
                                    src="../coin_img/<?php echo $row['image5']; ?>" alt="sena coins"
                                    onerror='this.style.display = "none"'>
                            </div>

                        </div>
                        <?php if ($objCheck) { ?>
                        <div class="text-center mt-4 bg-white">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>


                                            <?php if (strcmp($row['timeperiod'], 'UNIONE EUROPEA') == 0) { ?>
                                            <th scope="col">XF BB</th>
                                            <th scope="col">AU58 SPL</th>
                                            <th scope="col">MS65 FDC</th>
                                            <th scope="col">MS69 ECZ</th>
                                            <?php } else { ?>
                                            <th scope="col">VF MB</th>
                                            <th scope="col">XF BB</th>
                                            <th scope="col">AU58 SPL</th>
                                            <th scope="col">MS65 FDC</th>
                                            <?php } ?>
                                            <th scope="col">Rarity</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>



                                            <td><?php echo $row['mb']; ?></td>
                                            <td><?php echo $row['bb']; ?></td>
                                            <td><?php echo $row['spl']; ?></td>
                                            <td><?php echo $row['fdc']; ?></td>
                                            <td><?php echo $row['rarity']; ?></td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <?php } ?>

                        <div class="text-center mt-4 bg-white">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Cod Cat</th>
                                            <th scope="col">Type of coin</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Sub Category</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo $row['cod_cat']; ?></th>
                                            <td><?php echo $row['type_of_coin']; ?></td>
                                            <td><?php echo $row['year']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['sub_category']; ?></td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
        <?php } else { ?>
        <p class="text-dark text-center display-1">Immagini non disponibili. Coming Soon!</p>
        <?php } ?>
    </div>
    <footer id="footer">
        <div style="margin-bottom:40px">
            <a href="../files/minterrordatabase.com - Termini e condizioni del servizio.pdf" target="__blank"
                style="color: #fff;font-weight:600;text-decoration:none;margin-left:20px;margin-right:20px">Terms
                &
                Conditions</a>
            <a href="../files/Website_Privacy_Policy_Final.pdf" target="__blank"
                style="color: #fff;font-weight:600;text-decoration:none;margin-left:20px;margin-right:20px">Privacy
                Policy</a>
        </div>
        <ul class="icons">

            <a href="https://www.facebook.com/groups/856622304511279/" class="text-white ml-3 mr-3"><i
                    class="fab fa-facebook-f fa-2x"></i></a>
            <a href="https://www.instagram.com/sena_coins/" class="text-white ml-3 mr-3"><i
                    class="fab fa-2x fa-instagram"></i></a>


        </ul>
        <ul class="copyright">
            <p class="Copyright">Piattaforma a cura di Alessio Sena - Perito numismatico Specializzato in errori di
                coniazione</p>
            <p>C.C.I.A.A. di Roma, Italia - Iscrizione ruolo N° 2447</p>
            <p>P.IVA 16106651009</p>
            <p>© 2020-2021 Sena Coins - All rights reserved</p>
        </ul>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/zoomsl.js"></script>
    <script src="../js/textyle.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".block__pic").imagezoomsl({
            zoomrange: [1, 10],
            cursorshadeborder: '5px solid #000',
            magnifiereffectanimate: 'fadeIn',
            magnifierpos: 'right'
        });
    });
    </script>

    <script>
    document.addEventListener("contextmenu", function(prevent) {
        prevent.preventDefault();
    })
    </script>
    <script>
    $('.demo').textyle({
        callback: function() {

            $(this).css({
                color: 'darkgoldenrod',
                transition: '1s',
                easing: 'swing'

                // more css here
            });
        }
    });
    </script>
    <script src="../js/owl.carousel.js"></script>
    <script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            center: true,
            nav: true,
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
                    items: 3
                }
            }
        })
    });
    </script>

</body>

</html>