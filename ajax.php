<?php

include 'Query.php';
$kabupatenId = (int) $_POST['kabupatenId'];
$kecamatanId = (int) $_POST['kecamatanId'];
$desaId = (int) $_POST['desaId'];
$category = empty($_POST['category']) ? [] : $_POST['category'];
$model = trim($_POST['model']);


switch ($model) :
    case 'kabupaten': echo kabupaten();
        break;
    case 'kecamatan': echo kecamatan($kabupatenId);
        break;
    case 'desa': echo desa($kecamatanId);
        break;
    case 'location' : echo location($desaId, $category);
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

function location($desaId = NULL, $category = [])
{
    if ($desaId)
        echo json_encode(Query::locations($desaId, $category));
}
