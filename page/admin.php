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
    public function countCertificate()
    {

        $sqlC = "Select count(*) as total from certificate_request where pending = 0 AND complete = 0 ";
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
$objCer = $objCount->countCertificate();
$rowCer = mysqli_fetch_assoc($objCer);
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
    <meta charset="gb18030">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Minterrordatabase.com</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css ">
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
    <div class="text-center pt-4 pb-4">
        <h1 class="text-light">Amministratore</h1>
    </div>
    <div class="p-5">
        <div class="row text-center">
            <div class="col-md-4 mt-2 col-sm-12 text-center text-light"
                style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px; height: 200px">
                <h3 class="mt-5">Monete totali</h3>
                <p class="lead num" style="font-size: 30px;"><?php echo $objNumberCoin; ?></p>
            </div>
            <div class="col-md-4  mt-2 col-sm-12 text-center text-light"
                style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px; height: 200px">
                <h3 class="mt-5">Utenti premium</h3>
                <p class="lead num" style="font-size: 30px;"><?php echo $objNumberPremium; ?></p>
            </div>
            <div class="col-md-4  mt-2  col-sm-12 text-center text-light"
                style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px; height: 200px">
                <h3 class="mt-5">Utenti standard</h3>
                <p class="lead num" style="font-size: 30px;"><?php echo $objNumberStandard; ?></p>
            </div>

        </div>
    </div>
    <div class="text-center">
        <a href="standard_users_list.php" class="btn btn-lg btn-danger">Standard Users</a>
        <a href="premium_users_list.php" class="btn btn-lg btn-danger">Premium Users</a>
        <a href="all_coins_list.php" class="btn btn-lg btn-danger">All Coins</a>
        <a href="certificate_request_list.php" class="btn btn-lg btn-danger">Certificate Request List
            (<?php echo $rowCer['total']; ?>) </a>
    </div>


    <!-- <div class="p-5">

        <table class="table table-hover table-responsive" id="myTable">
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
                    <th scope="col">Action</th>
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
                    <td class="span2">
                        <a href="admin_update.php?id=<?php echo urlencode($row['id']); ?>"
                            class="btn btn-success btn-block">View</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-block">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <p>No Data</p>
                <?php } ?>
            </tbody>
        </table>
    </div> -->




</body>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
<script>
$(".num").counterUp({
    delay: 10,
    time: 1000
});
</script>





</html>