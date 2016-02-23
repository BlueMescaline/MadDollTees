<h2>Contact</h2>
<div id="contact">
    <ul>
        <li><b>email:</b> maddolltees@gmail.com</li>
        <li><b>phone:</b> +381 641992 814
        </li>
</ul>
    <label for="addr">Address</label>
<ul id="addr">
    <li>Tito marsall 38.,</li>
    <li>24417 Martonos,</li>
    <li>Vojvodina, Serbia</li>
</ul>

</div>

    <style>
        #map {
            float:right;
            width: 500px;
            height: 400px;

        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
            center: new google.maps.LatLng(46.1118358,20.0442714),
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div id="map"></div>

