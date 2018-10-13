<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>60 anos de Os Gideões no Brasil</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/materialize/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('assets/materialize/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('assets/materialize/css/materialize-stepper.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/materialize/css/prism.css') }}" type="text/css" rel="stylesheet">

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="blue-grey lighten-5">
<nav class="blue-grey darken-3" role="navigation">
    <div class="nav-wrapper container"><a href="{{url('')}}"><img src="{{ asset('assets/images/logo-gideoes.png')  }}" height="50px"></a>
        <ul class="right hide-on-med-and-down">
            <li><a class="white-text" href="{{url('ofertaformfirst')}}">Ofertar</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a class="white-text" href="{{url('ofertaformsecond')}}">Minhas Ofertas</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a class="white-text" href="{{url('')}}">Home</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav blue-grey darken-3">
            <li><a class="white-text" href="{{url('')}}">Home</a></li>
            <li><a class="white-text" href="{{url('ofertaformfirst')}}">Ofertar</a></li>
            <li><a class="white-text" href="{{url('ofertaformsecond')}}">Minhas Ofertas</a></li>
        </ul>

        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="container">
    <div class="section">

        @yield('content')

    </div>
    <br><br>
</div>

<footer class="page-footer blue-grey darken-3">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Política de Privacidade</h5>
                <p class="grey-text text-lighten-4">Os Gideões Internacionais no Brasil" criou esta declaração para demonstrar nosso firme comprometimento com
                    a sua privacidade. Nós somos responsáveis perante Deus por proteger qualquer informação que você nos fornecer.</p>


            </div>

            <div class="col l3 s12">
                <h5 class="white-text">Contatos</h5>
                <ul>
                    <li><i class="tiny material-icons">phone_android</i> +55 (19)3744-3700</li>
                    <li><i class="tiny material-icons">email</i> gideoes@gideoes.org.br</li>
                    <li><i class="tiny material-icons">home</i> <a class="white-text" href="http://www.gideoes.org.br">http://www.gideoes.org.br</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Feito por <a class="brown-text text-lighten-3"  href="http://www.gideoes.org.br">Os Gideões Internacionais no Brasil</a>
        </div>
    </div>
</footer>


<!--  Scripts-->

<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ asset('assets/materialize/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/materialize/js/materialize.js') }}"></script>
<script src="{{ asset('assets/materialize/js/init.js') }}"></script>
<script src="{{ asset('assets/materialize/js/materialize-stepper.js') }}"></script>
<script src="{{ asset('assets/materialize/js/prism.js') }}"></script>
<script src="{{ asset('assets/singlejs/jquery.mask.js') }}"></script>


@yield('post-script')

</body>
</html>
