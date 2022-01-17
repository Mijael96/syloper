@extends("plantilla")
    @section("title")
    Agregar post
    @endsection
        
        @section("content")
        <div class="container agregar-post">
            <h2 class="agregar-post-title">Agregar Post</h2>
            <form class="agregar-post-form" id="agregar-post-form" method="POST" action="/agregar-post" accept-charset="UTF-8" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Título</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Imagen</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="imagen" id="imagen">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Descripción</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="5" name="descripcion" id="descripcion-editor"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Slug</label>
                    <div class="col-sm-9">
                        <span style="font-size: 9px; margin-bottom:5px;">Si no rellena este campo el slug se generará automaticamente</span>
                        <input type="text" class="form-control" placeholder="Slug" id="slug" name="slug">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary button-submit" style="display: block; margin: 0 auto;">Agregar post</button>
            </form>
        </div>
        @endsection

        @section("scripts")
        <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ url('js/agregar-post.js') }}"></script>
        @endsection

