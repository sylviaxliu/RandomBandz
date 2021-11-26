<?php
session_start();

include('class/database.php');
class signInUp extends database
{
    protected $link;
    public function signUpFunction()
    {
        if (isset($_POST['signup'])) {
            //addslashes take different ascii value and trim will remove start and last white space
            $name = addslashes(trim($_POST['name']));


            $pass = trim($_POST['password']);

            //This will hash the password
            $password = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "select * from users where name = '$name'";
            $res = mysqli_query($this->link, $sql);

            if (mysqli_num_rows($res) > 0) {
                $msg = "Email is Taken";
                return $msg;
            } else {

                $sql3 = "INSERT INTO `users` (`user_id`, `name`, `password`, `date_joined`) VALUES (NULL, '$name', '$password', CURRENT_TIMESTAMP)";
                $res3 = mysqli_query($this->link, $sql3);
                if ($res3) {

                    $_SESSION['name'] = $name;
                    //header function will redirect the user to profile.php page
                    header('location:index.php');
                } else {
                    $msg = "Not Added";
                    return $msg;
                }
            }
        }
    
    }
}
$obj = new signInUp;
$objSignUp = $obj->signUpFunction();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>

    <style>
    body {
        font-family: 'Lato', sans-serif;

    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <section>
        <div class="container bg-white pr-4 pl-4  log_section pb-5">

            <div class="row">


                <!-- <form action="" method="post"> -->
                <div class="col-md-6 offset-3 ">
                    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>

                        <div class="text-center">
                            <h4 class="font-weight-bold pt-5">SIGNUP</h4>

                            <?php if ($objSignUp) { ?>


                            <?php } ?>
                        </div>
                        <input type="text" name="name" class="form-control mt-4 p-4 border-0 bg-light"
                            placeholder="Full Name" required>

                        <input type="password" id="passwordField" class="form-control mt-4 p-4 border-0 bg-light"
                            placeholder="Password" data-parsley-minlength="5" required>
                        <input data-parsley-equalto="#passwordField" type="password"
                            class="form-control mt-4 p-4 border-0 bg-light" name="password"
                            placeholder="Confirm Password" required>

                        <button name="signup" type="submit"
                            class="btn btn-block font-weight-bold log_btn btn-lg mt-4">SIGNUP</button>
                        <small class="font-weight-bold mt-1 text-muted"><a href="./login.php"
                                style="color: #05445E;">Already have an account?</a></small>
                    </form>
                </div>
                <!-- </form> -->
            </div>

        </div>

    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>

    <script src="js/datepicker.js"></script>
    <script>
    $('[data-toggle="datepicker"]').datepicker({
        autoClose: true,
        viewStart: 2,
        format: 'dd/mm/yyyy',

    });
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
</body>

</html>