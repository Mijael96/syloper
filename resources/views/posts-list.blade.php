@extends("plantilla")
    @section("title")
    Posts
    @endsection
        
        @section("content")
        <div class="container">  
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            {{ $message }}
        </div>
        @endif
        <div class="alert alert-success hide d-none" role="alert">
            El post fue borrado con éxito
        </div>
            <h2 class="agregar-post-title">Lista de posts</h2>
            <table class="display" style="width:100%" id="post-list" data-page-length='15'>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Fecha de actualización</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador = 0; ?>
                    @foreach ($posts as $post)
                    <?php $contador++; ?>
                    <tr>
                        <th id="{{ $post->slug }}" scope="row">{{ $contador }}</th>
                        <td><a href="/posts/{{ $post->slug }}" style="color:black;">{{ $post->titulo }}</a></td>
                        <td>{{ $post->updated_at }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td><div class="dropdown">
                            <button style="display: block; margin: 0 auto;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">   
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="editar-item" href="/posts/editar-post/{{ $post->slug }}">Editar</a>
                                <a class="dropdown-item delete-post" data-id="{{ $post->slug }}" href="#">Eliminar</a>
                            </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endsection

        @section('scripts')
        <script src="plg/Spanish.json"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="{{ url('js/datatables.js') }}"></script>
        <script src="{{ url('js/eliminar-post.js') }}"></script>
        @endsection
