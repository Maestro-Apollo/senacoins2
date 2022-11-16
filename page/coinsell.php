<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
}
include('../class/database.php');
class coinSell extends database
{
    public function showCoin()
    {
        $id = $_GET['id'];
        $sql = "SELECT * from data_tbl where id = $id ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function marketPlace()
    {
        $id = $_GET['id'];
        $username = $_SESSION['name'];
        $sqlFind = "SELECT * from market_tbl where market_coin_id = $id ";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {
            $msg = '<div class="jumbotron jumbotron-fluid bg-info">
            <div class="container">
              <h1 class="display-4 text-white text-center">Coin is already in marketplace</h1>
            </div>
          </div>';
            return $msg;
        } else {
            $sqlFind = "SELECT * from data_tbl where id = $id AND user = '$username' ";
            $resFind = mysqli_query($this->link, $sqlFind);
            if (mysqli_num_rows($resFind) > 0) {
                if (isset($_POST['submit'])) {
                    // $title = addslashes(trim($_POST['title']));
                    $details = addslashes(trim($_POST['details']));
                    $price = addslashes(trim($_POST['price']));
                    $country = addslashes(trim($_POST['country']));
                    $city = addslashes(trim($_POST['city']));
                    $s_price = addslashes(trim($_POST['s_price']));
                    // $address = addslashes(trim($_POST['address']));
                    // $fname = addslashes(trim($_POST['fname']));
                    $email = addslashes(trim($_POST['email']));
                    $phone = addslashes(trim($_POST['phone']));
                    $whatsapp = addslashes(trim($_POST['whatsapp']));

                    $sql = "INSERT INTO `market_tbl` (`market_id`, `title`, `details`, `price`, `remotely`,`city`,`country`,`shipping_price`, `email`, `phone`, `whatsapp`, `username`, `market_coin_id`, `created_at`) VALUES (NULL, '', '$details', '$price', '','$city','$country','$s_price', '$email', '$phone', '$whatsapp', '$username', '$id', CURRENT_TIMESTAMP)";
                    $res = mysqli_query($this->link, $sql);
                    if ($res) {
                        //     $msg = '<div class="jumbotron jumbotron-fluid bg-success">
                        //     <div class="container">
                        //       <h1 class="display-4 text-white text-center">Successfully Added to Market Place</h1>
                        //     </div>
                        //   </div>';
                        //     return $msg;
                        header('location:market-place.php');
                    }
                }
            } else {
                $msg = '<div class="jumbotron jumbotron-fluid bg-danger">
                <div class="container">
                  <h1 class="display-4 text-white text-center">You are not the owner of this coin</h1>
                </div>
              </div>';
                return $msg;
            }
        }
        # code...
    }
}
$obj = new coinSell;
$objSell = $obj->showCoin();
$objInsert = $obj->marketPlace();
$row = mysqli_fetch_assoc($objSell);


?>

<?php
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minterrordatabase.com - </title>

    <link rel="stylesheet" href="../css/fontawesme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">


    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">



    <style>
    body,
    h1,
    h3,
    p,
    a,
    span,
    button {
        font-family: 'Roboto', sans-serif;
    }

    a.dropdown-item.text-dark.bg-dark {
        display: block !important;
    }

    div#exampleModal {
        opacity: 1 !important;
    }

    @media only screen and (max-width: 600px) {
        .p-5 {
            padding: 0rem !important;
        }

        .col-md-12.kami {
            margin: 0px auto !important;
            padding: 0 !important;
        }

        .container-fluid {
            padding: 0px !important;
        }
    }
    </style>

</head>

<body style="background-color: #1c1d26">
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#"><?php echo $_SESSION['name']; ?></a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="javascript:history.back()">Home</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <div class="p-3">
        <?php if ($objInsert) { ?>
        <?php echo $objInsert; ?>
        <?php } else { ?>
        <div class="text-center pt-4">

            <h5 class="text-light font-weight-bold">Provide Information
            </h5>

        </div>
        <form action="" method="post">
            <div class="">
                <div class="row ">
                    <div class="col-md-6 offset-lg-3 mb-3 bg-white p-4">
                        <div class="row">
                            <div class="col-md-4 col-4 offset-lg-4">
                                <div class="text-center mx-auto">
                                    <a target="__blank" class="mx-auto text-center"
                                        href="coinimg.php?id=<?php echo $_GET['id']; ?>"><img
                                            class="img-fluid  d-block text-center"
                                            src="../coin_img/<?php echo $row['image']; ?>" alt="sena coins"
                                            onerror='this.style.display = "none"'>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- <label for="firstName" class="mt-4">Add Title</label>
                        <input type="text" name="title" class="form-control mb-3" id="firstName" placeholder="" value=""
                            required> -->
                        <label for="" class="mt-4">Inserisci informazioni aggiuntive | Add more info</label>
                        <textarea name="details" id="" class="form-control mb-3" cols="30" rows="10"></textarea>
                        <label for="">Prezzo | Price</label>
                        <input type="number" name="price" class="form-control mb-3" id="" required>
                        <h4 class="font-weight-bold">Luogo in cui si trova l'oggetto | Place where the object is located
                        </h4>
                        <label for="">Country | Nazione</label>
                        <input type="text" name="country" class="form-control mb-3" id="" placeholder="Country Name"
                            required>
                        <label for="">Città | City</label>
                        <input type="text" name="city" class="form-control mb-3" id="" placeholder="City Name" required>
                        <label for="">Metodo e prezzo di spedizione | Shipping method and price</label>
                        <input type="text" name="s_price" class="form-control mb-3" id="" required>
                        <h4 class="font-weight-bold">Personal Information</h4>
                        <!-- <label for="">Address</label>
                        <input type="text" name="address" class="form-control mb-3" id=""
                            placeholder="Enter your Address" required> -->
                        <!-- <label for="">First Name</label>
                        <input type="text" name="fname" class="form-control mb-3" id="" placeholder="" required> -->
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control mb-3" id=""
                            placeholder="Enter your email address" required>
                        <label for="">Telefono | Phone</label>
                        <input type="text" name="phone" class="form-control mb-3" id=""
                            placeholder="Enter your phone number" required>
                        <label for="">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control mb-3" id=""
                            placeholder="Enter your WhatsApp number" required>
                        <input type="submit" name="submit" class="btn btn-danger btn-lg" value="Conferma | Confirm">

                    </div>
                </div>
            </div>
        </form>
        <?php } ?>

    </div>








</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="../js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>



<script src="../js/wow.js"></script>
<script>
new WOW().init();
</script>

<script>
document.addEventListener("contextmenu", function(prevent) {
    prevent.preventDefault();
})
</script>


</html>