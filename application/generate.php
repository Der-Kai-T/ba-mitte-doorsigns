<?php

//load counter file and increment one
$number = file_get_contents("counter.txt");
$number++;
file_put_contents("counter.txt", $number);


$json = $_POST['json'];


$object = json_decode($json);


require_once ("assets/fpdf/fpdf.php");


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



//positions

$top = 10;
$left = 50;
$overprinting = 10;

$box_width  = 175;
$box_height = 175;
$box_padding = 5;

$bug_bottom = 34;
$bug_end = 78;
$bug_height = 11;
//File Dimensions = 3.179 x 238 px
$bug_width = (3179 / 238) * $bug_height;
$blue_height = 60;

//File is same dimensions!
$authority_logo_width  = 71;
$authority_logo_height = 25;
$authority_logo_left   = $left + 1.25;
$authority_logo_top    = 157;

$room_top = $bug_bottom;
$room_font_size = 64;
$room_font_type = "B";


$line_department_above = 75;
$line_department_below = 90;
$line_department_width = 3*$mm_per_pt;
$line_department_color = $color_dark_blue;
$department_font_size = 28;
$department_font_type = "B";

$names_top = 100;
$names_left = $left + $box_padding;
$names_second_column = $left + $box_width /2 + $box_padding;
$names_font_size = 24;
$names_font_type = "";


$section_bottom = 178;
$section_right = $box_width-$box_padding;
$section_number_font_size = 18;
$section_number_font_type = "B";
$section_font_size = 18;
$section_font_type = "";



$pdf = new FPDF('L', 'mm', 'A4');
$pdf->SetAutoPageBreak(false);
$pdf->AddFont("HamburgSans", "", "HamburgSans-Regular.php");
$pdf->AddFont("HamburgSans", "I", "HamburgSans-Italic.php");
$pdf->AddFont("HamburgSans", "B", "HamburgSans-Bold.php");
$pdf->AddFont("HamburgSans", "IB", "HamburgSans-BoldItalic.php");
$pdf->AddFont("HamburgSans", "BI", "HamburgSans-BoldItalic.php");



foreach ($object as $sign) {
    $pdf->AddPage();


//blue box
    $color = $color_dark_blue;
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);
    $pdf->SetFillColor($color[0], $color[1], $color[2]);
    $pdf->SetXY(0, 0);
    $pdf->Rect($left - $overprinting, $top - $overprinting, $box_width + 2 * $overprinting, $blue_height + $overprinting, "F");

//red bug
    $pdf->Image("assets/img/red_bug.png", $bug_end - $bug_width, $bug_bottom - $bug_height, $bug_width, $bug_height);

//authority logo
    $pdf->SetXY(0, 0);
    $pdf->Image("assets/img/ba-mitte.png", $authority_logo_left, $authority_logo_top, $authority_logo_width, $authority_logo_height);

//blue lines department
    $color = $color_dark_blue;
    $pdf->SetFillColor($color[0], $color[1], $color[2]);
    $pdf->SetLineWidth($line_department_width);
    $pdf->Line($left - $overprinting, $line_department_above, $left + $box_width + $overprinting, $line_department_above);
    $pdf->Line($left - $overprinting, $line_department_below, $left + $box_width + $overprinting, $line_department_below);

// DEBUG
    $color = $color_red;
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);
    $pdf->SetLineWidth(0.25);

//Room Number
    $color = $color_white;
    $pdf->SetFont("HamburgSans", $room_font_type, $room_font_size);
    $pdf->SetXY($left, $bug_bottom);
    $pdf->SetTextColor($color[0], $color[1], $color[2]);
    $pdf->Cell($box_width, $room_font_size * $mm_per_pt, utf8_decode($sign->room), 0, 0, "R");


//Department Name
    $color = $color_dark_blue;
    $pdf->SetFont("HamburgSans", $department_font_type, $department_font_size);
    $pdf->SetTextColor($color[0], $color[1], $color[2]);
    $pdf->SetXY($left + $box_padding, $line_department_above);
    $pdf->Cell($box_width - $box_padding * 2, $line_department_below - $line_department_above, utf8_decode($sign->department), 0, 0, "L");

