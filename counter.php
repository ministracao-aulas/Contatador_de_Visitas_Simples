<?php
declare(strict_types=1);

if (!isset($_SESSION))
{
    session_start();
}

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

$url = $_GET['url'] ?? '';

$counter_name = filter_var($url, FILTER_VALIDATE_URL) ? getCounterName($url) : getCounterName('');

$counter_label   = "Visitors";
$counter_dir     = __DIR__."/counters/";
$counter_file    = "{$counter_dir}{$counter_name}.ctr";

if(!file_exists($counter_dir))
{
    mkdir($counter_dir);
}

if(!file_exists($counter_file))
{
    file_put_contents($counter_file, '');
}

$counter_label = $_GET['label'] ?? $counter_label;

if (($_GET['clear_count'] ?? null) == 'CLEAR')
{
    file_put_contents($counter_file, 0);
}else{
    $count = (int) file_get_contents($counter_file);

    $last_count = $_SESSION['last_count'] ?? null;

    $_SESSION['last_count'] = $last_count ?? [
        'count' => $count,
        'time'  => time(),
    ];

    if(($last_count['time'] ?? null) < (time() - 3))
    {
        $count++;
        file_put_contents($counter_file, $count);
        $_SESSION['last_count'] = [
            'count' => $count,
            'time'  => time(),
        ];
    }

    file_put_contents($counter_file, $count);
}

if ( !file_exists($counter_file) && is_numeric($_GET['set_count'] ?? null))
{
    $set_count  = (int) $_GET['set_count'];
    $count      = $set_count > 0 ? $set_count - 1 : 0;
    file_put_contents($counter_file, $count);
}

$themes = require __DIR__.'/themes.php';

$template = $_GET['template'] ?? 'pociot';

$template_content = file_exists(__DIR__."/templates/{$template}.tpl")
    ? file_get_contents(__DIR__."/templates/{$template}.tpl")
    : file_get_contents(__DIR__."/templates/pociot.tpl");

$theme = $themes[$template] ?? $themes['custom'];
$radius             = is_numeric($radius = $_GET['radius'] ?? '5') ? (int) $radius : 5;
$color_1            = $_GET['color_1']         ?? $theme['color_1'];
$color_2            = $_GET['color_2']         ?? $theme['color_2'];
$color_1_opacity    = $_GET['color_1_opacity'] ?? $theme['color_1_opacity'];
$color_2_opacity    = $_GET['color_2_opacity'] ?? $theme['color_2_opacity'];
$text_color         = $_GET['text_color']      ?? $theme['text_color'];
$label_color        = $_GET['label_color']     ?? $theme['label_color'];
$count_color        = $_GET['count_color']     ?? $theme['count_color'];

// die(var_dump($_GET));

if($count ?? null)
{
    $replaces = [
        '##LABEL##'             => $counter_label,
        '##COUNT##'             => $count,
        '##RADIUS##'            => $radius,
        '##COLOR_1##'           => $color_1,
        '##COLOR_2##'           => $color_2,
        '##COLOR_1_OPACITY##'   => $color_1_opacity,
        '##COLOR_2_OPACITY##'   => $color_2_opacity,
        '##LABEL_COLOR##'       => $label_color,
        '##COUNT_COLOR##'       => $count_color,
    ];
    // die(var_dump($replaces));
    header( 'Content-type: image/svg+xml' );
    echo $template_content = str_replace(array_keys($replaces), array_values($replaces), $template_content);
}
