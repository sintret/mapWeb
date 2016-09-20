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
    case 'desa': echo desa($kecamatanId);
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
    $num = 1;
    if ($kecamatans)
        foreach ($kecamatans as $k => $v) {
            $selected = $num == 1 ? ' selected ' : '';
            $html .= '<option value="' . $v->id . '" ' . $selected . ' >' . $v->name . '</option>';

            $num++;
        }

    return $html;
}

function desa($kecamatanId)
{
    $html = '';
    $desas = Query::desas($kecamatanId);
    $num = 1;
    if ($desas)
        foreach ($desas as $k => $v) {
            $selected = $num == 1 ? ' selected ' : '';
            $html .= '<option value="' . $v->id . '"   ' . $selected . '>' . $v->name . '</option>';

            $num++;
        }

    return $html;
}
