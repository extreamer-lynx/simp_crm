<?php
/**
 * @var $Head string
 * @var $Info string
 * @var $Coordinates string
 */
?>
<div class="container">
    <div class="py-5 text-center">
        <h2><?=$Head?></h2>
    </div>

    <div class="py-2 text-left">
        <p class="lead"><?=$Info?></p>
    </div>

    <div class="py-2 text-left">
        <div id="map_canvas"><?=$Coordinates?></div>
    </div>
</div>

<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script>
    function initialize() {

        let mapBox = document.getElementById('map_canvas')
        let coords = mapBox.innerText
        mapBox.innerText = ''
        let map = new google.maps.Map(mapBox,
            { zoom: 16, mapTypeId: google.maps.MapTypeId.ROADMAP});
        let location = new google.maps.LatLng(coords.substr(0,coords.indexOf(',')), coords.substr(coords.indexOf(',')+1));
        map.setCenter(location);

        let infowindow = new google.maps.InfoWindow();
        infowindow.setPosition(location);

        infowindow.open(map);
    };

    initialize();
</script>