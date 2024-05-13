<?php

require ('../PDF/fpdf.php');

require "../php/main.php";
$getmysql = new registro();
$getconex = $getmysql->conex();
function formatNumber($num)
{
    return number_format($num, 0, ',', '.');
}
$pdf = new FPDF();



if (isset($_POST['Ingreso_Salida'])) {

    if ($_POST['Ingreso_Salida'] == "") {

        $resultado = $_POST['dia'];

        $Total = mysqli_query($getconex, "SELECT DISTINCT(SELECT Sum(Total) from registros where `Estado`='Entrada' and Fecha= CURDATE())-(SELECT Sum(Total) from registros where `Estado`='Salida' and Fecha= CURDATE()) as Sumas from registros where Fecha= '$resultado'");
        if ($categoria_fila = mysqli_fetch_assoc($Total)) {
            $Total = $categoria_fila['Sumas'];
        }

        $resultado = mysqli_query($getconex, "SELECT * FROM registros WHERE fecha = '$resultado'");

    } else {
        $Ingreso_Salida = $_POST['Ingreso_Salida'];
        $resultado = $_POST['dia'];

        $Total = mysqli_query($getconex, "SELECT SUM(Total) from registros where Estado='$Ingreso_Salida' && fecha = '$resultado'");
        if ($categoria_fila = mysqli_fetch_assoc($Total)) {
            $Total = $categoria_fila['SUM(Total)'];
        }

        $resultado = mysqli_query($getconex, "SELECT * FROM registros WHERE Estado='$Ingreso_Salida' && fecha = '$resultado'");
    }





    $column_code = "";
    $column_name = "";
    $column_price = "";
    $cantidad = "";
    $column_producto = "";



    while ($row = mysqli_fetch_assoc($resultado)) {
        $code = $row["Fecha"];
        $name = $row["Mesero"];
        $real_price = $row["Producto"];
        $price_to_show = formatNumber($row["Total"]);

        $Cantidad = $row['Cantidad'];

        $column_code .= $code . "\n";
        $column_name .= $name . "\n";
        $cantidad .= $Cantidad . "\n";
        $column_producto .= $real_price . "\n";
        $column_price .= $price_to_show . "\n";

    }

    mysqli_close($getconex);


    //Create a new PDF file
    $pdf = new FPDF();
    $pdf->AddPage();

    $image_file = '../img/La simona Nombre.png';
    $pdf->Image($image_file, 40, 220);
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


    $pdf->SetX(15);
    $pdf->Cell(35, 6, 'Fecha', 1, 0, 'L', 1);

    $pdf->SetX(50);
    $pdf->Cell(30, 6, 'Nombre', 1, 0, 'L', 1);


    $pdf->SetX(80);
    $pdf->Cell(60, 6, 'Producto', 1, 0, 'R', 1);

    $pdf->SetX(170);
    $pdf->Cell(30, 6, 'Precio', 1, 0, 'L', 1);

    $pdf->SetX(140);
    $pdf->Cell(30, 6, 'Cantidad', 1, 0, 'R', 1);

    
    $pdf->Ln();

    //Now show the 3 columns
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetY($Y_Table_Position);

    $pdf->SetX(15);
    $pdf->MultiCell(35, 6, $column_code, 1);
    $pdf->SetY($Y_Table_Position);

    $pdf->SetX(50);
    $pdf->MultiCell(30, 6, $column_name, 1);
    $pdf->SetY($Y_Table_Position);

    $pdf->SetX(80);
    $pdf->MultiCell(60, 6, $column_producto, 1);
    $pdf->SetY($Y_Table_Position);

    $pdf->SetX(140);
    $pdf->MultiCell(30, 6, $cantidad, 1);
    $pdf->SetY($Y_Table_Position);

    $pdf->SetX(170);
    $pdf->MultiCell(30, 6, $column_price, 1, 'C');
    $pdf->SetY($Y_Table_Position);

    $pdf->SetX(140);
    $pdf->SetY(200);
    $pdf->MultiCell(0, 6, formatNumber($Total), 1, 'C');



    $pdf->Output();

}



