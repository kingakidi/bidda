<?php include "../control/conn.php"; 
     if (!isset($_SESSION['juId'])) {
        header("Location: ../login.php");
      }

    //   CHECK FOR USERTYPE 
   

      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RIDDA</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff"><meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/sydee.css?v=899" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=45">
    <link rel="stylesheet" href="../style.css">

    <script src="./vendor/textEditor/ckeditor.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    

    <style type="text/tailwindcss">
    @layer utilities {
      .btn {
        background-color: #8d078e;
      }
    }
  </style>
    <!-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script> -->
</head>