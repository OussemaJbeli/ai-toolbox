<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>AI-TOOLBOX</title>
        <!-- payment getway -->
        <script src="https://js.stripe.com/v3/"></script>
        <!-- axios -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- {{-- fontawsom --}} -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- {{-- chart --}} -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- {{-- logo --}} -->
        <link rel="icon" type="icon" href="/icon/logo_app/cash_icon-icons.com_51090.ico"> 
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <!-- {{-- success message --}} -->
        <page-component :success-message="{{ json_encode(session('success')) }}"></page-component>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js',"resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
