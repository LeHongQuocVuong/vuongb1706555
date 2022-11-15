<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/bootstrap/bootstrap.min.css.map">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>vendor/font-awesome/font-awesome.min.css">
    <style>
        .myForm {
            min-width: 300px;
            position: absolute;
            text-align: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @media (max-width: 500px) {
            .myForm {
                min-width: 90%;
            }
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['message'])) {
        foreach ($_SESSION['message'] as $key => $value) {
            echo '<div class="alert alert-success mt-2" role="alert">' . $value . '</div>';
        }
        Session::unset("message");
    }
    if (isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $key => $value) {
            echo '<div class="alert alert-danger mt-2" role="alert">' . $value . '</div>';
        }
        Session::unset("error");
    } ?>


    <div>
        <form action="<?php echo BASE_URL ?>login/authentication_login" method="post" class="myForm">
            <h3>Đăng nhập Admin</h3>
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>
        </form>
    </div>

    <script src="<?php echo BASE_URL; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>vendor/bootstrap/bootstrap.min.js"></script>

</body>

</html>