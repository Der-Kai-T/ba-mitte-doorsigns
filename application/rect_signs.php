<?php

$version = "Version 2";

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
$left = 10;


$box_width  = 156;
$box_height = 93;
$box_padding = 10;
$box_margin = 15;

//Portrait
$page_width = 210;
$page_height = 297;

//cutout
$cutout_width = 60;
$cutout_height = 2;
$cutout_left = $left + ($box_width/2) - ($cutout_width/2);
$cutout_right = $left + ($box_width/2) + ($cutout_width/2);

//File is same dimensions!
$authority_logo_width  = 26;
$authority_logo_height = 20.5;
$authority_logo_left   = 117;
$authority_logo_top    = 69;

$room_top = 0;
$room_font_size = 6;
$room_font_type = "";


$line_department_above = 10;
$line_department_below = 33;
$line_department_width = 1*$mm_per_pt;
$line_department_color = $color_dark_blue;
$department_font_size = 24;
$department_font_type = "B";

$names_top = 43;
$names_left = $left + $box_padding;
$names_second_column = $left + $box_width /2 + $box_padding;
$names_font_size = 24;
$names_font_type = "";


$section_bottom = 178;
$section_right = $box_width-$box_padding;
$section_number_font_size = 18;
$section_number_font_type = "B";
$section_font_size = 18;
$section_font_type = "B";



$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetAutoPageBreak(false);
$pdf->AddFont("HamburgSans", "", "HamburgSans-Regular.php");
$pdf->AddFont("HamburgSans", "I", "HamburgSans-Italic.php");
$pdf->AddFont("HamburgSans", "B", "HamburgSans-Bold.php");
$pdf->AddFont("HamburgSans", "IB", "HamburgSans-BoldItalic.php");
$pdf->AddFont("HamburgSans", "BI", "HamburgSans-BoldItalic.php");


$even = true;
foreach ($object as $sign) {
    if($even){
        $pdf->AddPage();
    }
    $even = !$even;

    if($even){
        $top = $top + $box_height + $box_margin;
    }


//Cutting Lines
    $color = $color_black;
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);
    $pdf->SetLineWidth(0.25);

//Bounding Box
    $pdf->Line(0, $top, $page_width, $top); //top line
    $pdf->Line(0, $top + $box_height, $page_width, $top + $box_height); //bottom line
    $pdf->Line($left, 0, $left, $page_height); //left line
    $pdf->Line($left + $box_width, 0, $left + $box_width, $page_height); //left line

//Cutout top
    $pdf->Line($cutout_left, $top, $cutout_left, $top +  $cutout_height); // left line
    $pdf->Line($cutout_right, $top, $cutout_right, $top +  $cutout_height); // right line
    $pdf->Line($cutout_left, $top +  $cutout_height, $cutout_right, $top +  $cutout_height); // long line

//Cutout bottom
    $pdf->Line($cutout_left, $top + $box_height, $cutout_left, $top + $box_height -  $cutout_height); // left line
    $pdf->Line($cutout_right, $top+ $box_height, $cutout_right, $top + $box_height -  $cutout_height); // right line
    $pdf->Line($cutout_left, $top + $box_height -  $cutout_height, $cutout_right, $top+ $box_height -  $cutout_height); // long line

//blue lines department
    $color = $line_department_color;
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);
    $pdf->SetLineWidth($line_department_width);
    $pdf->Line($left + $box_padding, $top + $line_department_above, $left + $box_width - $box_padding, $top + $line_department_above);
    $pdf->Line($left + $box_padding, $top + $line_department_below, $left + $box_width - $box_padding, $top + $line_department_below);
    $pdf->SetDrawColor($color_black[0], $color_black[1], $color_black[2]);
//authority logo
    $pdf->SetXY($left, $top);
    $pdf->Image("assets/img/hamburg.png", $left + $authority_logo_left, $top + $authority_logo_top, $authority_logo_width, $authority_logo_height);

// DEBUG
    $color = $color_red;
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);
    $pdf->SetLineWidth(0.25);

//Room Number
    $color = $color_black;
    $pdf->SetFont("HamburgSans", $room_font_type, $room_font_size);
    $pdf->SetXY($left + $box_padding, $top + $box_height - $cutout_height - $room_font_size * $mm_per_pt);
    $pdf->SetTextColor($color[0], $color[1], $color[2]);
    $pdf->Cell($box_width - 2 * $box_padding, $room_font_size * $mm_per_pt, utf8_decode($sign->room), 0, 0, "L");



//Department Name
    $color = $color_dark_blue;
    $pdf->SetFont("HamburgSans", $department_font_type, $department_font_size);
    $pdf->SetTextColor($color[0], $color[1], $color[2]);
    $y = ($top + $line_department_above + ($line_department_below - $line_department_above) /4)-1;
    $pdf->SetXY($left + $box_padding, $y );
    $pdf->Cell($box_width - $box_padding * 2, $department_font_size * $mm_per_pt, utf8_decode($sign->department), 0, 0, "L");

    $pdf->SetFont("HamburgSans", $section_font_type, $section_font_size);
    $pdf->SetTextColor($color[0], $color[1], $color[2]);
    $y = ($top + $line_department_below - $section_font_size * $mm_per_pt - ( $line_department_below - $line_department_above) /6) + 1;
    $pdf->SetXY($left + $box_padding, $y);
    $pdf->Cell($box_width - $box_padding * 2, $section_font_size * $mm_per_pt, utf8_decode($sign->section_name), 0, 0, "L");


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
                    $pdf->SetXY($local_left, $top + $names_top + ($i * $names_font_size * $mm_per_pt) + ($i * $names_font_size / 4 * $mm_per_pt));
                    $pdf->Cell($local_width, $names_font_size * $mm_per_pt, utf8_decode($label), 0, 0, "L");
                }
            }



    //Notes

        $pdf->SetFont("Arial", "", 10);
        $pdf->SetXY($left, $page_height - 15);
        $pdf->Cell($box_width, 10 * $mm_per_pt, "created by Der-Kai-T/ba-mitte-doorsigns  $version, hosted at " . $hostname, 0, 0, "C");
        $pdf->SetXY($left, $page_height - 30);
        $pdf->SetFont("Arial", "B", 14);
        $pdf->SetTextColor(255,0,0);
        $pdf->Cell($box_width, 10 * $mm_per_pt, utf8_decode("Achtung: Ausdruck muss in Originalgröße (100%) erfolgen. "), 0, 0, "C");
        $pdf->SetXY($left, $page_height - 26);
        $pdf->SetFont("Arial", "", 10);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell($box_width, 10 * $mm_per_pt, utf8_decode("Dazu das Dokument in einem PDF-Programm (nicht im Browser) öffnen,"), 0, 1, "C");
        $pdf->Cell($box_width, 10 * $mm_per_pt, utf8_decode("z.B. Adobe Acrobat oder PDF24 um die Option im Drucken-Dialog zu sehen "), 0, 0, "C");



}
$pdf->Output();