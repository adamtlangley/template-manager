<?php
include_once('../Db.php');

$settings = array();
foreach( scandir( getcwd() ) as $file  ){
    if( substr($file,-4,4) == '.cfg' ){
        foreach( explode(PHP_EOL, file_get_contents( $file ) ) as $conf ){
            $conf = preg_replace('/([^a-zA-Z=_\-0-9.])/','',$conf);
            $conf_a = explode("=",$conf);
            if( count($conf_a) == 2 ){
                $settings[ $conf_a[0] ] = $conf_a[1];
            }
        }
    }
}
if( !isset($settings["DB_HOST"],$settings["DB_DB"],$settings["DB_USER"],$settings["DB_PASS"]) ){
    include_once('../admin_template/install.php');
    exit();
}
$pdo = Db::checkDb($settings["DB_HOST"],$settings["DB_DB"],$settings["DB_USER"],$settings["DB_PASS"]);
if( !$pdo ){
    die("Invalid database config file, please check your settings");
}
Db::set( $pdo );
$url = explode("?", $_SERVER["REQUEST_URI"] );
$url = $url[0];
$pages = array();
$pages["/admin"] = 'admin_template/admin';
$pages["/admin/dashboard"] = 'admin_template/dashboard';

$d = $pdo->prepare('select * from page ');
$d->execute();
while( $p = $d->fetch() ){
    $pages[ $p["url"] ] = 'template/'.$p["template"];
}

if( isset($pages[$url]) ){
    include_once('../'.$pages[$url].'.php');
}else{
    include_once('../template/404.php');
}




