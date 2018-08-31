<?php
    require 'connect/connectdb.php';
    
    //รับข้อมูล
    $tree_search = $_POST['tree_search'];
    $search = $tree_search . '%' ;
    
    //sql search data
    $sql_search = " SELECT * FROM tree_place
                    INNER JOIN tree_name
                    ON tree_place.treename_id = tree_name.treename_id
                    INNER JOIN tree_data
                    ON tree_name.treename_id = tree_data.treename_id
                    WHERE treename_th LIKE '$search' AND treename_th NOT IN ('ก9999')
                  ";
    $res_search = pg_query($db, $sql_search);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: rgb(241, 242, 246);">

        <?php require 'header.php'; ?>

        <div class="container">
            <div class="row">                    
                <!-- ค้นหาข้อมูลสมุนไพร -->
                <div class="col-md-3">
                    <form action="treesearch.php" method="post">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    <input name="tree_search" type="text" class="form-control" placeholder="ค้นหาชื่อต้นไม้">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
                                </td>     
                            </tr>
                        </table>
                    </form>
                </div>
                
                <!-- query data -->

                <div class="col-md-9">
                    
                    <table class="table table-bordered">
                        <tr class="info">
                            <th><center>#</center></th>
                            <th><center>ชื่อต้นไม้</center></th>
                            <th><center>ภาพต้นไม้</center></th>
                        </tr>
                        
                        <?php
                            while ($row_search = pg_fetch_array($res_search)) {
                        ?>
                        <tr>
                            <td><center><?php echo $row_search['treeplace_id']; ?></center></td>
                            <td><center>
                                <a href="tree_detail.php?treeplace_id=<?php echo $row_search['treeplace_id']; ?>"><?php echo $row_search['treename_th']; ?></a>
                            </center></td>
                            <td><center><img src="images/<?php echo $row_search['treeplace_herbimg']; ?>" style="width: 100px; height: 100px;"></center></td>
                        </tr>
                        <?php } ?>
                        <div>
                            
                        </div>
                    </table>
                </div>  
                         
        </div> <!-- row -->           
    </div> <!-- container -->

    <!-- footer -->
    <?php require 'footer.php'; ?>

</body>
</html>
