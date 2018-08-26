<?php
    require 'a_header.php';      
?>


<!DOCTYPE html>
<html>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
            var url = window.location; 
            // Will only work if string in href matches with location  

           $('ul.nav a[href="'+ url +'"]').parent().addClass('active');    
           // Will also work for relative and absolute hrefs  

           $('ul.nav a').filter(function() { 
                return this.href == url;
           }).parent().addClass('active');
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
            <hr>
<div class="container">
      <div class="row">


        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
            <img src="..\images\menu\1.png">
              <div class="caption">
                <h4>สมุนไพร</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, soluta, eligendi doloribus sunt minus amet sit debitis repellat. Consectetur, culpa itaque odio similique suscipit</p>
                 <a href="herb_manage.php" class="btn btn-info btn-xs" role="button">เข้าชม</a> 
            </div>
          </div>
        </div>
        
        <div class="col-xs-18 col-sm-6 col-md-3">
          <div class="thumbnail">
            <img src="..\images\menu\5.png">
              <div class="caption">
                <h4>ต้นไม้</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, soluta, eligendi doloribus sunt minus amet sit debitis repellat. Consectetur, culpa itaque odio similique suscipit</p>
               <a href="#" class="btn btn-info btn-xs" role="button">เข้าชม</a>
            </div>
          </div>
        </div>

        

        
        
        

            </div>
     
        </div>

        
       
    </body>
</html>