<?php

function getBaseHost()
{
    if (!($_SERVER['SERVER_NAME'] ?? null))
    {
        return 'http://'.$_SERVER['HTTP_HOST'];
    }

    $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';

    $base = $_SERVER['PROTOCOL'] . '://' . $_SERVER['SERVER_NAME'];

    if ($_SERVER['SERVER_PORT'] != 80)
    {
        $base .= ':' . $_SERVER['SERVER_PORT'];
    }

    return $base;
}

function getCounterName(string $input)
{
    $nome = strlen($input) > 5 ? $input : '_DEFAULT_COUNTER_';
    $nome = strtolower(str_replace(['https://', 'http://'], '', $nome));
    $nome = implode('-', parse_url($nome));
    $nome = 'counter_'.strtolower(str_replace(['https-', 'http-', '/', '--', '=', ' ', '#'], '-', $nome));
    return $nome;
}

function dd(...$args)
{
    die(var_dump(...$args));
}
