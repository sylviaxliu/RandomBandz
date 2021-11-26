<?php
session_start();
if (isset($_SESSION['name'])) {
} else {
    header('location:login.php');
}
include('./class/database.php');
class index extends database
{
    public function SongsFunction()
    {
        $name = $_SESSION['name'];
        $sqlFind = "SELECT * from users where `name` = '$name' ";
        $resFind = mysqli_query($this->link, $sqlFind);
        $row = mysqli_fetch_assoc($resFind);
        $user_id = $row['user_id'];
        $sql = "SELECT DISTINCT name as sng from playlists where user_id = $user_id ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        
    }
}
$obj = new index;
$objSong = $obj->SongsFunction();
// $objIndex = $obj->indexFunction();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
    .navbar-brand {
        width: 10% !important;
    }

    table.dataTable {
        border-collapse: collapse !important;
    }

    .bg_color {
        background-color: #fff !important;
    }

    body {
        font-family: 'Lato', sans-serif;

    }

    .carousel-caption {
        top: 50%;
        transform: translateY(-50%);
        bottom: initial;
        -webkit-transform-style: preserve-3d;
        -moz-transform-style: preserve-3d;
        transform-style: preserve-3d;
    }

    .carousel .carousel-item {
        height: 80vh;
    }

    .carousel-item img {
        position: absolute;
        top: 0;
        left: 0;
        min-height: 80vh;
        object-fit: cover;

    }

    section {
        padding: 60px 0;
    }

    .carousel-item:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
    }
    </style>


</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>





    <div class="container pb-5">
        <!-- <h1 class="font-weight-bold text-center mt-4 pt-5">Create Playlist</h1> -->
        <div class="text-center mt-5">
            <h4 class="font-weight-bold pt-5 pb-4"><?php echo $_SESSION['name'] ?>'s Playlist</h4>
            <div class="row">

                <?php if ($objSong) { ?>
                <?php while ($row = mysqli_fetch_assoc($objSong)) { ?>

                <div class="col-md-3 ">
                    <a class="text-decoration-none" href="playlist-details.php?name=<?php echo $row['sng']; ?>"
                        style="text-decoration:none">
                        <div class="card border-0 bg-white shadow">

                            <div class="card-body">
                                <h5 class="card-title text-decoration-none" style="text-decoration:none">
                                    <?php echo $row['sng']; ?></h5>


                            </div>
                        </div>
                    </a>
                </div>

                <?php } ?>
                <?php } ?>




            </div>

        </div>
    </div>




    <?php include('layout/script.php') ?>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,


        });
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>

</body>

</html>