<?php
        require 'header_admin.php';

        $treeplace_id = $_GET['treeplace_id'];

        //herb_owner
        $sqlOwner = "SELECT * FROM tree_owner";
        $resOwner = pg_query($db, $sqlOwner);

        //herb_data
        $sqlData = "SELECT * FROM tree_name";
        $resData = pg_query($db, $sqlData);

        //herb_place
        $sqlPlace = "SELECT * FROM tree_place WHERE treeplace_id='$treeplace_id'";
        $resPlace = pg_query($db, $sqlPlace);
        $rowPlace = pg_fetch_array($resPlace);
        
        //sql herb_place lat,lng
        $sql = "SELECT * FROM tree_place WHERE treeplace_id='$treeplace_id'";
        $result = pg_query($db, $sql);
        
        $arr_json = array();
        
        while($row = pg_fetch_array($result)){
            $treeplace_lat = $row['treeplace_lat'];
            $treeplace_lng = $row['treeplace_lng'];

            //array
            $arr = array();
            $arr['treeplace_lat'] = $treeplace_lat;
            $arr['treeplace_lng'] = $treeplace_lng;
            
            array_push($arr_json, $arr);
        }
        $json = json_encode($arr_json);
        //print_r($arr_json);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>แก้ไขข้อมูลสมุนไพร</h2>
            <br>
            <form action="treeplace_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

                <!-- owner_name -->
                <div class="form-group">
                    <label for="treeowner_id" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <select name="treeowner_id" id="treeowner_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowOwner = pg_fetch_row($resOwner)) {
                                if ($rowOwner[0] == $rowPlace['treeowner_id']) {
                                    echo "<option value='$rowOwner[0]' selected>$rowOwner[1]</option>";
                                } else {
                                    echo "<option value='$rowOwner[0]'>$rowOwner[1]</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <!-- name_id -->
                <div class="form-group">
                    <label for="treename_id" class="col-md-2 control-label">ชื่อสมุนไพร :</label>
                    <div class="col-md-10">
                        <select name="treename_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
				while ($rowData = pg_fetch_row($resData)) {
                                    if ($rowData[0] == $rowPlace['treename_id']) {
					echo "<option value='$rowData[0]' selected>$rowData[1]</option>";
                                    } 
                                    else {
					echo "<option value='$rowData[0]'>$rowData[1]</option>";
                                    }
				}
                            ?>

                        </select>
						
                    </div>
                </div>

                <!-- images -->
                <div class="form-group">
                    <label for="treeplace_herbimg" class="col-md-2 control-label">รูปภาพ :</label>
                    <div class="col-md-10">
                        <img src="../images/<?php echo $rowPlace['treeplace_herbimg']; ?>" style="width:150px;height:150px;"><br><br>
                        <input type="file" name="treeplace_herbimg">
                    </div>
                </div>
                
				
				
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <div class="text-center" id="map" style="width: 300px; height: 300px;"></div>
                            <script>
                              var map;
                              var array_json = <?php echo $json ?>;
                              //alert(array_json[0].place_herb_lat);
                              
                              function initMap() 
                              {
                                var uluru = {lat: 14.96404430, lng: 101.94755060};
                                map = new google.maps.Map(document.getElementById('map'), {
                                  zoom: 8,
                                  center: uluru
                                });
                                selectLocation();
                              }
                              
                              var marker = [];
                              function selectLocation()
                              {
                                  for(var i=0; i < array_json.length; i++){
                                      var treeplace_lat = array_json[i].treeplace_lat;
                                      var treeplace_lng = array_json[i].treeplace_lng;
                                      var latlng = new google.maps.LatLng(treeplace_lat, treeplace_lng);
                                      //alert(place_herb_lat + place_herb_ng);
                                      var markeroption = {map: map, html: "", position: latlng};
                                      var marker = new google.maps.Marker(markeroption);
                                  } 
                              }
                              
                            </script>
                            <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                            </script>
                    </div>
                </div>

                <!-- button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="hidden" name="place_id" value="<?php echo $rowPlace['treeplace_id'] ?>">
                        <button name="edit_btn" type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="placetree_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>

            </form>

        </div>
    </body>
</html>
