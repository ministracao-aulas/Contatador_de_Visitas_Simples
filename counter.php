<?php
declare(strict_types=1);

//Contador de visitas simples
//A basic visitor count

function getCounterName(string $input)
{
    $nome = strlen($input) > 5 ? $input : '_DEFAULT_COUNTER_';
    $nome = strtolower(str_replace(['https://', 'http://'], '', $nome));
    $nome = implode('-', parse_url($nome));
    $nome = 'counter_'.strtolower(str_replace(['https-', 'http-', '/', '--', '=', ' ', '#'], '-', $nome));
    return $nome;
}

$contador = getCounterName($_GET['site'] ?? $_GET['link'] ?? '');

$counter_title   = "Visitor";
$counter_dir     = __DIR__."/counters/";
$counter_file    = "{$counter_dir}{$contador}.ctr";

if(!file_exists($counter_dir))
{
    mkdir($counter_dir);
}

if(!file_exists($counter_file))
{
    file_put_contents($counter_file, '');
}

$counter_title = $_GET['texto'] ?? $counter_title;

if (($_GET['clear_count'] ?? null) == 'CLEAR')
{
    file_put_contents($counter_file, 0);
}else{
    $count = (int) file_get_contents($counter_file);
    $count = $count + 1;
    file_put_contents($counter_file, $count);
}

if (is_numeric($_GET['set_count'] ?? null))
{
    $set_count  = (int) $_GET['set_count'];
    $count      = $set_count > 0 ? $set_count - 1 : 0;
    file_put_contents($counter_file, $count);
}

$template = $_GET['template'] ?? 'pociot';
$template_content = file_exists(__DIR__."/templates/{$template}.html")
    ? file_get_contents(__DIR__."/templates/{$template}.html")
    : file_get_contents(__DIR__."/templates/span.html");

$radius     = is_numeric($radius = $_GET['radius'] ?? '5') ? (int) $radius : 5;
$color_1    = $_GET['color_1'] ?? '#00ff00';
$color_2    = $_GET['color_2'] ?? $color_1;
$color_1_opacity = $_GET['color_1_opacity'] ?? '0.5';
$color_2_opacity = $_GET['color_2_opacity'] ?? $color_1_opacity;
$text_color  = $_GET['text_color'] ?? '#000';
$title_color = $_GET['title_color'] ?? $text_color;
$count_color = $_GET['count_color'] ?? $title_color;

if($count ?? null)
{
    $replaces = [
        '##TITLE##' => $counter_title,
        '##COUNT##' => $count,
        '##RADIUS##' => $radius,
        '##COLOR_1##' => $color_1,
        '##COLOR_2##' => $color_2,
        '##COLOR_1_OPACITY##' => $color_1_opacity,
        '##COLOR_2_OPACITY##' => $color_2_opacity,
        '##TITLE_COLOR##' => $title_color,
        '##COUNT_COLOR##' => $count_color,
    ];

    echo $template_content = str_replace(array_keys($replaces), array_values($replaces), $template_content);
}
