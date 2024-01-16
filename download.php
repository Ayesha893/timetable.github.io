<?php 

include_once "vendor/autoload.php";
$con = new mysqli('localhost','root','','rtimetable');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetFont('times', 'BI', 20);
$pdf->AddPage();

// set some text to print
$data = <<<EOD


        <h4>Generated Timetable:</h4>

        <table border="1">
        <tr style="text-align:center; font-size:0.7em">
        <th style="width:5%">No</th>
        <th>Day</th>
        <th style="width:20%">Timeslot</th>
        <th>Room</th>
        <th>Class</th>
        <th>Subject</th>
        <th>Faculty</th>
        </tr> 

EOD;





$fetch          = "SELECT * FROM timetables WHERE status = 1";
$fetchresults   = $con->query($fetch);
$num_rows       = $fetchresults->num_rows;

if($num_rows == 0){

echo "<td>No Record.</td>";

}else{

$count = 0;
while($rows = $fetchresults->fetch_assoc()){

$id         = $rows['id'];
$roomid     = $rows['roomid'];

$roomQuery      = "SELECT * FROM rooms WHERE id = '{$roomid}' ";
$roomRes        = $con->query($roomQuery);
$roomRow        = $roomRes->fetch_assoc();
$room           = $roomRow['name'];




$classid        = $rows['classid'];
$classQuery     = "SELECT * FROM classes WHERE id = '{$classid}' ";
$classRes       = $con->query($classQuery);
$classRow       = $classRes->fetch_assoc();
$class          = $classRow['name'];


$subjectid      = $rows['subjectid'];
$subjectQuery   = "SELECT * FROM subjects WHERE id = '{$subjectid}' ";
$subjectRes     = $con->query($subjectQuery);
$subjectRow     = $subjectRes->fetch_assoc();
$subject        = $subjectRow['name'];
$faculty        = $subjectRow['faculty'];


$facultyQuery   = "SELECT * FROM registrations WHERE id = '{$faculty}' ";
$facultyRes     = $con->query($facultyQuery);
$facultyRow     = $facultyRes->fetch_assoc();
$firstname      = $facultyRow['firstname'];
$lastname       = $facultyRow['lastname'];
$faculty        = $firstname . ' ' . $lastname;





$day            = $rows['day'];
$timeslot       = $rows['timeslot'];


$count++;

$data .= <<<EOD

<tr style="text-align:center; font-size:0.5em;padding-bottom-:0.5em">
<td style="width:5%">$count</td>
<td>$day</td>
<td style="width:20%">$timeslot</td>
<td>$room</td>
<td>$class</td>
<td>$subject</td>
<td>$faculty</td>
</tr>

EOD;


}


$data .=<<<EOD

</table>

EOD;




}









$pdf->writeHTML($data, true, false, true, false, '');
$pdf->Output('download.pdf', 'I');







 ?>