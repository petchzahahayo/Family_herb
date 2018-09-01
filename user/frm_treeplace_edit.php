<?php
        require 'header_user.php';

        $treeplace_id = $_GET['treeplace_id'];

        //herb_owner
        $sqltreeOwner = "SELECT * FROM tree_owner";
        $restreeOwner = pg_query($db, $sqltreeOwner);

        //herb_data
        $sqltreeData = "SELECT * FROM tree_name";
        $restreeData = pg_query($db, $sqltreeData);

        //herb_place
        $sqltreePlace = "SELECT * FROM tree_place WHERE treeplace_id='$treeplace_id'";
        $restreePlace = pg_query($db, $sqltreePlace);
        $rowtreePlace = pg_fetch_array($restreePlace);
        
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
            <h2>แก้ไขข้อมูลต้นไม้</h2>
            <br>
            <form action="treeplace_edit.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

                <!-- owner_name -->
                <div class="form-group">
                    <label for="treeowner_id" class="col-md-2 control-label">ชื่อ :</label>
                    <div class="col-md-10">
                        <select name="treeowner_id" id="treeowner_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
                            while ($rowtreeOwner = pg_fetch_row($restreeOwner)) {
                                if ($rowtreeOwner[0] == $rowtreePlace['treeowner_id']) {
                                    echo "<option value='$rowtreeOwner[0]' selected>$rowtreeOwner[1]</option>";
                                } else {
                                    echo "<option value='$rowtreeOwner[0]'>$rowtreeOwner[1]</option>";
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>

                <!-- name_id -->
                <div class="form-group">
                    <label for="treename_id" class="col-md-2 control-label">ชื่อต้นไม้ :</label>
                    <div class="col-md-10">
                        <select name="treename_id" class="form-control">

                            <!-- ดึงข้อมูลจากฐานข้อมูล -->
                            <?php
				while ($rowtreeData = pg_fetch_row($restreeData)) {
                                    if ($rowtreeData[0] == $rowtreePlace['treename_id']) {
					echo "<option value='$rowtreeData[0]' selected>$rowtreeData[1]</option>";
                                    } 
                                    else {
					echo "<option value='$rowtreeData[0]'>$rowtreeData[1]</option>";
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
                        <img src="../images/<?php echo $rowtreePlace['treeplace_herbimg']; ?>" style="width:150px;height:150px;"><br><br>
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
                        <input type="hidden" name="treeplace_id" value="<?php echo $rowtreePlace['treeplace_id'] ?>">
                        <button name="edit_btn" type="submit" class="btn btn-primary">แก้ไข</button>
                        <a href="placetree_manage.php" class="btn btn-danger">กลับหน้าหลัก</a>
                    </div>
                </div>
                <br><br>

            </form>

        </div>
    </body>
</html>
