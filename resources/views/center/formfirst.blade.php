@extends('template.index')

@section('content')

    <style>
        .paragraph {

        }
    </style>


        @foreach (['green','red'] as $msg)
            @if(Session::has('alert-' . $msg))
                <div id="card-alert" class="card {{$msg}} lighten-5">
                    <div class="card-content {{$msg}}-text">
                        <p>{{Session::get('alert-'.$msg)}}</p>
                    </div>
                </div>
            @endif
        @endforeach

    <div class="row">


            <div class="row icon-block">
                <h2 class="center blue-grey-text darken-3"><i class="material-icons">cake</i></h2>
                <h5 class="center">Um presente para os Gideões Internacionais</h5>
            </div>


            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-content">
                            <form method="post" action="{{url('/ofertaformfinish')}}">

                            {{ csrf_field() }}

                            <ul class="stepper linear">
                                <li class="step active">
                                    <div class="step-title waves-effect">
                                        Passo 1
                                    </div>
                                    <div class="step-content">

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="ter_cpf" name="ter_cpf" type="text" class="validate" minlength="14" data-length="14" required>
                                                <label for="ter_cpf">CPF</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <select name="type" id="type">
                                                    <option value="BB">Boleto Bancário</option>
                                                    <option value="CC">Cartão de Crédito</option>
                                                </select>
                                                <label>Tipo de Pagamento</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="valor" name="valor" type="text" class="validate" data-length="10" maxlength="6" required>
                                                <label for="valor">Valor</label>
                                            </div>

                                            <div id="aviso-valor" class="col s12">
                                                <div class="card blue-grey darken-1">
                                                    <div class="card-content white-text">
                                                        <p class="paragraph">Que tal uma oferta de R$ 30,00 ?</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="step-actions">
                                            <button id="button-1st" class="waves-effect waves-dark btn next-step">CONTINUAR</button>

                                        </div>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Passo 2</div>
                                    <div class="step-content" id="divsecondpass">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="nome" name="nome" type="text" class="validate" data-length="30" maxlength="30" required>
                                                <label for="nome">Nome</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="email" name="email" type="email" class="validate" data-length="45" maxlength="45" required>
                                                <label for="email">Email</label>
                                            </div>
                                        </div>

                                        <div class="step-actions">
                                            <button class="waves-effect waves-dark btn next-step">CONTINUAR</button>
                                            <button class="waves-effect waves-dark btn-flat previous-step">VOLTAR</button>
                                        </div>
                                    </div>
                                </li>

                                <li class="step">
                                    <div class="step-title waves-effect">Passo 3</div>
                                    <div class="step-content">

                                        <div id="option-type">

                                        </div>

                                        <div class="step-actions">
                                            <button class="waves-effect waves-dark btn next-step">CONTINUAR</button>
                                            <button class="waves-effect waves-dark btn-flat previous-step">VOLTAR</button>
                                        </div>
                                    </div>
                                </li>

                                <li class="step">
                                    <div class="step-title waves-effect">Passo 4</div>
                                    <div class="step-content">
                                        <p>Os Gideões Internacionais agradece a sua contribuição, para finalizar clique em OFERTAR.</p>
                                        <div class="step-actions">
                                            <button class="waves-effect waves-dark btn" type="submit">OFERTAR</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


    </div>

@endsection

@section('post-script')
    <script>




        $(document).ready(function(){

            var uri = "https://online.gideoes.org.br/gideoes60anos/";


            $('#aviso-valor').hide();

           // $('#button-1st').prop( "disabled", true );

            $('#close').click(function () {
                $('#card-alert').fadeOut("slow", function () {
                });
            });

            $.get(uri+"htmlrequest/"+$("#type").val(), function (data) {
                $("#option-type").append(data);
            });

            $('select').material_select();
            $('.stepper').activateStepper();

            $('#uf').material_select();

            $("#type").change(function () {

                if($("#type").val() == 'BB') {
                    $("#type-added").remove();

                    $.get(uri+"/htmlrequest/"+$("#type").val(), function (data) {
                        $("#option-type").append(data);
                    });



                }
                else {
                    $("#type-added").remove();

                    $.get(uri+"/htmlrequest/"+$("#type").val(), function (data) {
                        $("#option-type").append(data);
                    });

                }

            });

            $('#ter_cpf').mask('000.000.000-00', {reverse: true});
            $('#valor').mask('00.000,00', {reverse: true});
            $('#validade').mask('00/0000');

           /* $("#valor").blur(function () {

                if($("#valor").val().length == 2)
                {
                    var valor  = $("#valor").val();
                    $("#valor").val(valor +',00');
                }

            });*/

            $("#valor").keyup(function() {
                var valor = $("#valor").val();

                valor = valor.replace('.','');
                valor = valor.replace(',','.');

                if(valor < 30)
                {
                    $('#aviso-valor').show();

                }
                else
                {
                    $('#aviso-valor').hide();

                }
            });



            $("#ter_cpf").blur(function () {

                    $.get(uri+"/getmember/"+$("#ter_cpf").val(), function (data) {
                        if(data)
                        {
                            $("#nome").val(data['as_nome']);
                            $("#email").val(data['as_email']);
                            $("label[for='email']").addClass('active');

                            if($("#type").val() == 'BB')
                            {
                                $("#cep").val(data['as_cep']);
                                $("#logradouro").val(data['as_end']);
                                $("label[for='logradouro']").addClass('active');
                                $("#numero").val(data['as_num']);
                                $("label[for='numero']").addClass('active');
                                $("#complemento").val(data['as_compl']);
                                $("label[for='complemento']").addClass('active');
                                $("#bairro").val(data['as_bairro']);
                                $("label[for='bairro']").addClass('active');
                                $("#cidade").val(data['as_cidade']);
                                $("label[for='cidade']").addClass('active');
                                $("#uf").val(data['as_estado']);
                                $("label[for='uf']").addClass('active');
                            }
                        }
                    });

            });

            function validateEmailDB() {
                return false;
            }


        });

    </script>
@endsection