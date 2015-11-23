<?php
$nombre= $_GET["nombre"];
// This is the path to your PDF files. This shouldn't be accessable from your
// webserver - if it is, people can download them without logging in
$path_to_pdf_files = "pdf";
// Check they are logged in. If they aren't, stop right there.
/*
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
	die("You are not logged in!");
}
*/
// Get the PDF they have requested. This will only allow files ending in 'pdf'
// to be downloaded.
//$pdf_file = basename("Muestra1").".pdf";
$pdf_location = "$path_to_pdf_files/$nombre";
echo $pdf_location;
// Check the file exists. If it doesn't, exit.
if (!file_exists($pdf_location)) {
	die("The file you requested could not be found.");
}
// Set headers so the browser believes it's downloading a PDF file
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=$pdf_file");
$filesize = filesize($pdf_location);
// Read the file and output it to the browser
readfile($pdf_location);
?>