<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #0d6efd;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #084298;
        }
        .content {
            margin-left: 230px;
            padding: 30px;
        }
    </style>
</head>
<body>
