@extends('template.index')

@section('content')
    <div class="row icon-block">
        <h5 class="center">Ofertas</h5>
    </div>

    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="ter_cpf" name="ter_cpf" type="text" class="validate" minlength="14" data-length="14" required>
                            <label for="ter_cpf">CPF</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="grid-table">

    </div>



@endsection

@section('post-script')

    <script>
        $(document).ready(function(){

            var uri = "https://online.gideoes.org.br/gideoes60anos/";

            $("#ter_cpf").blur(function () {
                $("#grid-table").empty();
                $.get(uri+"/ofertarequest/"+$("#ter_cpf").val(), function (data) {
                    $("#grid-table").append(data);
                });
            });

            $('#ter_cpf').mask('000.000.000-00', {reverse: true});
        });


    </script>






@endsection