<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
.login-box {
    border: 1px solid #ccc;
    padding: 15px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
    border-radius: 10px; /* Add rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

.login-box h3 {
    margin-bottom: 15px;
    font-size: 1.5em; /* Increase font size */
    color: #333;
    text-align: center; /* Center align the heading */
    font-weight: bold; /* Make the text bold */
}

.login-box .form-group {
    margin-bottom: 10px;
}

.login-box .form-control {
    width: 100%;
    padding: 10px;
    margin: 5px 0 10px 0;
    border: 1px solid #ccc;
    box-sizing: border-box;
    border-radius: 5px; /* Add rounded corners */
}

.login-box .btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px; /* Add rounded corners */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}

.login-box .btn:hover {
    background-color: #0056b3;
}

    </style>
    

</head>

<body>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>