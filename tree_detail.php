<?php 
    require 'connect/connectdb.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <style>
            p.p1 {
                font-family: verdana;
                font-size: 18px;
        </style>
        
    </head>
    <body style="background-color: rgb(241, 242, 246);">
        
        <!-- header -->
        <?php require 'header.php'; ?>
        
        <div class="container">
            
            <?php
                $treeplace_id = $_GET['treeplace_id'];
                $sql_place = "  SELECT * FROM tree_place
                                INNER JOIN tree_name
                                ON tree_place.treename_id = tree_name.treename_id
                                INNER JOIN tree_data
                                ON tree_name.treename_id = tree_data.treename_id
                                WHERE treeplace_id = '$treeplace_id'                                                                        
                             ";
                $res_place = pg_query($db, $sql_place);
                    
                while ($row_place = pg_fetch_array($res_place)) {  
            ?>
            
            <div class="row">
                
                <div class="col-md-2">
                   
                </div>
                
                <div class="col-md-8">
                    <div>
                        <center><img class="thumbnail" src="images/<?php echo $row_place['treeplace_herbimg']; ?>" style="width:400px;height:300px;"></center>
                    </div>
                    
                    <div>
                        <h2><?php echo $row_place['treename_th']; ?></h2>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['treename_th']; ?></strong>
                            ชื่อภาษาอังกฤษ: <?php echo $row_place['treedata_name_eng']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['treename_th']; ?></strong>
                            ชื่อวิทยาศาสตร์: <?php echo $row_place['treedata_name_sci']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['treename_th']; ?></strong>
                        ความสูงของต้นไม้: <?php echo $row_place['treeplace_hight']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['treename_th']; ?></strong>
                        ความกว้างของต้นไม้: <?php echo $row_place['treeplace_wideth']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['treename_th']; ?></strong>
                        เส้นรอบวงของต้นไม้: <?php echo $row_place['treeplace_radius']; ?>
                        </p>
                    </div>

                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['treename_th']; ?></strong>
                        ลักษณะของต้นไม้: <?php echo $row_place['treedata_detail']; ?>
                        </p>
                    </div>

                    
                    
                    <div>
                        <a class="btn btn-info" href="index.php">กลับหน้าหลัก</a>
                    </div>
                    
                </div>
                
                <div class="col-md-2">
                    
                </div>
                
            </div>            
            
            <?php } ?>            
        </div>
        <br>
        <!-- footer -->
            <?php require 'footer.php'; ?>
    </body>
</html>
