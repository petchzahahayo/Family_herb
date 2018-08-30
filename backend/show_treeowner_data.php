<?php
    require 'header_admin.php';

    if (isset($_GET['treeowner_id'])) {
        //รับข้อมูล
        $treeowner_id = $_GET['treeowner_id'];

        $sql = "SELECT * FROM tree_owner WHERE treeowner_id='$treeowner_id'";
        $result = pg_query($db, $sql);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <h2>ข้อมูลเจ้าของ</h2>
            <table class="table table-bordered">

                <!-- show data -->
                <?php while ($row = pg_fetch_array($result)) { ?>
                    <tr>
                        <th class="info">ชื่อ</th>
                        <td><?php echo $row['treeowner_name'] ?></td>
                    </tr>

                    <tr>
                        <th class="info">ที่อยู่</th>
                        <td><?php echo $row['treeowner_address'] ?></td>
                    </tr>

                    <tr>
                        <th class="info">รูปภาพ</th>
                        <td><img src="../images/owner/<?php echo $row['treeowner_image']; ?>" style="width:100px;height:100px;"></td>
                    </tr>

                    <!-- owner_age -->
                    <tr>
                        <th class="info">อายุ</th>
                        <td><?php echo $row['treeowner_age'] ?></td>
                    </tr>

                    <!-- owner_education -->
                    <tr>
                        <th class="info">การศึกษา</th>
                        <td><?php echo $row['treeowner_education'] ?></td>
                    </tr>

                    <!-- owner_career -->
                    <tr>
                        <th class="info">อาชีพ</th>
                        <td><?php echo $row['treeowner_career']. " " .$row['treeowner_career2'] ?></td>
                    </tr>

                    <!-- owner_revenue-->
                    <tr>
                        <th class="info">รายได้</th>
                        <td><?php echo $row['treeowner_revenue'] ?></td>
                    </tr>

                    <!-- owner_health-->
                    <tr>
                        <th class="info">โรคประจำตัว</th>
                        <td>
                            <?php echo $row['treeowner_health'] . " " . $row['treeowner_health2']; ?>
                        </td>
                    </tr>
                <?php } ?>

                <!-- map -->
                <?php
                $sqlPosition = "SELECT * FROM tree_owner WHERE treeowner_id='$treeowner_id'";
                $resultPosition = pg_query($db, $sqlPosition);
                $arr_json = array();
                while ($rowPosition = pg_fetch_array($resultPosition)) {
                    $treeowner_lat = $rowPosition['treeowner_lat'];
                    $treeowner_lng = $rowPosition['treeowner_lng'];

                    //array
                    $arr = array();
                    $arr['treeowner_lat'] = $treeowner_lat;
                    $arr['treeowner_lng'] = $treeowner_lng;

                    array_push($arr_json, $arr);
                }
                $json = json_encode($arr_json);
                //print_r($arr_json);
                pg_close($db);
                ?>
                <tr>
                    <th class="info">ตำแหน่ง</th>
                    <td>
                        <!-- Map -->
                        <div id="map" style="width: 100%; height: 300px;"></div>

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
                                for (var i = 0; i < array_json.length; i++) {
                                    var treeowner_lat = array_json[i].treeowner_lat;
                                    var treeowner_lng = array_json[i].treeowner_lng;
                                    var latlng = new google.maps.LatLng(treeowner_lat, treeowner_lng);
                                    //alert(owner_lat + owner_lng);
                                    var markeroption = {map: map, html: "", position: latlng};
                                    var marker = new google.maps.Marker(markeroption);
                                }
                            }

                        </script>
                        <script src="../bootstrap/js/bootstrap.min.js"></script>
                        <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                        </script>

                    </td>
                </tr>


            </table>

            <!-- button -->
            <a href="treeowner_manage.php" class="btn btn-danger" >
                กลับหน้าหลัก
            </a>
        </div>  
        <br><br>
    </body>
</html>

