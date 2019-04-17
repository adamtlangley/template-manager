<?php
$login_error = false;

    function adminLogin( $username, $password ){
        $resp = false;
        $d = Db::get()->prepare('select * from user where username = ? and password = ? LIMIT 1 ');
        $d->execute( array( $username, md5( $password ) ) );
        if( $d->rowCount() == 1 ){
            $resp = true;
        }
        return $resp;
    }


    if( isset($_POST["username"],$_POST["password"]) ){
        $login_error = true;
        if( $login = adminLogin($_POST["username"],$_POST["password"]) ){
            $challenge = md5( rand().date("U").print_r( $_SERVER, true ).print_r( $_POST, true ).rand() );
            $auth = md5( $challenge.'s4cre4log1nStinG4T3mpl4tem4Ngaer' );
            $str = json_encode( array(
               'challenge'  =>  $challenge,
               'auth'       =>  $auth
            ));
            $hash = base64_encode(urlencode($str));
            setcookie('token',$hash,time()+3600,'/');
            header("Location: /admin/dashboard");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form method="post">
                <div class="panel panel-default" style="margin-top:50px">
                    <div class="panel-heading">Admin</div>
                    <div class="panel-body">
                        <?php if( $login_error ){ ?>
                            <div class="alert alert-danger" role="alert">Username or Password Combination Incorrect</div>
                        <?php } ?>
                        <div style="margin-top:7px"><label>Admin Username:</label></div>
                        <div><input name="username" class="form-control"></div>
                        <div style="margin-top:7px"><label>Admin Password:</label></div>
                        <div><input name="password" type="password" class="form-control"></div>
                    </div>
                </div>
                <input type="submit" class="btn btn-success pull-right" value="Login">
            </form>
            <div>powered by <a href="https://github.com/adamtlangley/template-manager" target="_blank">Template Manager</a> v1.1 </div>


        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>