@extends("plantilla")
    @section("title")
    Contactanos
    @endsection
        @section("content")
        <div class="jumbotron contacto-jumbotron jumbotron-fluid">
        </div>
        <div class="container enviar-consulta">
            <h2 class="contacto-title" style="color:#00846F;">Contactanos</h2>
            <form class="agregar-post-form justify-content-center" id="formulario-de-consulta" method="post" action="/enviar-email">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="nombre" class="nombre-contact-input contact-input form-control" placeholder="Nombre">
                    </div>
                    <div class="col-sm-6">
                        <input type="mail" name="mail" class="contact-input form-control" placeholder="Email">
                    </div>
                </div>
                <br>
                <div class="row">
                        <div class="col-sm-12">
                            <textarea name="consulta" class="contact-input form-control" placeholder="Ingrese su consulta..." rows="5"></textarea>
                        </div>
                </div>
                <br>
                <button type="submit" class="contact-submit btn btn-primary" style="display: block; margin: 0 auto;">Enviar</button>
            </form>
        </div>
        <br>
        @endsection
        @section("scripts")
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ url('js/contacto.js') }}"></script>
        @endsection