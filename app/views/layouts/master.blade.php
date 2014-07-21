<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>@yield('title')</title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">-->
        
        {{ HTML::style('css/bootstrap.ubuntu.min.css'); }}
    </head>
    <body>
        <section class="container">
        
        @section('menu')
            <div class="bs-component">
              <div class="navbar navbar-default">
                <div class="navbar-header">
                  <button data-target=".navbar-inverse-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a href="{{ URL::to('/'); }}" class="navbar-brand">
                      @section('header')
                        Mini Blog con Laravel 4
                      @show
                  </a>
                </div>
                <div class="navbar-collapse collapse navbar-inverse-collapse">
                  <ul class="nav navbar-nav">
                    @section("categorias")
                    <li class="active"><a href="{{ URL::to('/usuarios/crear'); }}">Añadir</a></li>
                    @show
                  </ul>
                  
                  <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left" method="get" action="{{ URL::to('/entrada/buscar'); }}">
                    <input type="text" name="busqueda" placeholder="Buscar" class="form-control col-lg-8">
                  </form>
                  </ul>
                </div>
              </div>
            <div class="btn btn-primary btn-xs" id="source-button" style="display: none;">&lt; &gt;</div></div>
        @show

 
        <section class="container">
            <section id="entradas" class="col-lg-8">
                @yield('content')
            </section>
            
            <aside class="col-lg-4">
                <div id="login">
                <?php if(Auth::check()){ ?>
                    <h3>Bienvenido <?php echo Auth::user()->nombre;?></h3>
                <?php }else{ ?>
                    <h3>Identifícate</h3>
                    <form action="{{ URL::to('/login'); }}" method="post">
                        Correo:
                        <input type="text" name="email" class="form-control"/>
                        Contraseña:
                        <input type="password" name="password" class="form-control"/>
                        <br/>
                        <input type="submit" name="submit" value="Entrar" class="btn btn-success"/>
                        <a href="<?php echo URL::to("/registro");?>">Registrate aquí</a>
                    </form>
                <?php } ?>
                </div>
                <div id="usuario">
                    <?php if(Auth::check()){ ?>
                    <ul>
                        <li><a href="{{ URL::to('/entrada/crear'); }}">Crear entrada</a></li>
                        <li><a href="{{ URL::to('/categoria/crear'); }}">Crear categoría</a></li>
                        <li><a href="{{ URL::to('/logout'); }}">Cerrar sesión</a></li>
                    </ul>
                    <?php } ?>
                </div>
            </aside>
            
        </section>
            <div style="clear:both;"></div>
        <hr/>
        <footer>
            @section('footer')
            Copyright &COPY; Víctor Robles <?php echo date("Y"); ?>
            @show
        </footer>
        
        </section>
    </body>
</html>