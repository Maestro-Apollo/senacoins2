<?php

session_start();
include('../class/database.php');
class submission extends database
{
    protected $link;
    public function subFunction()
    {
        if (isset($_POST['submit'])) {
            $user = $_SESSION['name'];
            $type_of_coin = $_POST['type_of_coin'];
            $year = $_POST['year'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $sub_category = $_POST['sub_category'];
            $reference = $_POST['reference'];
            $continent = $_POST['continent'];
            $country = $_POST['country'];
            $his_period = $_POST['his_period'];
            $mb = $_POST['mb'];
            $bb = $_POST['bb'];
            $fdc = $_POST['fdc'];
            $spl = $_POST['spl'];
            $ecz = $_POST['ecz'];
            $rarity = $_POST['rarity'];
            $today = date("F j, Y, g:i a");


            $img = time() . '_' . $_FILES['image']['name'];
            $img2 = time() . '_' . $_FILES['image2']['name'];
            $img3 = time() . '_' . $_FILES['image3']['name'];
            $img4 = time() . '_' . $_FILES['image4']['name'];
            $img5 = time() . '_' . $_FILES['image5']['name'];
            // $video =  basename($_FILES['video']['name']);
            $target = '../coin_img/' . $img;
            $target2 = '../coin_img/' . $img2;
            $target3 = '../coin_img/' . $img3;
            $target4 = '../coin_img/' . $img4;
            $target5 = '../coin_img/' . $img5;
            // $targetV = '../videos/' . $video;



            if (strcmp($his_period, 'UNIONE EUROPEA') == 0) {
                $sql = "INSERT INTO `data_tbl` (`id`, `cod_cat`, `type_of_coin`, `year`, `description`, `category`, `sub_category`, `rarity`, `reference`, `mb`, `bb`, `spl`, `fdc`, `ecz`, `timeperiod`, `code`, `image`, `image2`, `image3`, `image4`, `image5`, `user`,`created`) VALUES (NULL, NULL, '$type_of_coin', '$year', '$description', '$category', '$sub_category', '$rarity', '$reference', '$bb', '$spl', '$fdc', '$ecz', '', '$his_period', '$country', '$img', '$img2', '$img3', '$img4', '$img5', '$user','$today')";
            } else {
                $sql = "INSERT INTO `data_tbl` (`id`, `cod_cat`, `type_of_coin`, `year`, `description`, `category`, `sub_category`, `rarity`, `reference`, `mb`, `bb`, `spl`, `fdc`, `ecz`, `timeperiod`, `code`, `image`, `image2`, `image3`, `image4`, `image5`, `user`,`created`) VALUES (NULL, NULL, '$type_of_coin', '$year', '$description', '$category', '$sub_category', '$rarity', '$reference', '$mb', '$bb', '$spl', '$fdc', '$ecz', '$his_period', '$country', '$img', '$img2', '$img3', '$img4', '$img5', '$user','$today')";
            }




            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                move_uploaded_file($_FILES['image2']['tmp_name'], $target2);
                move_uploaded_file($_FILES['image3']['tmp_name'], $target3);
                move_uploaded_file($_FILES['image4']['tmp_name'], $target4);
                move_uploaded_file($_FILES['image5']['tmp_name'], $target5);


                $sqlFind = "select * from data_tbl where type_of_coin = '$type_of_coin' AND category = '$category' AND sub_category = '$sub_category' AND timeperiod = '$his_period' AND user = '$user' AND image = '$img'  ";
                $resFind = mysqli_query($this->link, $sqlFind);
                $rowFind = mysqli_fetch_assoc($resFind);

                $item_id = $rowFind['id'];


                $sqlRecord = "INSERT INTO `data_record` (`record_id`, `item_id`, `created_at`) VALUES (NULL, '$item_id', CURRENT_TIMESTAMP)";
                mysqli_query($this->link, $sqlRecord);

                $sqlC = "INSERT INTO `coin_data` (`id`, `image`, `image1`, `image2`, `image3`, `image4`, `video`, `item_id`, `description`) VALUES (NULL, '$img', '$img2', '$img3', '$img4', '$img5', '', '$item_id', '$description')";
                $resC = mysqli_query($this->link, $sqlC);
                if ($resC) {
                } else {
                    return false;
                }

                // move_uploaded_file($_FILES['video']['tmp_name'], $targetV);


                $msg = "Thanks for sharing your information!";
                return $msg;
                header('location:admin_submit.php');
            } else {
                echo "Not Added";
                return false;
            }
        }
        # code...
    }
}
$obj = new submission;
$objSub = $obj->subFunction();

?>
<?php
header('Content-Type: text/html; charset=utf-8');
?>

