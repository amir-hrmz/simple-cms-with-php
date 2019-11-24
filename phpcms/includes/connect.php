<?php

try{

    $con = new PDO('mysql:host=127.0.0.1;dbname=phpcms;charset=utf8','root','');

}catch (PDOException $error){
    echo 'خطا'.$error->getMessage();
}