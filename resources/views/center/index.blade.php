@extends('template.index')

@section('content')
    <div class="row">
        <div class="col s12 m12">
            <img class="responsive-img" src="{{ asset('assets/images/banner.jpg') }}">
        </div>
    </div>

    <!--   Icon Section   -->
    <div class="row">
        <div class="col s12 m12">
            <div class="icon-block">
                <h2 class="center blue-grey-text darken-3"><i class="material-icons">cake</i></h2>
                <h5 class="center">Um presente para os Gideões Internacionais</h5>

                <p class="light" align="justify">No dia 01 de julho completamos 119 anos de Os Gideões Internacionais. Durante esse tempo
                    ultrapassamos a marca de 2,0 bilhões de Escrituras distribuídas.<br>
                    Nesse ano de 2018 estamos também celebrando 60 anos de Os Gideões no Brasil - em janeiro de
                    1958 foi instalado, em Belo Horizonte, o primeiro campo. É uma data marcante que merece ser
                    comemorada de forma especial, principalmente porque, nesse período, mais de 200 milhões de
                    NTs foram distribuídos. Hoje vemos o fruto do nosso trabalho nas Igrejas evangélicas que
                    cresceram bastante nesse período, com certeza porque muitos foram tocados pelo Espírito
                    Santo ao ler os Novos Testamentos que distribuímos.<br>

                    Podemos fazer mais se tivermos mais recursos financeiros. Por isso, queremos convidá-lo a dar
                    um presente para Os Gideões clicando no link abaixo. Essa oferta será direcionada para o
                    Fundo Administrativo do ministério e será utilizada em diversos projetos de fortalecimento
                    dos campos.  Sabemos qual será o resultado: mais pessoas sendo alcançadas com a Palavra de Deus.</p>
            </div>
        </div>
    </div>
    <div class="row center">
        <a href="{{url('ofertaformfirst')}}" id="download-button" class="btn-large waves-effect waves-light blue-grey darken-3 pulse">Faça sua contribuição</a>
    </div>
@endsection