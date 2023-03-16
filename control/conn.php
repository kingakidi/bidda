<?php
      $conn = mysqli_connect('localhost', 'root', '', 'ridda');
      if (!$conn) {
         die("ERROR ON CONNECTION");
      }
      if(!isset($_SESSION)) 
      { 
         session_start(); 
      } 
      ob_start();

      // TESTING KEYS 
         $tPublic = '';
         $tSecret =  '';

         $lPublic = '';
         $lSecret =  '';

      // ROOT URL 
      $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

      $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );