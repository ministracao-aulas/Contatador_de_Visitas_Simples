<?php
declare(strict_types=1);

//Contador de visitas simples

function getNomeContador(string $input)
{
    $nome = strlen($input) > 5 ? $input : '_CONTADOR_GENERICO_';
    $nome = strtolower(str_replace(['https://', 'http://'], '', $nome));
    $nome = implode('-', parse_url($nome));
    $nome = 'count-'.strtolower(str_replace(['https-', 'http-', '/', '--', '=', ' ', '#'], '-', $nome));
    return $nome;
}

$contador = getNomeContador($_GET['site'] ?? $_GET['link'] ?? '');

$texto_contador   = "Número de visitas";
$pasta_contadores = __DIR__."/contadores/";
$arquivo          = "{$pasta_contadores}{$contador}.ctr";

if(!file_exists($pasta_contadores))
{
    mkdir($pasta_contadores);
}

if(!file_exists($arquivo))
{
    file_put_contents($arquivo, '');
}

if (isset($_GET['texto']))
{
    $texto_contador = $_GET['texto'];
}

if (isset($_GET['limpar']))
{
    file_put_contents($arquivo, 0);
}else{
    $count = (int) file_get_contents($arquivo);
    $count = $count + 1;
    file_put_contents($arquivo, $count);
}

if (isset($_GET['valor']) && is_numeric($_GET['valor']))
{
    $valor = (int) $_GET['valor'];
    $count = $valor > 0 ? $valor - 1 : 0;
    file_put_contents($arquivo, $count);
}

if($count ?? null)
{
    echo "<span class='page-view'>$texto_contador: " . $count . "</span>";
}