<?php 
    include('../../control/conn.php');
    function checkForm ($data)
    {
        global $conn;
        return strtolower(trim(mysqli_escape_string($conn, $data)));
    }
    function checkPass ($data)
    {
        global $conn;
        return mysqli_escape_string($conn, $data);
    }
    function truncate($text, $chars = 25) {
        if (strlen($text) <= $chars) {
            return $text;
        }
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";
        return $text;
    }
// ERROR PRINTING FUNCTION 
    function error($text)
    {
        return "<span class='text-danger'>$text</span>";
    }

    // INFO PRINTING FUNCTION 
    function info($text)
    {
        return "<span class='text-info'>$text</span>";
    }

    // SUCCESS PRINTING FUNCTION 
    function success($text)
    {
        return "<span class='text-success'>$text</span>";
    }

    // CHECK VALUE FUNCTION 

    function dbValCheck($val, $col, $table) {
        global $conn;
            $query = mysqli_query($conn, "SELECT * FROM $table WHERE $col='$val'");
            if (!$query) {
            return die("UNABLE TO FETCH QUERY ".mysqli_error($conn));

            }else{
            $numRow = mysqli_num_rows($query);
            if ($numRow > 0) {
                return true;
            }else{
                return false;
            }

        }

    }