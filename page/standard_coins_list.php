<?php
session_start();
if ($_SESSION['name']) {
} else {
    header('location:../index.php');
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
    <title>Minterrordatabase.com - Standard DB list</title>

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
        <div class="text-center pt-4">
            <h5 class="text-light">In questa sezione puoi effettuare una ricerca globale. Utilizza le parole chiave
                presenti nel Manuale Sena Coins per usufruire del motore di ricerca al massimo delle sue potenzialità.
            </h5>
            <h5 class="text-light">In this section you can perform a global search. Use the keywords in the Sena Coins
                Handbook to exploit the search engine to its full potential.</h5>
        </div>
        <div class="bg-white p-4 table-responsive">
            <table id='userTable' class='display dataTable table-bordered' width='100%'>
                <thead>
                    <tr>
                        <th>Type of coin - Tipo di moneta</th>
                        <th>Images - Immagini</th>
                        <th>Year - Anno</th>
                        <th>Country - Paese</th>
                        <th>Historical period - Periodo storico</th>
                        <th>Description - Descrizione</th>
                        <th>Category - Categoria</th>
                        <th>Sub-Category - Sub-categoria</th>
                        <th>Reference - Riferimento</th>
                        <th>Date</th>
                    </tr>
                </thead>

            </table>
        </div>
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
$(document).ready(function() {
    var userDataTable = $('#userTable').DataTable({
        'processing': true,
        'serverSide': true,
        responsive: true,

        'serverMethod': 'post',
        'ajax': {
            'url': 'ajaxCoinStandard.php'
        },
        'columns': [{
                data: 'type_of_coin'
            },
            {
                data: 'img'
            },
            {
                data: 'year'
            },
            {
                data: 'code'
            },
            {
                data: 'timeperiod'
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
                data: 'reference'
            },
            {
                data: 'created'
            },






        ]
    });
});
</script>
<script>
document.addEventListener("contextmenu", function(prevent) {
    prevent.preventDefault();
})
</script>


</html>