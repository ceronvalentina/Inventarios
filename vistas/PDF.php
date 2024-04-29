<?php

require('../PDF/fpdf.php');

require "../php/main.php";
$getmysql = new registro();
$getconex = $getmysql->conex();
function formatNumber($num)
{
	return number_format($num, 0, ',', '.');
}


$registros = "SELECT * FROM registros";
$resultado = mysqli_query($getconex, $registros);

$column_code = "";
$column_name = "";
$column_price = "";
$column_producto = "";


while ($row = mysqli_fetch_assoc($resultado))
{
    $code = $row["Fecha"];
    $name = $row["Mesero"];
    $real_price = $row["Producto"];
    $price_to_show = formatNumber($row["Total"]);

    $column_code .= $code . "\n";
    $column_name .= $name . "\n";
    $column_producto .= $real_price . "\n";
    $column_price .= $price_to_show . "\n";

}

mysqli_close($getconex);

//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 20;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232, 232, 232);
//Bold Font for Field Name
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY($Y_Fields_Name_position);

$pdf->SetX(30);
$pdf->Cell(50, 6, 'Fecha', 1, 0, 'L', 1);
$pdf->SetX(65);

$pdf->Cell(60, 6, 'Nombre', 1, 0, 'L', 1);
$pdf->SetX(165);

$pdf->Cell(30, 6, 'Precio', 1, 0, 'L', 1);
$pdf->SetX(95);

$pdf->Cell(70, 6, 'Producto', 1, 0, 'R', 1);
$pdf->SetX(95);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial', '', 12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(30);

$pdf->MultiCell(65, 6, $column_code, 1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);

$pdf->MultiCell(100, 6, $column_name, 1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(95);

$pdf->MultiCell(0, 6, $column_producto, 1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(165);

$pdf->MultiCell(30, 6, $column_price, 1, 'R');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(165);

$pdf->Output();
