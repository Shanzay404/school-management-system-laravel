<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @include('Frontend.Includes.css-links')
</head>

<body>
    <div id="app">
      
        <div id="main" style="background: #f0f7ff;">
            
            <div id="sidebar" class="active">
                
                @include('Frontend.Includes.sidebar')

            </div>

            <header class="mb-3">
                @include('Frontend.Includes.header')
            </header>

           @yield('content')


            <footer>
               @include('Frontend.Includes.footer')
            </footer>
        </div>
    </div>
    
    @include('Frontend.Includes.scripts')
</body>

</html>