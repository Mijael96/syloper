@extends("plantilla")
    @section("title")
    Nuestros Posts
    @endsection
        @section("content")
        <div class="container">
            <h2 class="lo-ultimo">Lo último en nuestro blog</h2>
            <form method="get" action="/busqueda-posts">
                @csrf
                <input type="text" class="form-control typeahead" id="texto_para_buscar" name="texto_para_buscar" placeholder="Buscar posts...">
            </form>
            <div class="row d-flex justify-content-between article-grid">
                @foreach($posts as $post)
                <div class="col-md-4 article-card">
                    <div class="card" style="display:block; margin: 0 auto;">
                        <a href="/posts/{{ $post->slug }}"><img class="card-img-top" src="../../public/imagenes-posts/{{ $post->imagen }}" style="height: 270px;" alt="Card image cap"></a>
                        <div class="card-body cuerpo-card" style="height: 270px; position: relative;">
                            <p class="fecha">{{ $post->updated_at }}</p>
                            <h5 class="card-title"><a href="/posts/{{ $post->slug }}">{{ $post->titulo }}</a></h5>
                            <p class="card-text">{{ strip_tags(substr($post->descripcion, 0,  150)) }}</p>
                            <a href="/posts/{{ $post->slug }}" class="read-more" style="">Leer más</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endsection
        @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="{{ url('js/buscador-autocomplete.js') }}"></script>
        @endsection