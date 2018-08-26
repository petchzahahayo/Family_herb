<?php
    require '../connect/connectdb.php';

    $treealphabet_id = $_GET['treealphabet_id'];

    $sql_treename = "SELECT * FROM tree_name WHERE treealphabet_id={$treelphabet_id}";
    $res_treename = pg_query($db, $sql_treename);
?>    

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body>
            
                <div class="form-group">
                    <div class="col-md-10">
                        <select name="treename_id" id="treename_th" class="form-control">
                            <option value="">--เลือกชื่อสมุนไพร--</option>

                            <?php
                            while ($row_treename = pg_fetch_array($res_treename)) {
                                echo '<option value="' . $row_treename['treename_id'] . '">' . $row_treename['treename_th'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                </div>
            
    </body>
</html>