<?php
//error_reporting(E_ALL);

session_start();
include '../account/standard.php';
//$connect = mysqli_connect("localhost:3306", "minterro_admin", "VAy~Hgq6XueY", "minterro_demo");
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
//die('working');
$name = $_GET['name'];
$query = "select * from data_tbl where timeperiod = '$name' LIMIT $start_from, $record_per_page";
//$query = "SELECT * FROM wp_options order by option_id DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($connect, $query);

?>
<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minterrordatabase.com</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>

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


    table#empTable img {
        width: 150px;
    }

    table#empTable {
        margin: 0px auto !important;
        padding: 0px !important;
    }

    .table-responsive {
        /* min-height: .01%;
    overflow-x: initial; */
    }

    ul.navbar-nav.ml-auto.mt-2.mt-lg-0 {
        float: right;
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
    <nav class="navbar navbar-expand-sm navbar-dark bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#"><?php echo $_SESSION['name']; ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="standard_page.php">Home <span class="sr-only">(current)</span></a>
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


    <div class="container-fluid">
        <div class="table-responsive table-striped table-hover table-condensed container-fluid">

            <table class="display dataTable container-fluid" style="" id="empTable">
                <thead>
                    <tr>
                        <div class="text-light">
                            <th scope="col">CODE</th>
                            <th scope="col">Reference - Riferimento</th>
                            <th scope="col">Image - Immagine</th>
                            <th scope="col">Type Of Coin - Tipo di moneta</th>
                            <th scope="col">Year - Anno</th>
                            <th scope="col">Description - Descrizione</th>
                            <th scope="col">Category - Categoria</th>
                            <th scope="col">Sub-Category - Sub-Categoria</th>
                            <th scope="col">Date</th>
                        </div>
                    </tr>
                </thead>


            </table>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#empTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            responsive: true,

            'ajax': {
                'url': 'ajaxfile.php',
                "data": {
                    "user": '<?php echo $name; ?>'
                }

            },
            'columns': [{
                    data: 'cod_cat'
                },
                {
                    data: 'reference'
                },
                {
                    data: 'image'
                },
                {
                    data: 'type_of_coin'
                },
                {
                    data: 'year'
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
                    data: 'created'
                },


            ]


        });
    });

    // #myInput is a <input type="text"> element
    </script>
    <script>
    document.addEventListener("contextmenu", function(prevent) {
        prevent.preventDefault();
    })
    </script>

    <script>
    const images = document.querySelectorAll("[data-src]");

    function preloadImage(img) {

        const src = img.getAttribute("data-src");
        if (!src) {
            return;
        }
        img.src = src;

    }

    const imgOptions = {
        rootMargin: '0px',

    };

    const imgObserver = new IntersectionObserver((entries, imgObserver) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                preloadImage(entry.target);
                imgObserver.unobserve(entry.target);
                const lazyImage = entry.target
                lazyImage.src = lazyImage.dataset.src
            }
        })
    }, imgOptions);

    images.forEach(image => {
        imgObserver.observe(image);
    })
    </script>

    <br /><br />
</body>

</html>