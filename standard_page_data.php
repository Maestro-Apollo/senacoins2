<?php
session_start();
include '../account/standard.php';
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}

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
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Document</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href="../css/style.css">
    <style type="text/css" media="print">
    body {
        display: none;
        visibility: hidden;
    }
    </style>
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

    <!-- <link rel="stylesheet" href=" https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css ">
    <style>
    div.container {
        max-width: 1200px
    }
    </style> -->
    <!-- <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css "> -->

</head>

<body onselectstart='return false;'>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-light" href="#"><?php echo $_SESSION['name']; ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
                                href="countries_standard.php?code=<?php echo $rowCon['code']; ?>"><?php echo $rowCon['name']; ?></a>
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

    <div class="text-center p-3">
        <p class="lead pt-3 pb-3">Check out all the data!</p>
    </div>
    <div class="container">
        <table class="display compact table-responsive" style="width:100%" id="myTable">
            <thead>
                <tr>
                    <div class="text-light">
                        <th scope="col">CODICE CATALOGO</th>
                        <th scope="col">Type Of Coin</th>
                        <th scope="col">Year</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Sub-Category</th>
                        <th scope="col">Reference</th>
                    </div>
                </tr>
            </thead>
            <tbody>
                <?php if ($objsUser) { ?>
                <?php while ($row = mysqli_fetch_assoc($objsUser)) { ?>
                <tr>
                    <th scope="row"><?php echo $row['cod_cat']; ?></th>
                    <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="coinimg.php?id=<?php echo $row['id']; ?>"><img
                                src="../coin_img/<?php echo $row['image']; ?>" alt="">
                        </a></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['sub_category']; ?></td>
                    <td><?php echo $row['reference']; ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <p>No Data</p>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>


<script src="../js/jquery-3.3.1.min.js">
</script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src=" //cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js "></script>
<!-- <script src=" https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js "></script> -->
<!-- <script src=" https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js "></script> -->
<!-- <script src=" https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js "></script> -->
<script>
$(document).ready(function() {
    $('#myTable').DataTable();

});
</script>


</html>