<?php

class continent extends database
{
    protected $link;
    public function continentFunction()
    {

        $sqlC = "Select * from continents";
        $resC = mysqli_query($this->link, $sqlC);
        if (mysqli_num_rows($resC) > 0) {
            return $resC;
        } else {
            return false;
        }
        # code...
    }
}
$ObjC = new continent;
$ObjCon = $ObjC->continentFunction();

?>
<?php

class countries extends database
{
    protected $link;
    public function countryFunction()
    {

        $sqlCn = "Select * from countries";
        $resCn = mysqli_query($this->link, $sqlCn);
        if (mysqli_num_rows($resCn) > 0) {
            return $resCn;
        } else {
            return false;
        }
        # code...
    }
}
$ObjCn = new countries;
$ObjCnu = $ObjCn->countryFunction();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="gb18030">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Minterrordatabase.com</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/parsley.css">
    <link rel="icon" href="../images/source file1.png" type="image/gif" sizes="16x16">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">
    <link rel="stylesheet" href="../css/animate.css">


    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>


    <!-- Custom styles for this template -->
    <link href="../css/form-validation.css" rel="stylesheet">

    <!-- <script>
    $(document).ready(function() {

        $('#continent').on('change', function() {
            var continentID = $(this).val();
            if (continentID) {
                $.get(
                    "ajax.php", {
                        continent: continentID
                    },
                    function(data) {

                        $('#country').html(data);

                    }
                );
            } else {

                $('#country').html(' <option> Select Continent First </option>')

            }
        })

    });
    </script> -->
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


