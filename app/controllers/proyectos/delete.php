<?php
// Ensure BASE_URL is defined for cURL
include_once __DIR__ . '/../../config.php'; // Include app/config.php

$id=intval($_GET['id']);
// Use BASE_URL for the absolute API endpoint
$ch=curl_init(BASE_URL . "api/proyectos.php/$id");
curl_setopt_array($ch,[
  CURLOPT_CUSTOMREQUEST=>'DELETE',
  CURLOPT_RETURNTRANSFER=>true
]);
curl_exec($ch);
curl_close($ch);
header("Location: index.php"); // This relative path is fine
exit;
?>