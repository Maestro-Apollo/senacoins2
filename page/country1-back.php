<?php
error_reporting(0);

include '../class/database.php';
class timeStamp extends database
{
    protected $link;
    public function timeFunction()
    {

        $code = $_GET['code'];
        $sql = "Select * from time_select where country = '$code'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function numberTimeFunction()
    {
        $sql = "SELECT count(*) as total from data_tbl where timeperiod = 'REPUBBLICA ITALIANA' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res)) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function numberTimeFunction2()
    {
        $sql = "SELECT count(*) as total from data_tbl where timeperiod = 'UNIONE EUROPEA' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res)) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new timeStamp;
$objTime = $obj->timeFunction();
$objNumber = $obj->numberTimeFunction();
$objNumber2 = $obj->numberTimeFunction2();
$rowNum = mysqli_fetch_assoc($objNumber);
$rowNum2 = mysqli_fetch_assoc($objNumber2);


?>
<?php

class timeSelete extends database
{
    protected $link;
    public function timeFunction()
    {

        $code1 = $_GET['code'];
        $sql1 = "Select * from time_select_2 where country = '$code1'";
        $res1 = mysqli_query($this->link, $sql1);
        if (mysqli_num_rows($res1) > 0) {
            return $res1;
        } else {
            return false;
        }
        # code...
    }
    public function numberFun($emp)
    {
        $sql = "select * from emperor where period_name = '$emp' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res)) {
            $tol = 0;
            while ($row = mysqli_fetch_assoc($res)) {
                $name = $row['emperor'];
                $sql2 = "select * from data_tbl where timeperiod = '$name' ";
                $res2 = mysqli_query($this->link, $sql2);
                $total = mysqli_num_rows($res2);
                $tol += $total;
            }
            return $tol;
        } else {
            return 0;
        }


        # code...
    }
}
$obj1 = new timeSelete;
$objTime1 = $obj1->timeFunction();


?>
<?php

class timeSelete3 extends database
{
    protected $link;
    public function timeFunction()
    {

        $code3 = $_GET['code'];
        $sql3 = "Select * from time_select_3 where country = '$code3'";
        $res3 = mysqli_query($this->link, $sql3);
        if (mysqli_num_rows($res3) > 0) {
            return $res3;
        } else {
            return false;
        }
        # code...
    }
}
$obj3 = new timeSelete3;
$objTime3 = $obj3->timeFunction();


?>
<?php

class timeOther extends database
{
    protected $link;
    public function timeFunction()
    {

        $codeOther = $_GET['code'];
        if (strcmp($codeOther, 'Italy') != 0) {
            $sqlOther = "Select * from data_tbl where code = '$codeOther'";
            $resOther = mysqli_query($this->link, $sqlOther);
            if (mysqli_num_rows($resOther) > 0) {
                return $resOther;
            } else {
                return false;
            }
        } else {
            return false;
        }

        # code...
    }
}
$objOth = new timeOther;
$objTimeOther = $objOth->timeFunction();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css ">
    <link rel="stylesheet" href="../css/style.css">
    <style>
    body,
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

<body style="">

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
                    <li class="nav-item active">
                        <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <section>
        <?php if ($objTime) { ?>
        <?php while ($row = mysqli_fetch_assoc($objTime)) { ?>
        <div class="jumbotron text-center">
            <div class="container">


                <h1 style="text-transform: uppercase"><?php echo $row['period_name']; ?></h1>
                <a href="show.php?name=<?php echo $row['period_name']; ?>"
                    class="btn btn-info"><?php echo $row['time']; ?><span class="badge ml-2 badge-light">
                        <?php echo $rowNum['total'] . ' Coins'; ?></span></a>

            </div>
        </div>
        <?php } ?>

        <?php } ?>
    </section>
    <section>
        <?php if ($objTime1) { ?>
        <?php while ($row = mysqli_fetch_assoc($objTime1)) { ?>
        <div class="jumbotron text-center">
            <div class="container">


                <h1 style="text-transform: uppercase"><?php echo $row['period_name']; ?></h1>
                <a href="country_middle.php?name=<?php echo $row['period_name']; ?>"
                    class="btn btn-info"><?php echo $row['time']; ?><span class="badge ml-2 badge-light">
                        <?php echo $obj1->numberFun($row['period_name']) . ' Coins'; ?></span> </a>

            </div>
        </div>
        <?php } ?>

        <?php } ?>
    </section>
    <section>
        <?php if ($objTime3) { ?>
        <?php while ($row = mysqli_fetch_assoc($objTime3)) { ?>
        <div class="jumbotron text-center">
            <div class="container">


                <h1 style="text-transform: uppercase"><?php echo $row['period_name']; ?></h1>
                <a href="show.php?name=<?php echo $row['period_name']; ?>"
                    class="btn btn-info"><?php echo $row['time']; ?><span class="badge ml-2 badge-light">
                        <?php echo $rowNum2['total'] . ' Coins'; ?></span></a>


            </div>
        </div>
        <?php } ?>

        <?php } ?>
    </section>

    <section>
        <?php if ($objTimeOther) { ?>

        <div class="text-center p-3">
            <p class="lead pt-3 pb-3">Check out all the data!</p>
        </div>
        <div class="p-3">
            <table class="display compact table-responsive" style="width:100%" id="myTable">
                <thead>
                    <tr>
                        <div class="text-light">
                            <th scope="col">CODE</th>
                            <th scope="col">Type Of Coin</th>
                            <th scope="col">Year</th>
                            <th scope="col">Description</th>
                            <th scope="col">Emperor</th>
                            <th scope="col" class="text-center">Image</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub-Category</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Action</th>
                        </div>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($objTimeOther)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['cod_cat']; ?></th>
                        <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['description']; ?></td>

                        <td scope="row"><?php echo $row['timeperiod']; ?></td>
                        <td class="text-center">
                            <a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img
                                    src="../coin_img/<?php echo $row['image']; ?>" style="width: 100%" alt=""
                                    onerror='this.style.display = "none"'>
                            </a>
                        </td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td class="span2">
                            <a target="__blank" href="admin_update.php?id=<?php echo urlencode($row['id']); ?>"
                                class="btn btn-success btn-block">View</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger btn-block">Delete</a>
                            <a href="coinswitch.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-info btn-block">Switch</a>
                        </td>
                    </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>
        <?php } ?>

    </section>




    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src=" //cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js "></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.21/sorting/natural.js"></script>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [-1],
                ['Show all']
            ],
            buttons: [
                'pdf', 'csv', 'pageLength'
            ],
            columnDefs: [{
                type: 'natural-nohtml',
                targets: 1
            }],
            order: [
                [1, 'asc']
            ]
        });
    });
    </script>

</body>

</html>