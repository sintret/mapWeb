/*
 * @author : Andy Fitria
 * <sintret@gmail.com>
 * simple pdo class
 * http://sintret.com
 */

var kabupatenId = $("#kabupaten").val();
var kecamatanId = $("#kecamatan").val();
var desaId = $("#desa").val();
var callback;

function kecamatan(kabupatenId) {
    var url = $("#kecamatan").data("url");

    $.ajax({
        url: url,
        type: "POST",
        data: {kabupatenId: kabupatenId, model: "kecamatan"},
        success: function (html) {
            $("#kecamatan").html(html);

            var kecamatanId = $("#kecamatan").val();
            desa(kecamatanId);

        }
    });
}

function desa(kecamatanId) {
    var url = $("#desa").data("url");

    $.ajax({
        url: url,
        type: "POST",
        data: {kecamatanId: kecamatanId, model: "desa"},
        success: function (html) {
            $("#desa").html(html);
            var desaId = $("#desa").val();
            goMap(desaId);
        }
    });
}

var map;

function goMap() {
    var url = $("#desa").data("url");
    var desaId = $("#desa").val();
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {desaId: desaId, model: "location"},
        success: function (json) {
            var locations = json.markers;
            var lat = json.lat;
            var lon = json.lon;

            //alert(JSON.stringify(json));

            var lokasi = new google.maps.LatLng(parseFloat(lat), parseFloat(lon));


            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                //center: {lat: parseFloat(lat), lng: parseFloat(lon)},
                center: lokasi,
                mapTypeId: 'terrain'
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                var pinColor = locations[i][5];
                var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                        new google.maps.Size(21, 34),
                        new google.maps.Point(0, 0),
                        new google.maps.Point(10, 34));

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                    map: map,
                    icon: pinImage,
                });

                google.maps.event.addListener(marker, "click", (function (marker, i) {
                    var contentString = '<div id="content">' +
                            '<div id="siteNotice">' +
                            '</div>' +
                            '<h1 id="firstHeading" class="firstHeading">' + locations[i][0] + '</h1>' +
                            '<div id="bodyContent">' +
                            '<p>' + locations[i][1] + '</p>' +
                            '</div>' +
                            '</div>';
                    return function () {
                        infowindow.setContent(contentString);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    });
}

$("#kabupaten").on("change", function () {
    var kabupatenId = $(this).val();
    kecamatan(kabupatenId);

});

$("#kecamatan").on("change", function () {
    var kecamatanId = $(this).val();
    desa(kecamatanId);
});

window.onload = kecamatan(kabupatenId);

$("#go").on("click", function () {

    var desaId = $("#desa").val();
    goMap(desaId);
});
