/*
 * @author : Andy Fitria
 * <sintret@gmail.com>
 * simple pdo class
 * https://sintret.com
 */

var kabupatenId = $("#kabupaten").val();
var kecamatanId = $("#kecamatan").val();
var desaId = $("#desa").val();
var callback;



function kecamatan(kabupatenId) {
    var url = $("#kecamatan").data("url");
    var categories = [];
    $.each($("input[name='category']:checked"), function () {
        categories.push($(this).val());
    });

    $.ajax({
        url: url,
        type: "POST",
        data: {kabupatenId: kabupatenId, model: "kecamatan", category: categories},
        success: function (html) {
            $("#kecamatan").html(html);

            desa($("#kecamatan").val());
        }
    });
}

function desa(kecamatanId) {
    var url = $("#desa").data("url");
    var categories = [];
    $.each($("input[name='category']:checked"), function () {
        categories.push($(this).val());
    });

    $.ajax({
        url: url,
        type: "POST",
        data: {kecamatanId: kecamatanId, model: "desa", category: categories},
        success: function (html) {
            $("#desa").html(html);
            goMap($("#desa").val());
        }
    });
}


//initialize map
var map;

function goMap() {
    var url = $("#desa").data("url");
    var desaId = $("#desa").val();
    var categories = [];
    $.each($("input[name='category']:checked"), function () {
        categories.push($(this).val());
    });

    if (desaId == null) {
        goDefault();

        return;
    }

    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {desaId: desaId, model: "location", category: categories},
        success: function (json) {
            var locations = json.markers;
            var lat = json.lat;
            var lon = json.lon;

            if (lat == null) {
                goDefault();

                return;
            }

            //alert(JSON.stringify(json));

            var lokasi = new google.maps.LatLng(parseFloat(lat), parseFloat(lon));

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                //center: {lat: parseFloat(lat), lng: parseFloat(lon)},
                center: lokasi,
                mapTypeId: 'terrain'
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            if (locations !== undefined) {
                for (i = 0; i < locations.length; i++) {
                    var pinColor = locations[i][5];
                    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                            new google.maps.Size(21, 34),
                            new google.maps.Point(0, 0),
                            new google.maps.Point(10, 34));

                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
                        map: map,
                        icon: pinColor,
                    });

                    google.maps.event.addListener(marker, "click", (function (marker, i) {

                        var images = "";
                        var imagesLocation = locations[i][6];

                        if (imagesLocation) {
                            images += "<p>";

                            var res = imagesLocation.split("aaiiaa");
                            for (var t = 0; t < res.length; t++) {
                                var c = res[t].replace(/iiuuii/g, '/');
                                images += '<img width="120px" src="' + c + '"> ';
                            }

                            console.log(res.length);
                            images += "</p>";

                        }

                        var contentString = '<div id="content">' +
                                '<div id="siteNotice">' +
                                '</div>' +
                                '<h3 id="firstHeading" class="firstHeading">' + locations[i][0] + '</h3>' +
                                '<div id="bodyContent">' +
                                '<p>' + locations[i][1] + '</p>' +
                                images +
                                // '<p><img width="120px" src="' + locations[i][6] + '"</p>' +
                                //'<p>' +
                                '</div>' +
                                '</div>';
                        return function () {
                            infowindow.setContent(contentString);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }

        }
    });
}

function goDefault() {
    var lokasi = new google.maps.LatLng(parseFloat(-3.8494096), parseFloat(111.1584309));

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        //center: {lat: parseFloat(lat), lng: parseFloat(lon)},
        center: lokasi,
        mapTypeId: 'terrain'
    });

}

$("#kabupaten").on("change", function () {

    kecamatan($(this).val());
});

$("#kecamatan").on("change", function () {

    desa($(this).val());
});

$("#go").on("click", function () {

    goMap($("#desa").val());
});

//window.onload = kecamatan(kabupatenId);