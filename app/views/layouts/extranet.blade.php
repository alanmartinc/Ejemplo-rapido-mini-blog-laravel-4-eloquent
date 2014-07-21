<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>@yield('title')</title>
        <!-- Añadimos un ficheros css con Blade -->
        {{ HTML::style('bootstrap-3.2.0/css/bootstrap.min.css'); }}
        {{ HTML::style('bootstrap-3.2.0/css/bootstrap.spacelab.min.css'); }}
        
        <!-- Añadimos un script con Blade -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        {{ HTML::script('bootstrap-3.2.0/js/bootstrap.min.js'); }}
    </head>
    <body>
        <section class="container">
        
        <header class="col-lg-12">
            @section('header')
                <div class="bs-component">
              <div class="navbar navbar-inverse" style="border-radius:0px;">
                <div class="navbar-header">
                  <button data-target=".navbar-inverse-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a href="#" class="navbar-brand">PROBANDO LARAVEL 4</a>
                </div>
               
                </div>
              </div>
            <div class="btn btn-primary btn-xs" id="source-button" style="display: none;">&lt; &gt;</div></div>
            @show
        </header>
 
        <div class="container">
            @yield('content')
        </div>
        
        <footer class="col-lg-12">
            @section('footer')
            Copyright &COPY; Víctor Robles <?php echo date("Y"); ?>
            @show
        </footer>

        </section>
    </body>
</html>