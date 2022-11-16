<?php
// Turn off error reporting
error_reporting(0);

session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}

include '../class/database.php';
$name = $_GET['name'];

if (strcmp($name, 'REPUBBLICA ITALIANA') == 0) {
    class premiumR extends database
    {

        protected $link;

        public function pUserfunction()
        {
            $name = $_GET['name'];
            $sqlR = "select * from data_tbl where timeperiod = '$name' ";
            $resR = mysqli_query($this->link, $sqlR);
            if ($resR) {
                return $resR;
            } else {
                return false;
            }
            # code...
        }
    }
    $objR = new premiumR;
    $objpUserR = $objR->pUserfunction();
} else if (strcmp($name, 'UNIONE EUROPEA') == 0) {

    class premiumE extends database
    {

        protected $link;

        public function pUserfunction()
        {
            $name = $_GET['name'];
            $sqlE = "select * from data_tbl where timeperiod = '$name' ";
            $resE = mysqli_query($this->link, $sqlE);
            if ($resE) {
                return $resE;
            } else {
                return false;
            }
            # code...
        }
    }
    $objE = new premiumE;
    $objpUserE = $objE->pUserfunction();
} else {
    class premium extends database
    {

        protected $link;

        public function pUserfunction()
        {
            $name = $_GET['name'];
            $sql = "select * from data_tbl where timeperiod = '$name' ";
            $res = mysqli_query($this->link, $sql);
            if ($res) {
                return $res;
            } else {
                return false;
            }
            # code...
        }
    }
    $obj = new premium;
    $objpUser = $obj->pUserfunction();
}


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
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css ">
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

<body>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-light" href="admin.php">Sena Coins</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="admin.php">Admin Panel <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <section>

        <div class="p-3">

            <table class="display compact table-responsive" id="myTable">
                <?php if ($objpUserE) { ?>
                <thead>
                    <tr>
                        <th scope="col">CODE</th>
                        <th scope="col">Type Of Coin</th>
                        <th scope="col">Year</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
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

                    <?php while ($row = mysqli_fetch_assoc($objpUserE)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['cod_cat']; ?></th>
                        <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img
                                    style="width: 100%;" src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
                                    onerror='this.style.display = "none"'>
                            </a></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td><?php echo $row['rarity']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['mb']; ?></td>
                        <td><?php echo $row['bb']; ?></td>
                        <td><?php echo $row['spl']; ?></td>
                        <td><?php echo $row['fdc']; ?></td>
                        <td class="span2">
                            <a href="admin_update.php?id=<?php echo urlencode($row['id']); ?>"
                                class="btn btn-success btn-block">View</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger btn-block">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
                <?php } ?>
                <?php if ($objpUser) { ?>
                <thead>


                    <tr>
                        <th scope="col">CODE</th>
                        <th scope="col">Type Of Coin</th>
                        <th scope="col">Year</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>

                        <th scope="col">Category</th>
                        <th scope="col">Sub-Category</th>
                        <th scope="col">Rarity</th>
                        <th scope="col">Reference</th>
                        <th scope="col">MB</th>
                        <th scope="col">BB</th>
                        <th scope="col">SPL</th>
                        <th scope="col">FDC</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = mysqli_fetch_assoc($objpUser)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['cod_cat']; ?></th>
                        <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['description']; ?></td>

                        <td style="width: 100%">

                            <a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img
                                    style="width: 100%;" src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
                                    onerror='this.style.display = "none"'></a>
                        </td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td><?php echo $row['rarity']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['mb']; ?> </td>
                        <td><?php echo $row['bb']; ?></td>
                        <td><?php echo $row['spl']; ?></td>
                        <td><?php echo $row['fdc']; ?></td>
                        <td class="span2">
                            <a href="admin_update.php?id=<?php echo urlencode($row['id']); ?>"
                                class="btn btn-success btn-block">View</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger btn-block">Delete</a>
                            <a href="coinswitch.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-info btn-block">Switch</a>
                        </td>
                    </tr>
                    <?php } ?>


                </tbody>
                <?php } ?>

                <?php if ($objpUserR) { ?>
                <thead>


                    <tr>
                        <th scope="col">CODE</th>
                        <th scope="col">Type Of Coin</th>
                        <th scope="col">Year</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>

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

                    <?php while ($row = mysqli_fetch_assoc($objpUserR)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['cod_cat']; ?></th>
                        <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['description']; ?></td>

                        <td>

                            <a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img
                                    style="width: 100%;" src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
                                    onerror='this.style.display = "none"'></a>
                        </td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['sub_category']; ?></td>
                        <td><?php echo $row['rarity']; ?></td>
                        <td><?php echo $row['reference']; ?></td>
                        <td><?php echo $row['bb']; ?> </td>
                        <td><?php echo $row['spl']; ?></td>
                        <td><?php echo $row['fdc']; ?></td>
                        <td><?php echo $row['ecz']; ?></td>
                        <td class="span2">
                            <a href="admin_update.php?id=<?php echo urlencode($row['id']); ?>"
                                class="btn btn-success btn-block">View</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger btn-block">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>


                </tbody>
                <?php } ?>



            </table>
        </div>
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
            ]
        });
    });
    </script>

</body>

</html>