<?php

   $host        = "host = 127.0.0.1";
   $port        = "port = 5432";
<<<<<<< HEAD
   $dbname      = "dbname = db_herbbb";
   $credentials = "user = postgres password=1234";
=======
   $dbname      = "dbname =db_herbbb";
   $credentials = "user = postgres password=123456";
>>>>>>> e5ef6f7c325b9f87e4d9e404604d2ea2267b0500

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } 
   else {
      echo "Opened database successfully\n";
   }
   
?>