<body class="text-light">


    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand text-light" href="../index.php">Pannello di controllo</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>


    <div class="container">
        <div class="py-5 text-center">

            <h2 class="wow fadeIn">Amministratore</h2>
            <p class="lead wow fadeIn">Sono al tuo servizio</p>
        </div>

        <?php if ($objSub) { ?>
        <div class="alert alert-success text-center">
            <span><?php echo $objSub; ?></span>
        </div>
        <?php } ?>

        <div class="row">

            <div class="col-md-12 order-md-1 wow fadeInUp">
                <h4 class="mb-3">Descrizione della moneta</h4>
                <form method="post" enctype="multipart/form-data" data-parsley-validate>

                    <div class="row">
                        <div class="col-md-6 ">
                            <label for="continent">Continente</label>
                            <select name="continent" id="" class="form-control" required>

                                <?php if ($ObjCon) { ?>
                                <?php while ($row = mysqli_fetch_assoc($ObjCon)) { ?>

                                <?php if (strcmp($row['name'], 'Europe') == 0) { ?>
                                <option value="<?php echo $row['name']; ?>" selected><?php echo $row['name']; ?>
                                </option>

                                <?php } else { ?>

                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>

                                <?php } ?>

                                <?php } ?>

                            </select>


                        </div>
                        <div class="col-md-6 ">
                            <label for="countries">Stato</label>

                            <select name="country" id="countries" class="form-control" required>
                                <?php if ($ObjCnu) { ?>
                                <?php while ($row = mysqli_fetch_assoc($ObjCnu)) { ?>

                                <?php if (strcmp($row['name'], 'Italy') == 0) { ?>

                                <option value="<?php echo $row['name']; ?>" selected><?php echo $row['name']; ?>
                                </option>
                                <?php } else { ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?>
                                </option>
                                <?php } ?>




                                <?php } ?>

                                <?php } ?>
                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pt-4 pb-4">
                            <label for="">Periodo storico</label>

                            <input type="text" name="his_period" placeholder="" class="form-control">
                        </div>
                        <div class="col-md-6 pt-4 pb-4">
                            <label for="Reference">Riferimento</label>
                            <input type="text" name="reference" class="form-control" id="Reference" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                This value is required.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type_of_coin">Tipo di moneta</label>
                            <input type="text" name="type_of_coin" class="form-control" id="type_of_coin" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid Type of Coin is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year">Anno</label>
                            <input type="text" name="year" class="form-control" id="year" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                Valid Year is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="Category">Categoria</label>
                            <input type="text" name="category" class="form-control" id="Category" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid Category is required.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="Sub-Category">Sub-Categoria</label>
                            <input type="text" name="sub_category" class="form-control" id="Sub-Category" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid Sub-Category is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="MB">MB</label>
                            <input type="text" name="mb" class="form-control" id="MB" placeholder="" value="">
                            <div class="invalid-feedback">
                                Valid MB is required.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="BB">BB</label>
                            <input type="text" name="bb" class="form-control" id="BB" placeholder="" value="">
                            <div class="invalid-feedback">
                                Valid BB is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="SPL">SPL</label>
                            <input type="text" name="spl" class="form-control" id="SPL" placeholder="" value="">
                            <div class="invalid-feedback">
                                Valid SPL is required.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="FDC">FDC</label>
                            <input type="text" name="fdc" class="form-control" id="FDC" placeholder="" value="">
                            <div class="invalid-feedback">
                                Valid FDC is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ECZ">ECZ</label>
                            <input type="text" name="ecz" class="form-control" id="ECZ" placeholder="" value="">
                            <div class="invalid-feedback">
                                Valid SPL is required.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="Rarity">Rarity</label>
                            <input type="text" name="rarity" class="form-control" id="Rarity" placeholder="" value="">
                            <div class="invalid-feedback">
                                Valid SPL is required.
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">

                        <div class="col-md-12 mb-3">
                            <label for="description" class="text-center">Descrizione</label>
                            <textarea type="text" name="description" class="form-control" id="description" cols="30"
                                rows="3" placeholder="" value="" required></textarea>
                            <div class="invalid-feedback">
                                Valid Description is required.
                            </div>
                        </div>




                        <!-- <div class="col-md-6 mb-3">
                <label for="Rarity">Rarity</label>
                <input type="text" name="rarity" class="form-control" id="Rarity" placeholder="" value=""
                    required>
                <div class="invalid-feedback">
                    Valid Rarity is required.
                </div>
            </div> -->
                    </div>
                    <div class="row">

                        <div class="col-md-6 pb-3">
                            <div class="row">
                                <div class="col-md-6">

                                    <label for="" class="mt-4 mb-2">Immagine obbligatoria</label>
                                    <input name="image" type="file" class="form-control-file mb-3"
                                        id="exampleFormControlFile1" required>
                                </div>
                                <!-- <div class="col-md-6">
                        <label for="" class="mt-4 mb-2">Upload Video <span
                                class="text-muted">(Optional)</span> </label>
                        <input name="video" size="20" type="file" class="form-control-file mb-3"
                            id="exampleFormControlFile1">
                    </div> -->
                            </div>
                        </div>

                        <!-- <div class="col-md-6 mb-3">
                <label for="BB">BB</label>
                <input type="text" name="bb" class="form-control" id="BB" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid BB is required.
                </div>
            </div> -->
                    </div>
                    <!-- <div class="row">
            <div class="col-md-6 mb-3">
                <label for="SPL">SPL</label>
                <input type="text" name="spl" class="form-control" id="SPL" placeholder="" value=""
                    required>
                <div class="invalid-feedback">
                    Valid SPL is required.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="FDC">FDC</label>
                <input type="text" name="fdc" class="form-control" id="FDC" placeholder="" value=""
                    required>
                <div class="invalid-feedback">
                    Valid FDC is required.
                </div>
            </div>
        </div> -->
                    <!-- <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ECZ">ECZ</label>
                <input type="text" class="form-control" id="ECZ" placeholder="" value="" name="ecz"
                    required>
                <div class="invalid-feedback">
                    Valid ECZ is required.
                </div>
            </div>

            <div class="form-group pt-2 pl-2">
                <label for="exampleFormControlFile1">Upload Image</label>
                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

        </div> -->
                    <div class="form-group pt-2 ">


                        <label for="exampleFormControlFile1">Carica altre immagini</label>

                        <div class="d-flex">

                            <input name="image2" type="file" class="form-control-file" id="exampleFormControlFile1">
                            <input name="image3" type="file" class="form-control-file" id="exampleFormControlFile1">
                            <input name="image4" type="file" class="form-control-file" id="exampleFormControlFile1">
                            <input name="image5" type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Confermi le informazioni che hai inserito?
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>


                    <hr class="mb-4">


                    <button name="submit" class="btn btn-danger btn-lg btn-block mb-5" type="submit">Conferma</button>
                </form>
            </div>
        </div>

    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>

    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/parsley.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {

        $('continents').on('change', function() {

            var code = $(this).val();
            if (code) {
                $.ajax({
                    type: 'POST',
                    url: 'ajaxData.php',
                    data: 'code=' + code,
                    success: function(html) {
                        $('#countries').html(html);
                    }
                });
            } else {
                $('#countries').html('<option>Select Continent First</option>');

            }

        })

    });
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script>
    window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.4/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous">
    </script>
    <script>
    function isFileImage(file) {
        const acceptedImageTypes = ['image/gif', 'image/jpg', 'image/jpeg', 'image/png'];

        return file && acceptedImageTypes.includes(file['type'])
    }
    </script>
    <script src="../js/wow.js"></script>
    <script>
    new WOW().init();
    </script>
    <!-- <script src="form-validation.js"></script> -->


</body>

</html>