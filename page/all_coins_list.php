<?php
session_start();
include('../class/database.php');
if (isset($_SESSION['admin_user'])) {
} else {
    header('location:../index.php');
}

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

class totalNumberPremium extends database
{
    protected $link;
    public function totalNumberPremiumFunction()
    {
        $sqlNum = "select * from premium_user";
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
$objNumPremium = new totalNumberPremium;
$objNumberPremium = $objNumPremium->totalNumberPremiumFunction();
// $rowCoins = mysqli_fetch_assoc($objNumber);

?>
<?php

class totalNumberStandard extends database
{
    protected $link;
    public function totalNumberStandardFunction()
    {
        $sqlNum = "select * from standard_user";
        $resNum = mysqli_query($this->link, $sqlNum);
        if ($resNum) {
            $countCoin = mysqli_num_rows($resNum);
            return $countCoin;
        } else {
            return false;
        }
        # code...
    }
    // public function randomFunction()
    // {
    //     $key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

    //     function encryptthis($data, $key)
    //     {
    //         $encryption_key = base64_decode($key);
    //         $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    //         $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    //         return base64_encode($encrypted . '::' . $iv);
    //     }
    //     for ($i = 0; $i < 500; $i++) {
    //         $code = mt_rand(10000000, 99999999);
    //         $enc = encryptthis($code, $key);
    //         $sql = "INSERT INTO `code` (`id`, `code`, `user`, `account`, `taken`, `created`, `updated`) VALUES (NULL, '$enc', '', 0, 0, CURRENT_TIMESTAMP, 'No Date')";
    //         mysqli_query($this->link, $sql);
    //     }

    // }
}
$objNumStandard = new totalNumberStandard;
$objNumberStandard = $objNumStandard->totalNumberStandardFunction();
// $objRandom = $objNumStandard->randomFunction();
// $rowCoins = mysqli_fetch_assoc($objNumber);

?>






<!doctype html>
<html lang="en" class="h-100">

<head style="background-color: #1c1d26">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Minterrordatabase.com</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
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

<body style="background-color: #1c1d26" class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">PANNELLO DI CONTROLLO</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="../index.php"><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="updateProfile.php">AGGIORNA PROFILO<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="code.php">CODICI<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="today.php">OGGI<span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="request.php">RICHIESTE
                                <sup><b><?php echo $rowC['total']; ?></b></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_submit.php">INSERISCI MONETE
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                BANCA DATI
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">

                                <?php if ($objCon) { ?>
                                <?php while ($rowCon = mysqli_fetch_assoc($objCon)) { ?>
                                <a class="dropdown-item text-dark bg-dark"
                                    href="countries.php?code=<?php echo $rowCon['code']; ?>"><?php echo $rowCon['name']; ?></a>
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

    </header>

    <!-- Begin page content -->
    <div class="text-center pt-4">
        <h1 class="text-light">All Coins List</h1>
    </div>
    <div class="p-5">
        <div class="bg-white p-4 table-responsive">
            <table id='userTable' class='display dataTable table-bordered' width='100%'>
                <thead>
                    <tr>
                        <th>Type Of Coin</th>
                        <th>Image</th>
                        <th>Year</th>
                        <th>Cod Cat</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Rarity</th>
                        <th>Reference</th>
                        <th>Timeperiod</th>
                        <th>MB</th>
                        <th>BB</th>
                        <th>SPL</th>
                        <th>FDC</th>
                        <th>ECZ</th>
                        <th>Country</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>








</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script>
$(".num").counterUp({
    delay: 10,
    time: 1000
});
</script>
<script>
$(document).ready(function() {
    var userDataTable = $('#userTable').DataTable({
        'processing': true,
        'serverSide': true,
        responsive: true,

        'serverMethod': 'post',
        'ajax': {
            'url': 'ajaxCoin.php'
        },
        'columns': [{
                data: 'type_of_coin'
            },
            {
                data: 'img'
            },
            {
                data: 'year'
            },
            {
                data: 'cod_cat'
            },
            {
                data: 'description'
            },
            {
                data: 'category'
            },
            {
                data: 'sub_category'
            },
            {
                data: 'rarity'
            },
            {
                data: 'reference'
            },
            {
                data: 'timeperiod'
            },
            {
                data: 'mb'
            },
            {
                data: 'bb'
            },
            {
                data: 'spl'
            },
            {
                data: 'fdc'
            },
            {
                data: 'ecz'
            },
            {
                data: 'code'
            },
            {
                data: 'user'
            },
            {
                data: 'action'
            }


        ]
    });
})
</script>





</html>