<?php
function createConfigFile( $db_host, $db, $db_user, $db_pass ){
    $myfile = fopen(getcwd()."/".date("YmdH").".cfg", "w");
    fwrite( $myfile,"DB_HOST=".$db_host.PHP_EOL."DB_DB=".$db.PHP_EOL."DB_USER=".$db_user.PHP_EOL."DB_PASS=".$db_pass);
    fclose($myfile);
}
if( isset( $_POST["db_server"],$_POST["db_db"],$_POST["db_user"],$_POST["db_pass"],$_POST["username"],$_POST["password"] ) ){
    if( $pdo = Db::checkDb( $_POST["db_server"],$_POST["db_db"],$_POST["db_user"],$_POST["db_pass"] ) ){
        Db::setup( $pdo, $_POST["username"], $_POST["password"] );
        createConfigFile(  $_POST["db_server"],$_POST["db_db"],$_POST["db_user"],$_POST["db_pass"] );
        header("Location: /admin");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Setup</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form method="post">
                    <div class="panel panel-default" style="margin-top:50px">
                        <div class="panel-heading">Database Settings</div>
                        <div class="panel-body">
                            <div><label>Database Server:</label></div>
                            <div><input name="db_server" class="form-control"></div>
                            <div style="margin-top:7px"><label>Database:</label></div>
                            <div><input name="db_db" class="form-control"></div>
                            <div style="margin-top:7px"><label>Database User:</label></div>
                            <div><input name="db_user" class="form-control"></div>
                            <div style="margin-top:7px"><label>Database Pass:</label></div>
                            <div><input name="db_pass" class="form-control"></div>
                            <div style="margin-top:7px"><label>Admin Username:</label></div>
                            <div><input name="username" class="form-control"></div>
                            <div style="margin-top:7px"><label>Admin Password:</label></div>
                            <div><input name="password" class="form-control"></div>

                        </div>
                    </div>
                    <input type="submit" class="btn btn-success pull-right" value="Check">
                </form>
            </div>
        </div>
    </div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>