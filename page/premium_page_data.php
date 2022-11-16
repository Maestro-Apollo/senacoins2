<?php
error_reporting(0);

session_start();
include '../account/premimum.php';


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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css ">
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
    <!-- <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css "> -->
</head>

<body onselectstart='return false;'>
    <nav class="navbar navbar-expand-sm navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand text-light display-4" href="#"><?php echo $_SESSION['name']; ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Continents
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">

                            <?php if ($objCon) { ?>
                            <?php while ($rowCon = mysqli_fetch_assoc($objCon)) { ?>
                            <a class="dropdown-item text-dark bg-dark"
                                href="countries_premium.php?code=<?php echo $rowCon['code']; ?>"><?php echo $rowCon['name']; ?></a>
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

    <div class="p-3">

        <table class=" display compact table-responsive" style="width:100%" id="myTable">
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
                </tr>
            </thead>
            <tbody>

                <?php while ($row = mysqli_fetch_assoc($objpUser)) { ?>
                <tr>
                    <th scope="row"><?php echo $row['cod_cat']; ?></th>
                    <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img style="width: 100%;"
                                src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
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
                </tr>
            </thead>
            <tbody>

                <?php while ($row = mysqli_fetch_assoc($objpUserR)) { ?>
                <tr>
                    <th scope="row"><?php echo $row['cod_cat']; ?></th>
                    <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img style="width: 100%;"
                                data-src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
                                onerror='this.style.display = "none"'>
                        </a></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['sub_category']; ?></td>
                    <td><?php echo $row['rarity']; ?></td>
                    <td><?php echo $row['reference']; ?></td>
                    <td><?php echo $row['bb']; ?></td>
                    <td><?php echo $row['spl']; ?></td>
                    <td><?php echo $row['fdc']; ?></td>
                    <td><?php echo $row['ecz']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>

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
                </tr>
            </thead>
            <tbody>

                <?php while ($row = mysqli_fetch_assoc($objpUserE)) { ?>
                <tr>
                    <th scope="row"><?php echo $row['cod_cat']; ?></th>
                    <td scope="row"><?php echo $row['type_of_coin']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><a target="__blank" href="coinimg.php?id=<?php echo $row['id']; ?>"><img style="width: 100%;"
                                data-src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
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
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>

        </table>
    </div>
</body>


<script src="../js/jquery-3.3.1.min.js">
</script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src=" //cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js "></script>
<script src="//cdn.datatables.net/plug-ins/1.10.21/sorting/natural.js"></script>

<!-- <script src=" https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js "></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
<script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js "></script> -->
<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
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
    threshold: 0,
    rootMargin: "0px 0px 200px 0px"
};

const imgObserver = new IntersectionObserver((entries, imgObserver) => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            return;
        } else {
            preloadImage(entry.target);
            imgObserver.unobserve(entry.target);
        }
    })
}, imgOptions);

images.forEach(image => {
    imgObserver.observe(image);
})
</script>

</html>