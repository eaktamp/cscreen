<?php
        $connstring = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
        // $connstring = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
        $con = pg_connect($connstring);
        pg_set_client_encoding($con, "utf8");
?>