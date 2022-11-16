<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:index.php');
}
include('../class/database.php');
class code extends database
{
    protected $link;
    public function codeFunction()
    {
        $sql = "SELECT * from data_record INNER JOIN data_tbl on data_record.item_id = data_tbl.id WHERE created_at > DATE_SUB( NOW(), INTERVAL 7 DAY) order by data_record.record_id desc";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...

    }
    public function timeFunction()
    {
        $sql2 = "Select NOW() as time";
        $res2 = mysqli_query($this->link, $sql2);
        return $res2;
        # code...
    }
}
$obj = new code;
$objCode = $obj->codeFunction();
$objTime = $obj->timeFunction();
$rowTime = mysqli_fetch_assoc($objTime);
// echo $rowTime['time'];
?>
<!doctype html>
<html lang="en" class="h-100">

<head style="background-color: #1c1d26">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Latest coins - Ultime notizie</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css
">
    <style>
    h1,
    h3,
    p,
    a,
    span,
    button,
    th,
    td {
        font-family: 'Roboto', sans-serif;
    }

    table#example img {
        width: 150px;
    }

    .table-responsive {
        display: table !important;
    }
    </style>



</head>

<body class="d-flex flex-column h-100 bg-white">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Nuove monete - 24h News</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="javascript:history.back()">Home <span
                                    class="sr-only">(current)</span></a>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>

    </header>

    <!-- Begin page content -->

    <section>

        <div class="p-3">
            <table id="example" class="display compact table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Riferimento - Reference</th>
                        <th>Immagini - Images</th>
                        <th>Descrizione - Description</th>
                        <th>Tipo di moneta - Type of coin</th>
                        <th>Anno - Year</th>
                        <th>Nazione - Country</th>
                        <th>Categoria - Category</th>
                        <th>Sotto categoria - Sub-category</th>
                        <th>Periodo - Period</th>
                        <th>Approvata - Approved</th>



                    </tr>
                </thead>
                <tbody>
                    <?php if ($objCode) { ?>
                    <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($objCode)) {
                        ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td>
                            <a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img class="img-fluid"
                                    src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
                                    onerror='this.style.display = "none"'>
                            </a>
                        </td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['type_of_coin']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['code']; ?></td>

                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td>
                            <?php echo $row['timeperiod']; ?>
                        </td>

                        <td><?php $t1 = strtotime($rowTime['time']);
                                    $t2 = strtotime($row['created_at']);
                                    $resTime = $t1 - $t2;
                                    echo (gmdate("d", $resTime) - 1) . 'd ' . gmdate("H", $resTime) . 'h ' . gmdate("i", $resTime) . 'm ago';
                                    ?>
                        </td>




                    </tr>
                    <?php } ?>

                    <?php } ?>


                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Reference</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Type of Coin</th>
                        <th>Year</th>
                        <th>Country</th>
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>Period</th>
                        <th>Approvata - Approved</th>



                    </tr>
                </tfoot>
            </table>
        </div>

    </section>







</body>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js
"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>






</html>