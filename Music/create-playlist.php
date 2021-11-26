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
        $sql = "SELECT * from songs";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }

    }
    public function indexFunction()
    {
        $name = $_SESSION['name'];
        $sqlFind = "SELECT * from users where `name` = '$name' ";
        $resFind = mysqli_query($this->link, $sqlFind);
        $row = mysqli_fetch_assoc($resFind);
        $user_id = $row['user_id'];
        if (isset($_POST['signup'])) {
            $name = addslashes(trim($_POST['name']));

            $sqlName = "SELECT * from playlists where `name` = '$name' AND `user_id` = '$user_id' ";
            $resName = mysqli_query($this->link, $sqlName);
            if (mysqli_num_rows($resName) > 0) {
                return '<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Playlist name already exist</strong>
              </div>';
            } else {
                for ($i = 0; $i < count($_POST['songs']); $i++) {
                    $song = $_POST['songs'][$i];
                    $sql = "INSERT INTO `playlists` (`playlist_id`, `song_id`, `name`, `user_id`) VALUES (NULL, '$song', '$name', '$user_id')";
                    mysqli_query($this->link, $sql);
                }
                return '<div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Successfully Created!</strong>
              </div>';
            }
        }
        
    }
}
$obj = new index;
$objSong = $obj->SongsFunction();
$objIndex = $obj->indexFunction();
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





    <div class="container bg-white pr-4 pl-4  log_section pb-5">
        <!-- <h1 class="font-weight-bold text-center mt-4 pt-5">Create Playlist</h1> -->
        <div class="row mt-5">
            <div class="col-md-6 offset-3 ">

                <form action="" method="post" data-parsley-validate>

                    <div class="text-center">
                        <h4 class="font-weight-bold pt-5 pb-4">Create Playlist</h4>

                        <?php if ($objIndex) {
                            echo $objIndex;
                        } ?>
                    </div>
                    <input type="text" name="name" class="form-control bg-light" placeholder="Enter your playlist name"
                        required>

                    <label for="" class="mt-3">Choose songs</label>
                    <select class="js-example-basic-multiple form-control" name="songs[]" multiple="multiple">
                        <?php if ($objSong) { ?>
                        <?php while ($row = mysqli_fetch_assoc($objSong)) { ?>
                        <option value="<?php echo $row['song_id'] ?>"><?php echo $row['name']; ?></option>

                        <?php } ?>
                        <?php } ?>


                    </select>
                    <button name="signup" type="submit"
                        class="btn btn-block font-weight-bold log_btn btn-lg mt-4">CREATE</button>
                </form>
            </div>

            <!-- <form action="" method="post"> -->

            <!-- </form> -->
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