<?php
error_reporting(E_ALL ^ E_DEPRECATED);

//load counter file and increment one
$number = file_get_contents("counter.txt");
$number++;
file_put_contents("counter.txt", $number);


$hostname = $_SERVER['SERVER_NAME'];

if(!isset($_POST['json']) || !isset($_POST['sign_type'])){
    http_send_status(400);
    die;
}

$json = $_POST['json'];


$object = json_decode($json);

$type = $_POST["sign_type"];

require_once "assets/fpdf/fpdf.php";



/* Setup */
$mm_per_pt			= 0.352778;
$pt_per_mm			= 2.83465;

//Landscape
$page_width = 297;
$page_height = 210;

$color_red        = [225,   0,  25];
$color_dark_blue  = [  0,  48,  99];
$color_light_blue = [  0,  92, 169];
$color_gray       = [227, 227, 227];
$color_black      = [  0,   0,   0];
$color_white      = [255, 255, 255];

if($type == "square"){
    require_once "square_signs.php";
}elseif($type == "rect"){
    require_once  "rect_signs.php";
}else{
    http_send_status(400);
    die;
}

