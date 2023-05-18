@extends('vendor.adminlte.page')

@section('content_header')
    <h4><a href="{{ route('encuestas') }}">Encuestas</a> > <a href="{{ route('editar_encuesta', $encuesta) }}">{{ $encuesta->nombre }}</a></h4>
    <h1>Resultados</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Votos de los usuarios del sitio</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        @foreach($encuesta->preguntas as $pregunta)
                            <?php $votos = $pregunta->opciones->sum('votos'); if($votos == 0) $votos = 1; ?>
                            <div class="col-md-6">
                                <h4>{{ $pregunta->pregunta }}</h4>
                                <p>
                                    @foreach($pregunta->opciones as $opcion)
                                        {{ $opcion->valor }} - <strong>{{ $opcion->votos }} votos</strong> (<strong class="text-primary">{{ number_format(($opcion->votos/$votos)*100, 2, ',', '.') }} %</strong>)<br>
                                    @endforeach
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection