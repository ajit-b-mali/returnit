<?php
session_start();
// Require DB config...
// Headers to force download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=returnit_data.csv');

$output = fopen('php://output', 'w');

// Headers
fputcsv($output, array('Type', 'Name/Description', 'Person', 'Date', 'Status', 'Amount'));

// Fetch items and write
// ... SQL Select ...
// loop: fputcsv($output, $row);
?>