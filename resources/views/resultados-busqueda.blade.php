@extends("plantilla")
    @section("title")
    Resultados de búsqueda
    @endsection
    
        @section("content")
            <div class="container">
                <h2 class="agregar-post-title">Resultados de búsqueda</h2>
                <form method="get" action="/busqueda-posts">
                    @csrf
                    <input type="text" class="form-control typeahead" id="texto_para_buscar" name="texto_para_buscar" placeholder="Buscar posts...">
                </form>
                <br>
                @if($postBuscados->count() > 0 && $postBuscados->count() > 1)
                <p>{{ $postBuscados->count() }} resultados</p>
                @elseif ($postBuscados->count() == 1)
                <p>{{ $postBuscados->count() }} resultado</p>
                @else
                <p>No hay resultados para su búsqueda</p>
                @endif
                <br>
                <div class="resultados">
                    @if($postBuscados->count() > 0 && $postBuscados->count() > 1)
                    @foreach($postBuscados as $post)
                        <h4><a href="/posts/{{ $post->slug }}" style="color:black;">{{ $post->titulo }}</a></h4>
                        <p>{{ strip_tags(substr($post->descripcion, 0,  150)) }}</p><hr>
                    @endforeach
                    @elseif ($postBuscados->count() == 1)
                    @foreach($postBuscados as $post)
                        <h4><a href="/posts/{{ $post->slug }}" style="color:black;">{{ $post->titulo }}</a></h4>
                        <p>{{ strip_tags(substr($post->descripcion, 0,  150)) }}</p>
                    @endforeach
                    @endif
                </div>
            </div>
        @endsection
        @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="{{ url('js/buscador-autocomplete.js') }}"></script>
        @endsection

