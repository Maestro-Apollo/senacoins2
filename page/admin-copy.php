<?php
session_start();
include('../class/database.php');
if ($_SESSION['name']) {
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
    public function codeGenerate()
    {
        $sql = "select * from code";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }

        # code...
    }
}
$objNumStandard = new totalNumberStandard;
$objNumberStandard = $objNumStandard->totalNumberStandardFunction();
$objCode = $objNumStandard->codeGenerate();
// $rowCoins = mysqli_fetch_assoc($objNumber);

?>






<!doctype html>
<html lang="en" class="h-100">

<head style="background-color: #1c1d26">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Sticky Footer Navbar Template · Bootstrap</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
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
                <a class="navbar-brand" href="#">Admin Panel</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="updateProfile.php">Update <span
                                    class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="request.php">Request
                                <sup><b><?php echo $rowC['total']; ?></b></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_submit.php">Submit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="code.php">Code
                            </a>
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
        <h1 class="text-light">Admin Panel</h1>
    </div>
    <div class="p-5">
        <div class="row text-center">
            <div class="col-md-4 mt-2 col-sm-12 text-center text-light"
                style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px; height: 200px">
                <h3 class="mt-5">Total Coins</h3>
                <p class="lead num" style="font-size: 30px;"><?php echo $objNumberCoin; ?></p>
            </div>
            <div class="col-md-4  mt-2 col-sm-12 text-center text-light"
                style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px; height: 200px">
                <h3 class="mt-5">Total Premium Users</h3>
                <p class="lead num" style="font-size: 30px;"><?php echo $objNumberPremium; ?></p>
            </div>
            <div class="col-md-4  mt-2  col-sm-12 text-center text-light"
                style=" background:linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(210,7,7,1) 100%); border-radius:10px; height: 200px">
                <h3 class="mt-5">Total Standard Users</h3>
                <p class="lead num" style="font-size: 30px;"><?php echo $objNumberStandard; ?></p>
            </div>

        </div>
    </div>


    <!-- <div>
        <div class="container bg-light">


            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>code</th>
                        <th>Taken</th>
                        <th>Created</th>
                        <th>Taken Date</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if ($objCode) { ?>
                    <?php while ($rowCode = mysqli_fetch_assoc($objCode)) { ?>
                    <tr>
                        <td><?php echo $rowCode['id']; ?></td>
                        <td>Customer Support</td>
                        <td>New York</td>
                        <td>27</td>
                        <td>2011/01/25</td>
                        <td>$112,000</td>
                    </tr>


                    <?php } ?>
                    <?php } ?>


                </tbody>

                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>code</th>
                        <th>Taken</th>
                        <th>Created</th>
                        <th>Taken Date</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div> -->




</body>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js
"></script>
<script>
$(".num").counterUp({
    delay: 10,
    time: 1000
});
</script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>





</html>