<?php   
    $uQuery = mysqli_query($conn, "SELECT * FROM `users` ORDER BY date DESC");
    if (!$uQuery) {
        die("UNABLE TO SELECT USERS ");
    }
    $sn = 1;
    if (mysqli_num_rows($uQuery) > 0) {
        // BRING THE DETAILS OUT 
        echo "
            <table class='table table-responsive table-bordered' id='users-table'>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>FULLNAME</th>
                    <th>EMAIL ADDRESS</th>
                    <th>PHONE </th>
                    <th>GENDER</th>
                    <th>COUNTRY</th>
                    <th>TYPE</th>
                    <th> MERCHANT FEES CODE </th>
                    <th>STATUS</th>
                    <th>DATE</th>
                
                </tr>
            </thead>
            <tbody>

        ";
        while ($row = mysqli_fetch_assoc($uQuery)) {
  

            $id = $row['id'];
            $fn = ucwords($row['fullname']);
            $e = $row['email'];
            $p = $row['phone'];
            $g = ucwords($row['gender']);
            $c = ucwords($row['country']);
            $t = ucwords($row['type']);
            
            $status = ucwords($row['status']);
            $date = $row['date'];

            if ($row['type'] === 'merchant') {
                $tCode = $row['transaction_code'];
            }else{
                $tCode = '-';
            }
            echo "<tr>
                    <td>$sn</td>
                    <td>$fn</td>
                    <td>$e</td>
                    <td>$p</td>
                    <td>$g</td>
                    <td>$c</td>
                    <td>$t</td>
                    <td>$tCode</td>
                    <td>$status</td>
                    <td>$date</td>
                </tr>
            ";
        $sn++;
        }
        echo "
            </tbody>
            </table>
        ";
    }else{
        echo "NO USERS AVAILABLE";
    }
   
    ?>

    
           
     