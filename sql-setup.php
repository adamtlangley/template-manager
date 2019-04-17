<?php

$sql_cmd = array();
$sql_cmd[] = "CREATE TABLE page ( id int(11) NOT NULL, url varchar(250) NOT NULL, template varchar(250) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$sql_cmd[] = "ALTER TABLE page ADD PRIMARY KEY (id);";
$sql_cmd[] = "ALTER TABLE page MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
$sql_cmd[] = "INSERT INTO page (url, template) VALUES ('/', 'home')";
$sql_cmd[] = "CREATE TABLE user (id int(11) NOT NULL,username varchar(50) NOT NULL,password varchar(32) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$sql_cmd[] = "ALTER TABLE user ADD PRIMARY KEY (id);";
$sql_cmd[] = "ALTER TABLE user MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";