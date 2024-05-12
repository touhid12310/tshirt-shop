<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <style>
        body {
            background: #f8f8fa;
            color: #666;  
        }
    .single-product {
        position: relative;
        overflow: hidden;
    }
    .single-product img{
        transition: transform 0.4s ease-in-out;
    }
    .single-product:hover img {
        transform: scale(1.07);
    }

    footer ul {
    list-style: none;
    padding: 0;
}

footer ul li a {
    text-decoration: none;
    color: #000;
    margin-bottom: 5px;
    display: block;
}
</style>
    @yield('style')

</head>
<body>

