<?php 
 
            $host  = $_SERVER['HTTP_HOST'];
            $host_upper = strtoupper($host);
            $path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $baseurl = "http://" . $host . $path . "/";
            echo $baseurl.'/user/bills_payments.php?b_id';

?>