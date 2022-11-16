<?php

include '../class/database.php';
class timeStamp extends database
{
    protected $link;
    public function timeFunction()
    {

        $name = $_GET['name'];
        $sql = "Select * from emperor where period_name = '$name'";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function coinNumber($emp)
    {
        $sql = "Select * from data_tbl where timeperiod = '$emp'";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            $total = mysqli_num_rows($res);
            return $total;
        } else {
            return 0;
        }

        # code...
    }
}
$obj = new timeStamp;
$objTime = $obj->timeFunction();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="standard_page.php">Home <span class="sr-only">(current)</span></a>
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


                <h1><?php echo $row['emperor']; ?></h1>
                <a href="standard_page_data.php?name=<?php echo $row['emperor']; ?>" class="btn btn-info">Search <span
                        class="badge ml-2 badge-light">
                        <?php echo $obj->coinNumber($row['emperor']) . ' Coins'; ?></span>
                </a>

            </div>
        </div>
        <?php } ?>

        <?php } ?>
    </section>

    <section>

    </section>



    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>