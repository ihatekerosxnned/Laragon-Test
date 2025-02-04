<?php
include_once('./classes/Database.php');
$DB = new Database();
$conn = $DB->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="styles/styles.css">
    <title>Phonebook</title>
</head>
<body>
    <div class="w-full">