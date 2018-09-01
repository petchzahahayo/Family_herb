<?php 
        require 'header_admin.php';
        
        @$tumbon_id = $_GET['animal_tumbon_id'];
        @$tumbon = $_GET['animal_tumbon_name'];
        //name
        $sql_treename = "SELECT * FROM animal_tumbon WHERE animal_tumbon_id='$tumbon_id'";
        $res_treename = pg_query($db, $sql_treename);
        $row_treename = pg_fetch_array($res_treename);
        
       
?>

<?php   
 
 if (@$_GET['insert'])  {

     @$tumbon_name = @$_GET['animal_tumbon_name'];
     @$sql = "UPDATE animal_tumbon SET animal_tumbon_name='$tumbon_name'";
    @$result = pg_query($db, $sql);

}



  ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="animalcript.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขชื่อชุมชน</h2>
            <br>
            <form action="insert" method="GET" enctype="multipart/form-data" class="form-horizontal">
                
                <!-- name_th -->
                <div class="form-group">
                    <label for="animal_tumbon_name" class="col-md-2 control-label">ชื่อชุมชน :</label>
                    <div class="col-md-10">
                        <input name="animal_tumbon_name" type="text" class="form-control" value="<?php echo $row_treename['animal_tumbon_name']; ?>">
                    </div>
                </div>   

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input name="animal_tumbon_name" type="hidden" value="<?php echo $row_treename['animal_tumbon_name']; ?>">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        <a href="a_animal_tumbon_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                
            </form>
            
        </div>
    </body>
</html>
