

<?php

require('fpdf/fpdf.php');


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Cell(40,10,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nP A Y M E N T - R E C E I P T",2.0,true);
$pdf->Line(10,30,200,30);

$database_name = "Plants nursery";
$con = mysqli_connect("localhost","root","Rithik3010",$database_name);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Checkout ORDER BY Id DESC LIMIT 1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {

    	$pdf->Ln(20);
    	$pdf->Cell(40,10,"Payment ID: ". $row["id"],2.0,true);
    	$pdf->Cell(40,10,"Name: ". $row["Name"],2.0,true);
    	$pdf->Cell(40,10,"Email: " . $row["Email"],2.0,true);
    	$pdf->MultiCell(160,10,"Address: " . $row['Address'],2.0);
    	$pdf->Cell(40,10,"City: " . $row["City"],2.0,true);
    	$pdf->Cell(40,10,"State: " . $row["State"],2.0,true);
    	$pdf->Cell(40,10,"Zip Code: " . $row["Zipcode"],2.0,true);
    	$pdf->Ln(10);
    }
} else {
    echo "0 results";
}

$pdf->Cell(40,10,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nThank you for Ordering !",2.0,true);
$pdf->Cell(40,10,"\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n- Plants Nursery ",2.0);
$pdf->Output();

?>
