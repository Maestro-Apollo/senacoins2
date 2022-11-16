<?php
session_start();
include '../class/database.php';



if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}
class country extends database
{
    protected $link;
    public function countryFunction()
    {
        $code = $_GET['code'];
        $sql = "Select * from countries where continent_code = '$code' order by name ASC ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }

        # code...
    }
    public function continentNameFunction()
    {
        $code = $_GET['code'];
        $sql = "Select * from continents where code = '$code'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }

        # code...
    }
    public function countryNumber($val)
    {
        $sql = "select * from data_tbl where code = '$val' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            $num = mysqli_num_rows($res);
            return $num;
        } else {
            return 0;
        }

        # code...
    }
    public function countryNumber2($val)
    {
        $sql = "select * from data_tbl where timeperiod = '$val' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            $num = mysqli_num_rows($res);
            return $num;
        } else {
            return 0;
        }

        # code...
    }
    public function totalNumber()
    {
        $code = $_GET['code'];
        $total = 0;
        $sql = "Select * from countries where continent_code = '$code' ";
        $res = mysqli_query($this->link, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $country = $row['name'];
            $sql2 = "select * from data_tbl where code = '$country' ";
            $res2 = mysqli_query($this->link, $sql2);
            if (mysqli_num_rows($res2) > 0) {
                $num2 = mysqli_num_rows($res2);
                $total += $num2;
            }
        }
        return $total;
    }
}
$obj = new country;
$objCo = $obj->countryFunction();
$objNum = $obj->continentNameFunction();
$rowCon = mysqli_fetch_assoc($objNum);
?>

<!-- <?php

        class time extends database
        {
            protected $link;
            public function timeFunction()
            {
                $codeT = $_GET['country'];
                $sqlT = "Select * from time_select where country_code = '$codeT' ";
                $resT = mysqli_query($this->link, $sqlT);
                if (mysqli_num_rows($resT) > 0) {
                    return $resT;
                } else {
                    return false;
                }
                # code...
            }
        }
        $objT = new time;
        $objTime = $objT->timeFunction();

        ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
    <style>
    h1,
    h3,
    p,
    span,
    a,
    button {
        font-family: 'Roboto', sans-serif;
    }
    </style>
</head>

<body style="background-color: #1c1d26">

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-light" href="#">Sena Coins</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>




    <section>
        <div class="container">
            <?php if (strcmp($_GET['code'], 'EU') == 0) { ?>
            <h1 class="text-white mt-3 font-weight-bold text-center text-capitalize">
                <?php echo $rowCon['name']; ?><span class="ml-2 badge badge-danger"><?php echo ($obj->totalNumber() + $obj->countryNumber2('UNIONE EUROPEA')) . ' Coins';
                                                                                        ?></span>

            </h1>
            <?php } else { ?>
            <h1 class="text-white mt-3 font-weight-bold text-center text-capitalize">
                <?php echo $rowCon['name']; ?><span class="ml-2 badge badge-danger"><?php echo ($obj->totalNumber()) . ' Coins';
                                                                                        ?></span>

            </h1>
            <?php } ?>
            <div class="row">

                <div class="">

                    <div class="row">
                        <?php if ($objCo) { ?>
                        <?php while ($row = mysqli_fetch_assoc($objCo)) { ?>

                        <div class="col-md-4 wow fadeInUp">
                            <div class="card card-body m-3">
                                <?php if (strcmp($row['name'], 'European Union (Euro)') == 0) { ?>
                                <p class="text" style="margin-bottom: 0px"><?php echo $row['name']; ?> <span
                                        class="badge float-right badge-success">

                                        <?php echo $obj->countryNumber2('UNIONE EUROPEA') . ' Coins'; ?></span> </p>
                                <?php } else { ?>
                                <p class="text" style="margin-bottom: 0px"><?php echo $row['name']; ?> <span
                                        class="badge float-right badge-success">

                                        <?php echo $obj->countryNumber($row['name']) . ' Coins'; ?></span> </p>
                                <?php } ?>
                                <a href="countryPremium.php?code=<?php echo $row['name']; ?>" class="">See All</a>

                            </div>
                        </div>


                        <?php } ?>
                        <?php } ?>
                    </div>


                </div>

            </div>
        </div>
    </section>


    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/pagination.js"></script>
    <script src="../js/wow.js"></script>
    <script>
    new WOW().init();
    </script>
    <script>
    $('#demo').pagination({
        dataSource: [1, 2, 3, 4, 5, 6, 7, ...195],
        callback: function(data, pagination) {
            // template method of yourself
            var html = template(data);
            dataContainer.html(html);
        }
    })
    </script>
</body>

</html>