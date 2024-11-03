<?php

function authCheck($app)
{
    $auth = $app->urlCheck . '/' . $app->action;



    $validPaths = [
        //"admin/auth/Dashboard/pages" => [1, 2, 3],
        //  "quan-ly.html" => [1, 2, 3],
        "admin/movies/updateMovie" => [1, 2, 3],

    ];

    if (!empty($_SESSION['is_login']['id_account'])) {


        $loginLevel = $_SESSION['is_login']['id_role'];


        if ($app->urlCheck != 'Errors') {

            if ((strcasecmp($auth, $validPaths[$auth])) == 0 && in_array($loginLevel, $validPaths[$auth])) {
                $check = true;
            } else {
                // echo "<script>alert('no')</script>";
                header('Location: ' . _LINK . '/Errors/error403');
                exit();
            }
        }
    } else {
        $url = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        if ($url == _LINK . '/dang-nhap.html') {
            echo "ok";
        } else { ?>
            <!-- <script>
                window.location.href = "dang-nhap.html";
            </script> -->
<?php
        }
    }
}
