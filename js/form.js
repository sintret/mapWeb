/*
 * @author : Andy Fitria
 * <sintret@gmail.com>
 * simple pdo class
 * http://sintret.com
 */

var kabupatenId = $("#kabupaten").val();
var kecamatanId = $("#kecamatan").val();
var desaId = $("#desa").val();

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
