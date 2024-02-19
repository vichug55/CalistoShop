<?php

function conectarDB():mysqli{
    $db=mysqli_connect("localhost","root","3015","calistoshop");
    $db->set_charset('utf8');
    if(!$db){
        echo "Error no se pudo conectar";
    }
    return $db;
}
