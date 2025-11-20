@props(["publicaciones" => []])
<ul class="listado" style="{{ $publicaciones->count() > 3 ? 'justify-content:start;':''  }}">
    @foreach($publicaciones as $publicacion)
        <li class="publicacion">
            <article>
                <div class="imagen" data-mantener-relacion-alto="80" style="background-image:url({{ $publicacion->url('thumbnail') }})"></div>
                <div class="info">
                    <h3>{{ $publicacion->titulo }}</h3>
                    {!! $publicacion->ficha?->ficha_bajada !!}
                </div>
                @if($publicacion->link)
                    <a href="{{ $publicacion->link }}" class="over" target="_blank"></a>
                @elseif($href = $publicacion->href())
                    <a href="{{ $href }}" class="over"></a>
                @endif
            </article>
        </li>
    @endforeach
    </ul>