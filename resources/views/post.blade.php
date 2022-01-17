@extends("plantilla")
    @section("title")
    {{ $post[0]->titulo }}
    @endsection
        
        @section("content")
        </div>
       
        <div class="container">
            @auth
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Ver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts/editar-post/{{ $post[0]->slug }}">Editar</a>
                </li>
            </ul><br>
            @endauth
            <h2 class="post-title">{{ $post[0]->titulo }}</h2>
            <p class="post-interna-fecha">{{ $post[0]->created_at }}</p><br>
            <div class="img" style="height:600px; background-image: url('../../public/imagenes-posts/{{ $post[0]->imagen }}'); background-size:cover; background-position:center;"></div>
            <br>
            <div>
                {!!$post[0]->descripcion!!}
            </div>
        </div>
        @endsection

        @section('scripts')
        <script src="{{ url('js/eliminar-post.js') }}"></script>
        @endsection