//Names
    $color = $color_black;
    $pdf->SetTextColor($color[0], $color[1], $color[2]);


//left column
    $pdf->SetXY($names_left, $names_top);

for($j =1; $j<= 2; $j++) {
    if($j == 1){
        $local_left =  $names_left;
        $local_width = $box_width - $box_padding * 2;
    }else{
        $local_left = $names_second_column;
        $local_width = $box_width - $box_padding - $names_second_column + $left;
    }
    for ($i = 0; $i < 5; $i++) {
        $key = "line_".$j."_" . ($i + 1);
        $label = $sign->$key;

        if (str_starts_with($label, "*")) {
            $pdf->SetFont("HamburgSans", "I" . $names_font_type, $names_font_size);
            $label = substr($label, 1);
        } else {
            $pdf->SetFont("HamburgSans", $names_font_type, $names_font_size);
        }
        $pdf->SetXY($local_left, $names_top + ($i * $names_font_size * $mm_per_pt) + ($i * $names_font_size / 4 * $mm_per_pt));
        $pdf->Cell($local_width, $names_font_size * $mm_per_pt, utf8_decode($label), 0, 0, "L");
    }
}
//right column
//    $pdf->SetXY($names_second_column, $names_top);
//    $pdf->SetFont("HamburgSans", $names_font_type, $names_font_size);
//
//    for ($i = 0; $i < 5; $i++) {
//        $key = "line_2_" .  ($i+1);
//        $label = $sign->$key;
//
//        if(str_starts_with($label, "*")){
//            $pdf->SetFont("HamburgSans", "I".$names_font_type, $names_font_size);
//            $label = substr($label, 1);
//        }else{
//            $pdf->SetFont("HamburgSans", $names_font_type, $names_font_size);
//        }
//        $pdf->SetXY($names_second_column, $names_top + ($i * $names_font_size * $mm_per_pt) + ($i * $names_font_size / 4 * $mm_per_pt));
//        $pdf->Cell($box_width - $box_padding - $names_second_column + $left, $names_font_size * $mm_per_pt, utf8_decode($label), 1, 0, "L");
//    }


//Section Number and Name
    $color = $color_black;
    $pdf->SetTextColor($color[0], $color[1], $color[2]);

    $pdf->SetFont("HamburgSans", $section_number_font_type, $section_number_font_size);
    $pdf->SetXY($left + $box_padding, $section_bottom - ($section_number_font_size * $mm_per_pt) - ($section_font_size * $mm_per_pt));
    $pdf->Cell($box_width - $box_padding * 2, $section_number_font_size * $mm_per_pt, utf8_decode($sign->section_number), 0, 0, "R");

    $pdf->SetFont("HamburgSans", $section_font_type, $section_font_size);
    $pdf->SetXY($left + $box_padding, $section_bottom - ($section_font_size * $mm_per_pt) + 0.75); //+.75mm to match bottom line with bottom line in word "Hamburg" in Authority Logo
    $pdf->Cell($box_width - $box_padding * 2, $section_font_size * $mm_per_pt, utf8_decode($sign->section_name), 0, 0, "R");


//Cutting Lines
    $color = $color_black;
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);
    $pdf->SetLineWidth(0.25);
    $pdf->Line(0, $top, $page_width, $top); //top line
    $pdf->Line(0, $top + $box_height, $page_width, $top + $box_height); //bottom line
    $pdf->Line($left, 0, $left, $page_height); //left line
    $pdf->Line($left + $box_width, 0, $left + $box_width, $page_height); //left line


    $pdf->SetFont("Arial", "", 10);
    $pdf->SetXY($left, $page_height - 10);
    $pdf->Cell($box_width, 10 * $mm_per_pt, "Erzeugt mittels https://tuerschild.kai-thater.de", 0, 0, "C");

}
$pdf->Output();