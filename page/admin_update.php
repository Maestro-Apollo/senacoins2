<?php
include('../class/database.php');
include('updateCoin.php');
class adminUpdate extends database
{
    protected $link;
    public function UpdateFunction()
    {
        $id = $_GET['id'];
        $sql = "Select * from data_tbl where id = $id";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new adminUpdate;
$objUp = $obj->UpdateFunction();
$row = mysqli_fetch_assoc($objUp);




?>
<?php
header('Content-Type: text/html; charset=utf-8');
?>


<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Checkout example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->



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

<body class="text-light" style="background-color: #1c1d26">
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../images/senacoins3(1).png" alt="" height="200">
            <h2>Update form</h2>
            <p class="lead">Control the mint error coin from here</p>
        </div>

        <?php if ($objSub) { ?>
        <div class="alert alert-success">
            <span>Data Updated</span>
        </div>
        <?php } ?>

        <div class="row">

            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Update</h4>

                <?php if (strcmp($row['timeperiod'], 'UNIONE EUROPEA') != 0) { ?>

                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="type_of_coin">Type of Coin</label>
                            <input type="text" value="<?php echo $row['type_of_coin']; ?>" name="type_of_coin"
                                class="form-control" id="type_of_coin" placeholder="" required>
                            <div class="invalid-feedback">
                                Valid Type of Coin is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year">Year</label>
                            <input type="text" value="<?php echo $row['year']; ?>" name="year" class="form-control"
                                id="year" placeholder="" required>
                            <div class="invalid-feedback">
                                Valid Year is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="year">Code</label>
                            <input type="text" value="<?php echo $row['cod_cat']; ?>" name="code" class="form-control"
                                id="year" placeholder="" required>
                            <div class="invalid-feedback">
                                Valid Year is required.
                            </div>



                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Category">Category</label>
                            <input type="text" name="category" class="form-control" id="Category" placeholder=""
                                value="<?php echo $row['category']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Category is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Sub-Category">Sub-Category</label>
                            <input type="text" name="sub_category" class="form-control" id="Sub-Category" placeholder=""
                                value="<?php echo $row['sub_category']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Sub-Category is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Rarity">Rarity</label>
                            <input type="text" name="rarity" class="form-control" id="Rarity" placeholder=""
                                value="<?php echo $row['rarity']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Rarity is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Reference">Reference</label>
                            <input type="text" name="reference" class="form-control" id="Reference" placeholder=""
                                value="<?php echo $row['reference']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Reference is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="BB">BB</label>
                            <input type="text" name="bb" class="form-control" id="BB" placeholder=""
                                value="<?php echo $row['bb']; ?>" required>
                            <div class="invalid-feedback">
                                Valid BB is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="SPL">SPL</label>
                            <input type="text" name="spl" class="form-control" id="SPL" placeholder=""
                                value="<?php echo $row['spl']; ?>" required>
                            <div class="invalid-feedback">
                                Valid SPL is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="FDC">FDC</label>
                            <input type="text" name="fdc" class="form-control" id="FDC" placeholder=""
                                value="<?php echo $row['fdc']; ?>" required>
                            <div class="invalid-feedback">
                                Valid FDC is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ECZ">ECZ</label>
                            <input type="text" class="form-control" id="ECZ" placeholder=""
                                value="<?php echo $row['ecz']; ?>" name="ecz" required>
                            <div class="invalid-feedback">
                                Valid ECZ is required.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="MB">MB</label>
                            <input type="text" class="form-control" id="MB" placeholder=""
                                value="<?php echo $row['mb']; ?>" name="mb" required>
                            <div class="invalid-feedback">
                                Valid MB is required.
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Insert Image</label>
                                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile2">Insert Image</label>
                                <input name="image2" type="file" class="form-control-file" id="exampleFormControlFile2">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile3">Insert Image</label>
                                <input name="image3" type="file" class="form-control-file" id="exampleFormControlFile3">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile4">Insert Image</label>
                                <input name="image4" type="file" class="form-control-file" id="exampleFormControlFile4">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile5">Insert Image</label>
                                <input name="image5" type="file" class="form-control-file" id="exampleFormControlFile5">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="his_period">Historical Period</label>
                            <input type="text" class="form-control" id="his_period" placeholder=""
                                value="<?php echo $row['timeperiod']; ?>" name="his_period" readonly>
                            <div class="invalid-feedback">
                                Valid Time Period is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control" id="description" cols="30"
                                rows="10" placeholder="" required><?php echo $row['description']; ?></textarea>
                            <div class="invalid-feedback">
                                Valid Description is required.
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <label for="exampleFormControlFileV">Insert Video</label>
                                <input name="video" type="file" class="form-control-file" id="exampleFormControlFileV">
                            </div>
                        </div>
                    </div> -->




                    <hr class="mb-4">


                    <button name="update" class="btn btn-success btn-lg btn-block" type="submit">Update</button>

                </form>
                <?php } else { ?>
                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="type_of_coin">Type of Coin</label>
                            <input type="text" value="<?php echo $row['type_of_coin']; ?>" name="type_of_coin"
                                class="form-control" id="type_of_coin" placeholder="" required>
                            <div class="invalid-feedback">
                                Valid Type of Coin is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year">Year</label>
                            <input type="text" value="<?php echo $row['year']; ?>" name="year" class="form-control"
                                id="year" placeholder="" required>
                            <div class="invalid-feedback">
                                Valid Year is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control" id="description" cols="30"
                                rows="10" placeholder="" required><?php echo $row['description']; ?></textarea>
                            <div class="invalid-feedback">
                                Valid Description is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Category">Category</label>
                            <input type="text" name="category" class="form-control" id="Category" placeholder=""
                                value="<?php echo $row['category']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Category is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Sub-Category">Sub-Category</label>
                            <input type="text" name="sub_category" class="form-control" id="Sub-Category" placeholder=""
                                value="<?php echo $row['sub_category']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Sub-Category is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Rarity">Rarity</label>
                            <input type="text" name="rarity" class="form-control" id="Rarity" placeholder=""
                                value="<?php echo $row['rarity']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Rarity is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Reference">Reference</label>
                            <input type="text" name="reference" class="form-control" id="Reference" placeholder=""
                                value="<?php echo $row['reference']; ?>" required>
                            <div class="invalid-feedback">
                                Valid Reference is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="BB">BB</label>
                            <input type="text" name="bb" class="form-control" id="BB" placeholder=""
                                value="<?php echo $row['mb']; ?>" required>
                            <div class="invalid-feedback">
                                Valid BB is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="SPL">SPL</label>
                            <input type="text" name="spl" class="form-control" id="SPL" placeholder=""
                                value="<?php echo $row['bb']; ?>" required>
                            <div class="invalid-feedback">
                                Valid SPL is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="FDC">FDC</label>
                            <input type="text" name="fdc" class="form-control" id="FDC" placeholder=""
                                value="<?php echo $row['spl']; ?>" required>
                            <div class="invalid-feedback">
                                Valid FDC is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ECZ">ECZ</label>
                            <input type="text" class="form-control" id="ECZ" placeholder=""
                                value="<?php echo $row['fdc']; ?>" name="ecz" required>
                            <div class="invalid-feedback">
                                Valid ECZ is required.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="his_period">Historical Period</label>
                            <input type="text" class="form-control" id="his_period" placeholder=""
                                value="<?php echo $row['timeperiod']; ?>" name="his_period" readonly>
                            <div class="invalid-feedback">
                                Valid Time Period is required.
                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Insert Image</label>
                                <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile2">Insert Image</label>
                                <input name="image2" type="file" class="form-control-file" id="exampleFormControlFile2">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile3">Insert Image</label>
                                <input name="image3" type="file" class="form-control-file" id="exampleFormControlFile3">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile4">Insert Image</label>
                                <input name="image4" type="file" class="form-control-file" id="exampleFormControlFile4">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile5">Insert Image</label>
                                <input name="image5" type="file" class="form-control-file" id="exampleFormControlFile5">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-group">
                                <label for="exampleFormControlFileV">Insert Video</label>
                                <input name="video" type="file" class="form-control-file" id="exampleFormControlFileV">
                            </div>
                        </div>
                    </div> -->




                    <hr class="mb-4">


                    <button name="update" class="btn btn-success btn-lg btn-block" type="submit">Update</button>

                </form>


                <?php } ?>

            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">

        </footer>
    </div>





    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
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
    <script src="form-validation.js"></script>

</body>

</html>