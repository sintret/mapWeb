<?php

include 'Query.php';
$kabupatenId = $_POST['kabupatenId'];
$kecamatanId = $_POST['kecamatanId'];
$model = trim($_POST['model']);


switch ($model) :
    case 'kabupaten': echo kabupaten();
        break;
    case 'kecamatan': echo kecamatan($kabupatenId);
        break;
    case 'desa': echo desa();
        break;

endswitch;

function kabupaten()
{
    $array = [];


    return $array;
}

function kecamatan($kabupatenId)
{
    $html = '';
    $kecamatans = Query::kecamatans($kabupatenId);
    if ($kecamatans)
        foreach ($kecamatans as $k => $v) {
            $html .= '<option value="' . $v->id . '">' . $v->name . '</option>';
        }

    return $html;
}

function desa()
{
    $array = [];


    return $array;
}
