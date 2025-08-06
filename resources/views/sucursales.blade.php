@extends('layout')

@section('script.header')
    
@endsection

@section('contenido')

	@if($sucursales->count())
		<section class="sucursales contenedor">		
			<div class="intro">
				<h2>@lang('textos.sucursales.titulo')</h2>
			</div>
			<ul>
				@foreach($sucursales as $sucursal)
					<li>
						<article>
							@if($sucursal->tiene('thumbnail'))
                                <div class="imagen">
                                @if(!empty($sucursal->link))
                                    <a href="{{ $sucursal->link }}" target="_blank">
                                @endif
								<img src="{{ $sucursal->url('thumbnail') }}" alt="{{ $sucursal->nombre }}">
                                @if(!empty($sucursal->link))
                                    </a>
                                @endif
                                </div>
							@endif
                            <div class="cuerpo">
                                <div class="nombre">
                                    <h3>
                                    @if(!empty($sucursal->link))
                                        <a href="{{ $sucursal->link }}" target="_blank">
                                    @endif
                                        {{ $sucursal->nombre }}
                                    @if(!empty($sucursal->link))
                                        </a>
                                    @endif
                                    </h3>
                                @if ($sucursal->email)
                                    <a href="mailto:{{ $sucursal->email }}" class="email"><i></i></a>
                                @endif
                                </div>
							    {!! $sucursal->bajada !!}
                            </div>
                        @if ($sucursal->direccion || $sucursal->horarios || $sucursal->telefono || $sucursal->email)
							<aside>
                                <p class="highlight">{{ $sucursal->direccion }}</p>
                            @if ($sucursal->horarios)
                                <p>Horarios de Atención: <br />{{ $sucursal->horarios }}</p>
                            @endif
                                <p>{{ $sucursal->telefono }}<br  />
                                @if ($sucursal->email)
                                    <a href="mailto:{{ $sucursal->email }}">{{ $sucursal->email }}</a>
                                @endif
                                </p>
                            </aside>
                        @endif
						</article>
					</li>
				@endforeach
			</ul>
		</section>
	@endif

@endsection