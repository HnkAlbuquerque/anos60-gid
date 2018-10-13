<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <table>
                        <thead>
                        <tr>
                            <th>Vencimento</th>
                            <th>Valor</th>
                            <th>Tipo</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($arrayBB as $bb)
                            <tr>
                                    <td>{{$bb->vencimento}}</td>
                                    <td>R$ {{$bb->valor}}</td>
                                    <td>{{$bb->tipo}}</td>
                            </tr>
                        @endforeach

                        @foreach($arrayCC as $cc)
                            <tr>
                                <td>{{$cc->vencimento}}</td>
                                <td>R$ {{$cc->valor}}</td>
                                <td>{{$cc->tipo}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>