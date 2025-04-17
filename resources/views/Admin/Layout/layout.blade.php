<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @include('Admin.Includes.css-links')
</head>

<body>
    <div id="app">
      
        <div id="main" style="background: #f0f7ff;">
            
            <div id="sidebar" class="active">
                
                @include('Admin.Includes.sidebar')

            </div>

            <header class="mb-3">
                @include('Admin.Includes.header')
            </header>

           @yield('content')


            <footer>
               @include('Admin.Includes.footer')
            </footer>
        </div>
    </div>
    
    @include('Admin.Includes.scripts')
</body>

</html>