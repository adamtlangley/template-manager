<?php
$logged_in = false;
if( isset( $_COOKIE["token"] ) ){
    $json = json_decode( urldecode(base64_decode($_COOKIE["token"])), true );
    if( gettype($json) == 'array' ){
        if( isset($json["challenge"],$json["auth"]) ){
            if( $json["auth"] ==  md5( $json["challenge"].'s4cre4log1nStinG4T3mpl4tem4Ngaer' ) ){
                $logged_in = true;
                setcookie('token',$_COOKIE["token"],time()+3600,'/');
            }
        }
    }
}
if( !$logged_in ){
    header("Location: /admin");
    exit();
}

$pages = array();
$d = Db::get()->prepare('select * from page ');
$d->execute();
while( $p = $d->fetch() ){
    $pages[ $p["url"] ] = 'template/'.$p["template"];
}
$users = array();
$d = Db::get()->prepare('select username from user ');
$d->execute();
while( $u = $d->fetch() ){
    $users[] = $u["username"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin > Dasboard</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1>Admin Dashboard</h1>
            <div class="panel panel-default">
                <div class="panel-heading">Pages</div>
                <div class="panel-body" style="padding:0">
                    <table class="table" style="margin:0">
                        <tr>
                            <th>URL</th>
                            <th>Template</th>
                        </tr>
                        <?php foreach( $pages as $url=>$template ){ ?>
                        <tr>
                            <td><?php echo $url; ?></td>
                            <td><?php echo $template; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body" style="padding:0">
                    <table class="table" style="margin:0">
                        <tr>
                            <th>Username</th>
                        </tr>
                        <?php foreach( $users as $user ){ ?>
                        <tr>
                            <td><?php echo $user; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Plugins</div>
                <div class="panel-body">

                </div>
            </div>

        </div>
    </div>

</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>