<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo_icono.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/styleViews.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/formEmps.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}" />
    <title>@yield('Modulo Supervision')</title>
</head>

<body>
    {{-- HEADER CON NADVAR --}}
    <x-HeaderNavbar/>
    {{-- SIDEBAR  --}}
    <x-Sidebar/>
    {{-- CONTENEDOR DE LOS VISTAS  --}}
    <main class="my-5">

        @yield("ContenidoInterfaces")
        
    </main>
    {{-- FOOTER  --}}
    <x-Footer/>
</body>

    <script src="{{ asset('js/sidebarAnimation.js') }}"  ></script>
    <script src="{{ asset('js/busquedaIndex.js') }}"  ></script>
    <script src="{{ asset('js/preViewImg.js') }}"  ></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>

</html>