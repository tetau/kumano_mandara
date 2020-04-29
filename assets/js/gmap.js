function initialize() {

//マップの中心座標
var myLatLng = new google.maps.LatLng(33.677133, 135.379210);

//マップの設定オプション
var myOptions = {
    zoom: 14,
    center: myLatLng,
    disableDefaultUI: true,
    disableDoubleClickZoom: false,
    mapTypeControl: true,
    scrollwheel: false,
    draggable: false,
    zoomControl: true,
    zoomControlOptions: {
        style: google.maps.ZoomControlStyle.DEFAULT,
        position: google.maps.ControlPosition.LEFT_BOTTOM
    },
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControlOptions: {
        mapTypeIds: [
            //google.maps.MapTypeId.ROADMAP
            ]
        }
    };

//マップの表示ID
map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

//マーカーの設定オプション
var obj={
    position:new google.maps.LatLng(33.677133, 135.379210),
    map:map,
    animation: google.maps.Animation.DROP
};
var marker=new google.maps.Marker(obj);

// var haccastyle = [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}];
 // var styledMapOptions = {name: "地図"};
 // var haccaMapType = new google.maps.StyledMapType(haccastyle, styledMapOptions);
 // map.mapTypes.set('simple', haccaMapType);
 // map.setMapTypeId('simple');
}
