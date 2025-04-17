<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title }}</title>
    
    @include('Admin.Includes.css-links')
</head>

<body>
    <div id="auth">

        @yield('content')

    </div>
</body>

</html>