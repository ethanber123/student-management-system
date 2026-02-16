require('fpdf.php');
include "config.php";

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,10,'Student List',0,1,'C');

$result=$conn->query("SELECT * FROM students");
while($row=$result->fetch_assoc()){
$pdf->Cell(190,10,$row['fullname']." - ".$row['course'],0,1);
}
$pdf->Output();
