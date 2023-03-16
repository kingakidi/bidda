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
         $tPublic = 'FLWPUBK_TEST-3a6c05fb0886a4797400d1def006fcef-X';
         $tSecret =  'FLWSECK_TEST-51ca36ea5a903666fe5f03367d3a3d70-X';

         $lPublic = 'FLWPUBK-a7731b7324676d260cd7ce2c6d9641c6-X';
         $lSecret =  'FLWSECK-29eab5e97dfa5c1ff1303c767bc0f2f5-X';

      // ROOT URL 
      $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

      $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );