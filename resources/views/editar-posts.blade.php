@extends("plantilla")
    @section("title")
    Editar {{ $post[0]->title }}
    @endsection
        
        @section("content")
        <div class="container agregar-post">
        @auth
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="/posts/{{ $post[0]->slug }}">Ver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/posts/editar-post/{{ $post[0]->slug }}">Editar</a>
                </li>
            </ul><br>
        @endauth
            <h2 class="editar-post-title" id="{{ $post[0]->slug }}">Editar Post</h2>
            <form class="agregar-post-form" id="agregar-post-form" method="post" action="/posts/editar-post/{{ $post[0]->slug }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Título</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo" value="{{ $post[0]->titulo }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Imagen</label>
                    <div class="col-sm-9">
                        <img src="../../public/imagenes-posts/{{ $post[0]->imagen }}" style="width: 100%; max-height:500px;">
                        <br><br>
                            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Modificar imagen
                            </a>
                    </div>
                </div>

                <div class="form-group row collapse" id="collapseExample">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Imagen nueva</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="imagen-nueva" id="imagen-nueva">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Descripción</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="5" name="descripcion" id="descripcion-editor">{{ $post[0]->descripcion }}</textarea>
                    </div>
                </div>
            
                <button type="submit" class="btn btn-primary button-submit" style="display: block; margin: 0 auto;">Editar post</button>
            </form>
        </div>
        @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
        @endforeach
        @endsection
        @section('scripts')
        <script>
            ClassicEditor
            .create(document.querySelector('#descripcion-editor'))
            .catch(error => {
                console.error(error);
            });
        </script>
        <script src="{{ url('js/eliminar-post.js') }}"></script>
        @endsection