if (isset($_POST['producto'])) {
    if ($_POST['producto'] == "") {


        $resultado = (mysqli_query($getconex, "SELECT Producto, Lote, FV, SUM(Cantidad) AS TotalCantidad 
        FROM registros
        GROUP BY Producto, Lote, FV
        ORDER BY Producto ASC;"));

        $column_code = "";
        $column_name = "";
        $column_price = "";
        $column_producto = "";


        while ($row = mysqli_fetch_assoc($resultado)) {
            $code = $row["Producto"];
            $name = $row["Lote"];
            $real_price = $row["FV"];
            $price_to_show = formatNumber($row["TotalCantidad"]);

            $column_code .= $code . "\n";
            $column_name .= $name . "\n";
            $column_producto .= $real_price . "\n";
            $column_price .= $price_to_show . "\n";

        }

        mysqli_close($getconex);

        //Create a new PDF file
        $pdf = new FPDF();
        $pdf->AddPage();

        $image_file = '../img/La simona Nombre.png';
        $pdf->Image($image_file, 40, 220);
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

        $pdf->SetX(15);
        $pdf->Cell(40, 6, 'Nombre', 1, 0, 'C', 1);

        $pdf->SetX(55);
        $pdf->Cell(30, 6, 'Lote', 1, 0, 'C', 1);

        $pdf->SetX(155);
        $pdf->Cell(45, 6, 'Cantidades por lote', 1, 0, 'C', 1);

        $pdf->SetX(85);
        $pdf->Cell(70, 6, 'Fecha de Vencimiento', 1, 0, 'C', 1);

        $pdf->SetX(900);
        $pdf->Ln();

        //Now show the 3 columns
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(15);

        $pdf->MultiCell(40, 6, $column_code, 1, );
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(55);

        $pdf->MultiCell(100, 6, $column_name, 1, );
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(85);

        $pdf->MultiCell(0, 6, $column_producto, 1);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(155);

        $pdf->MultiCell(0, 6, $column_price, 1, 'C');
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(140);

        $pdf->Output();

    } else {
        $resultado = $_POST['producto'];

        $resultado = mysqli_query($getconex, "SELECT producto_nombre FROM producto WHERE producto_id = '$resultado'");

        if ($categoria_fila = mysqli_fetch_assoc($resultado)) {
            $resultado = $categoria_fila['producto_nombre'];
        }

        $resultado = (mysqli_query($getconex, "SELECT Producto, Lote, FV, SUM(Cantidad) AS TotalCantidad 
    FROM registros WHERE producto= '$resultado' GROUP BY Producto, Lote, FV;"));

        $column_code = "";
        $column_name = "";
        $column_price = "";
        $column_producto = "";


        while ($row = mysqli_fetch_assoc($resultado)) {
            $code = $row["Producto"];
            $name = $row["Lote"];
            $real_price = $row["FV"];
            $price_to_show = formatNumber($row["TotalCantidad"]);

            $column_code .= $code . "\n";
            $column_name .= $name . "\n";
            $column_producto .= $real_price . "\n";
            $column_price .= $price_to_show . "\n";

        }

        mysqli_close($getconex);

        //Create a new PDF file
        $pdf = new FPDF();
        $pdf->AddPage();

        $image_file = '../img/La simona Nombre.png';
        $pdf->Image($image_file, 40, 220);
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

        $pdf->SetX(15);
        $pdf->Cell(40, 6, 'Nombre', 1, 0, 'L', 1);

        $pdf->SetX(55);
        $pdf->Cell(30, 6, 'Lote', 1, 0, 'L', 1);

        $pdf->SetX(155);
        $pdf->Cell(45, 6, 'Cantidades por lote', 1, 0, 'L', 1);

        $pdf->SetX(85);
        $pdf->Cell(70, 6, 'Fecha de Vencimiento', 1, 0, 'L', 1);

        $pdf->SetX(900);
        $pdf->Ln();

        //Now show the 3 columns
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(15);

        $pdf->MultiCell(40, 6, $column_code, 1);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(55);

        $pdf->MultiCell(100, 6, $column_name, 1);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(85);

        $pdf->MultiCell(0, 6, $column_producto, 1);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(155);

        $pdf->MultiCell(0, 6, $column_price, 1, 'R');
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(140);

        $pdf->Output();
    }
}

