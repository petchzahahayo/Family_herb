<?php
require 'header_admin.php';

//sql search
$sqlSearch = "  SELECT *  FROM tree_place
                    INNER JOIN tree_name  
                    ON tree_place.treename_id = tree_name.treename_id
                    INNER JOIN tree_data
                    ON tree_name.treename_id = tree_data.treename_id
                    INNER JOIN tree_typename
                    ON tree_data.treetype_id = tree_typename.treetype_id                    
                 ";
$resultSearch = pg_query($db, $sqlSearch);

$arr_json = array();
while ($rowSearch = pg_fetch_array($resultSearch)) {
    $treetype_name = $rowSearch['treetype_name'];
    $treename_th = $rowSearch['treename_th'];
    $treeplace_lat = $rowSearch['treeplace_lat'];
    $treeplace_lng = $rowSearch['treeplace_lng'];
    $treeplace_herbimg = $rowSearch['treeplace_herbimg'];

    //array
    $arr = array();
    $arr['treetype_name'] = $treetype_name;
    $arr['treename_th'] = $treename_th;
    $arr['treeplace_lat'] = $treeplace_lat;
    $arr['treeplace_lng'] = $treeplace_lng;
    $arr['treeplace_herbimg'] = $treeplace_herbimg;

    array_push($arr_json, $arr);
}
$json = json_encode($arr_json); //chang array to json
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            #map {
                height: 450px;
                width: 100%;
            }
        </style>
        <script>
            var url = window.location;
            // Will only work if string in href matches with location  

            $('ul.nav a[href="' + url + '"]').parent().addClass('active');
            // Will also work for relative and absolute hrefs  

            $('ul.nav a').filter(function () {
                return this.href === url;
            }).parent().addClass('active');
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <form action="treeplace_map2.php" method="post" >
                        <div class="input-group">  

                            <select name="search" id="search" class="form-control">
                                <option>-- เลือกประเภทต้นไม้ --</option>

                                <!-- ดึงข้อมูลจากฐานข้อมูล -->
                                <?php
                                //sql herb_type
                                $sqlType = "SELECT * FROM tree_typename";
                                $queryType = pg_query($db, $sqlType);
                                while ($rowType = pg_fetch_row($queryType)) {
                                    echo "<option value='$rowType[1]'>$rowType[1]</option>";
                                }
                                ?>
                            </select>

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>                         
                    </form>
                </div>

                <div class="col-md-3"> 
                    <form action="treeplace_map2.php" method="post" >
                        <div class="input-group">
                            <select name="treeplace_id" class="form-control">
                                <option>---เลือกต้นไม้---</option>  
                            </select>

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <br><br>
                <!-- แผนที่ -->
                <div class="row">
                    <div class="col-md-9">
                        
                        <div id="map"></div><br>
                        
                        <div class="well">
                            <h4>รายละเอียดประเภทต้นไม้</h4>
                            <p><img src="../images/icon/icon_red.png"> = ไม้ล้มลุก, 
                                <img src="../images/icon/icon_blue.png"> = ไม้ต้น,
                                <img src="../images/icon/icon_green.png"> = ไม้พุ่ม,
                                <img src="../images/icon/icon_yellow.png"> = ไม้เลื้อยมีเนื้อไม้,
                                <img src="../images/icon/icon_purple.png"> = ไม้เลื้อยไม่มีเนื้อไม้,
                                <img src="../images/icon/icon_pink.png"> = ไม้รอเลื้อย
                            </p>
                        </div>
                        
                    </div> <!-- col-md-9 -->

                    <div class="col-md-3">
                        <div class="sidebar-module">

                        </div>
                    </div><!-- col-md-3 -->
                </div> <!-- row -->

                <script>
                    var array_json = <?php echo $json ?>;
                    console.log(array_json);
                    var map;
                    var infowindow;
                    var marker;
                    var iconBase = 'http://www.phimai-angkorwat.com/herb/images/icon/';
                    var img = 'http://www.phimai-angkorwat.com/herb/images/';
                    
                    function initMap()
                    {
                        var center = {lat: 14.96404430, lng: 101.94755060};
                        map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 8,
                            center: center
                        });
                        infowindow = new google.maps.InfoWindow();
                        selectLocation();

                    } // end function

                    function selectLocation()
                    {
                        for (var i = 0; i < array_json.length; i++) {
                            var place_herbimg = array_json[i].place_herbimg;
                            var type_name = array_json[i].type_name;
                            var name_th = array_json[i].name_th;
                            var place_lat = array_json[i].place_lat;
                            var place_lng = array_json[i].place_lng;
                            
                            var content =   'ประเภท: ' + type_name + '<br>' +
                                            'ชื่อ: ' + name_th + '<br>' +
                                            '<div><img src="' + img + place_herbimg + '" style="width:200px;height:200px;"></div>';
                            
                            if (type_name === 'ไม้ต้น(Tree)') {
                                var typeA = array_json[i].name_th;
                                //console.log('ไม้ต้น(Tree)= ' + name_th);
                                var posA = new google.maps.LatLng(array_json[i].place_lat, array_json[i].place_lng);
                                var contentA = content;
                            } // ไม้ต้น(Tree)
                            
                            else if(type_name === 'ไม้ล้มลุก(herbaceous)') {
                                if (name_th === array_json[i].name_th) {
                                    //console.log(name_th);
                                    var typeB = name_th;
                                    var posB = new google.maps.LatLng(array_json[i].place_lat, array_json[i].place_lng);
                                    var contentB = content;
                                }                              
                            } // ไม้ล้มลุก(herbaceous)
                            
                            else if(type_name === 'ไม้พุ่ม(Shrubs)') {
                                if (name_th === array_json[i].name_th) {
                                    var typeC = name_th;
                                    var posC = new google.maps.LatLng(array_json[i].place_lat, array_json[i].place_lng);
                                    var contentC = content;
                                }                              
                            } // ไม้พุ่ม(Shrubs)
                            
                            else if (type_name === 'ไม้เลื้อยมีเนื้อไม้(Woody climber)') {
                                if (name_th === array_json[i].name_th) {
                                    var typeD = name_th;
                                    var posD = new google.maps.LatLng(array_json[i].place_lat, array_json[i].place_lng);
                                    var contentD = content;
                                } //if 
                            } // ไม้เลื้อยมีเนื้อไม้(Woody climber)
                            
                            else if (type_name === 'ไม้เลื้อยไม่มีเนื้อไม้(Herbaceous climber)') {
                                if (name_th === array_json[i].name_th) {
                                    var typeE = name_th;
                                    var posE = new google.maps.LatLng(array_json[i].place_lat, array_json[i].place_lng);
                                    var contentE = content;
                                }
                            } //ไม้เลื้อยไม่มีเนื้อไม้(Herbaceous climber
                            
                            else if (type_name === 'ไม้รอเลื้อย(Scandent)') {
                                if (name_th === array_json[i].name_th) {
                                    var typeF = name_th;
                                    var posF = new google.maps.LatLng(array_json[i].place_lat, array_json[i].place_lng);
                                    var contentF =  content;                                  
                                }
                            } // ไม้รอเลื้อย(Scandent)

                            var location = [
                                {//ไม้ต้น
                                    content: contentA,
                                    title: typeA,
                                    position: posA,
                                    icon: {
                                        url: iconBase + 'icon_blue.png'
                                    }
                                },
                                {
                                    content: contentB,
                                    title: typeB,
                                    position: posB,
                                    icon: {
                                        url: iconBase + 'icon_red.png'
                                    }
                                },
                                {
                                    content: contentC,
                                    title: typeC,
                                    position: posC,
                                    icon: {
                                        url: iconBase + 'icon_green.png'
                                    }
                                },
                                {
                                    content: contentD,
                                    title: typeD,
                                    position: posD,
                                    icon: {
                                        url: iconBase + 'icon_yellow.png'
                                    }
                                },
                                { 
                                    content: contentE,
                                    title: typeE,
                                    position: posE,
                                    icon: {
                                        url: iconBase + 'icon_purple.png'
                                    }
                                },
                                {
                                    content: contentF,
                                    title: typeF,
                                    position: posF,
                                    icon: {
                                        url: iconBase + 'icon_pink.png'
                                    }
                                }
                            ];

                            location.forEach(function (element) {
                                var marker = new google.maps.Marker({
                                    position: element.position,
                                    map: map,
                                    title: element.title,
                                    icon: element.icon,
                                    html: element.content
                                });

                                google.maps.event.addListener(marker, 'click', function () {
                                    infowindow.setContent(this.html);
                                    infowindow.open(map, this);
                                });
                            });

                        }// end for
                    } // end function

                </script>

                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8IYs5Jihd3Qgx6oY8BzwY5SZzQHlfwCI&callback=initMap">
                </script>
            </div>
    </body>
</html>

