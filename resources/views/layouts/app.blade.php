<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://kit.fontawesome.com/de25909b6f.js" crossorigin="anonymous" defer></script>
  {{-- Para que me tome los icosnos de fontawesome y se le pone el defer para que el crip se ejecute al final de la pagina --}}

  <!-- Link de Chart.js paragraficar -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


</head>

<body>


  @include('layouts.navbar')

  <div class="main" id="app">
    {{--  Mensaje de validacion exitosamente. Carpeta en views partials --}}
    @include('messages.session-status')
    {{-- endInclude --}}
    @yield('content')
  </div>


  @include('layouts.footer')
  </div>


</body>

{{-- Inint Grafic --}}

{{-- <script>
  var order=[];
  var values=[];

    $(document).ready(function(){
      $.ajax({
        url: '/admin/report',
        method:'GET'
      }).done(function(res){
          var arreglo = JSON.parse(res);

          for(var x=0;x<arreglo.length;x++>){
            order.push(arreglo[x].status);
            values.push(arreglo[x].created_at);

          }
        });

    });
</script> --}}

{{-- EndGrafic

</html>