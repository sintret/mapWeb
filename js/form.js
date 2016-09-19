/*
 * @author : Andy Fitria
 * <sintret@gmail.com>
 * simple pdo class
 * http://sintret.com
 */

var kabupatenVal = $("#kabupaten").val();
var kecamatanVal = $("#kecamatan").val();

function kecamatan() {
    var url = $("#kecamatan").data("url");

    $.ajax({
        url: url,
        type: "POST",
        data: {kabupatenId: kabupatenVal, model: "kecamatan"},
        success: function (html) {
            $("#kecamatan").html(html);
        }

    });
}
//window.onload = kecamatan;
