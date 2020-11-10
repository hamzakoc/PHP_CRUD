<?php
session_start();
include 'config/functions.php';
check_access();
//Get category name from cookies
$category = $_COOKIE['category'];


//Get category name and and id. Delete data using ID and return new value. Go to last page category after deletion
if (isset($_GET["id"])) {
    
    $get_id = (int) $_GET["id"];

    $datas = file_get_contents('db.json');

    $datas = json_decode($datas, true);


    if (($datas[$category][$get_id])==true) {

        unset($datas[$category][$get_id]);

        $datas[$category] = array_values($datas[$category]);

        file_put_contents("db.json", json_encode($datas));

    }
    header("Location: items.php?category=$category");
}