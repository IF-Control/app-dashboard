<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard - IF Control</title>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/app.js' !!}" defer></script>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/jquery-3.6.0.min.js' !!}"></script>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/all.min.js' !!}" defer></script>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/settings.js' !!}"></script>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/script.js' !!}" ></script>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/apexcharts.js' !!}" ></script>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/qrcode.js' !!}" ></script>
    <script src="//{!! Request::server ('HTTP_HOST').'/js/jspdf.js' !!}" ></script>

    <link href="//{!! Request::server ('HTTP_HOST').'/css/app.css' !!}" rel="stylesheet">
    <link href="//{!! Request::server ('HTTP_HOST').'/css/all.css' !!}" rel="stylesheet">
    <link href="//{!! Request::server ('HTTP_HOST').'/css/style.css' !!}" rel="stylesheet">
    <link href="//{!! Request::server ('HTTP_HOST').'/css/apexcharts.css' !!}" rel="stylesheet">

    <link href="//{!! Request::server ('HTTP_HOST').'/img/logo.png' !!}" rel="shortcut icon" type="image/x-icon">
</head>
<body>
