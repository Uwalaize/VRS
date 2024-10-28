<?php
require '../vendor/autoload.php'; // Adjust the path as needed to PhpSpreadsheet's autoload file
include("../connection.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $print_option = $_POST['print_option'];

    // Query based on the selected option
    if ($print_option == 'day') {
        $sql = "SELECT * FROM visitor WHERE DATE(date) = '$start_date'";
    } elseif ($print_option == 'week') {
        $sql = "SELECT * FROM visitor WHERE WEEK(date, 1) = WEEK('$start_date', 1)";
    } elseif ($print_option == 'month') {
        $sql = "SELECT * FROM visitor WHERE MONTH(date) = MONTH('$start_date') AND YEAR(date) = YEAR('$start_date')";
    } elseif ($print_option == 'year') {
        $sql = "SELECT * FROM visitor WHERE YEAR(date) = YEAR('$start_date')";
    }

    // Execute the query
    $result = $database->query($sql);

    if (!$result) {
        die("Query failed: " . $database->error);
    }

    if ($result->num_rows == 0) {
        echo "<script>
                alert('No records found for the selected date range.');
                setTimeout(function() {
                    window.location.href = 'visitor.php';
                }, 10); // Redirects after 0.01 seconds
              </script>";
        exit(); // Stop further execution
    }        
    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set document properties
    $spreadsheet->getProperties()
        ->setCreator("IJC REPORT OF VISITORS")
        ->setTitle("Visitor Report");

    // Add headers
    $headers = ['ID', 'JINA KAMILI', 'ANAPOTAKA', 'ANAPOENDA', 'KITAMBULISHO', 'NO/SIMU', 'TAREHE YA KUINGIA', 'MUDA KUINGIA', 'MUDA KUTOKA'];
    $sheet->fromArray($headers, NULL, 'A1');

    // Add data rows
    $rowIndex = 2; // Start from the second row
    while ($row = $result->fetch_assoc()) {
        $data = [
            isset($row['id']) ? $row['id'] : 'N/A',
            isset($row['name']) ? $row['name'] : 'N/A',
            isset($row['unapotoka']) ? $row['unapotoka'] : 'N/A',
            isset($row['unapoenda']) ? $row['unapoenda'] : 'N/A',
            isset($row['detail']) ? $row['detail'] : 'N/A',
            isset($row['phone']) ? $row['phone'] : 'N/A',
            isset($row['date']) ? $row['date'] : 'N/A',
            isset($row['timein']) ? $row['timein'] : 'N/A',
            isset($row['timeout']) ? $row['timeout'] : 'N/A'
        ];

        $sheet->fromArray($data, NULL, "A$rowIndex");
        $rowIndex++;
    }

    // Send output to client
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Visitor_Report.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}
?>
