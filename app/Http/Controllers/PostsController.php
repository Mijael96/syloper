<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\File;

class PostsController extends Controller
{   

    public function agregarPostForm(){
        return view('agregar-post');
    }

    public function validador($peticion){
        $reglas = [
            "titulo" => "required|string|min:3|max:100",
            "slug" => "unique:posts|nullable|string|min:3|max:100",
            "descripcion" => "required|string|min:3",
        ];

        $mensajes = [
            "required" => "El campo :attribute es obligatorio",
            "string" => "El campo :attribute debe ser texto",
            "alpha" => "El campo :attribute debe ser texto",
            "min" => ":attribute debe tener al menos :min caractéres",
            "max" => ":attribute no debe pasar los :max caractéres",
            "unique" => "El :attribute ingresado ya está en uso",
        ];

        if($peticion!="agregar"){
            $reglas["imagen"] = "mimes:jpeg,png,jpg"; 
            $reglas["imagenNueva"] = "mimes:jpeg,png,jpg";
        } else{
            $reglas["imagen"] = "required|mimes:jpeg,png,jpg";  
        }

        $arrayParaValidar[0]=$reglas;
        $arrayParaValidar[1]=$mensajes;

        return $arrayParaValidar;
    }

    public function prepareSlug($slug, $titulo){
        if(!empty($slug) && !is_null($slug)){
            $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
            $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby';
            $cadena = utf8_decode($slug);
            $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
            $slugFinal= str_replace(' ', '-', $cadena);
            return $slugFinal;
        }else{
            $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
            $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby';
            $cadena = utf8_decode($titulo);
            $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
            $slugFinal= str_replace(' ', '-', $cadena);
            if (DB::table('posts')->where('slug', $slugFinal)->exists()){
                return $slugFinal."-0";
            } else {
                return $slugFinal;
            }
        }
    }

    public function agregarPost(Request $req){
    
        $validador = Validator::make($req->all(), $this->validador($peticion="agregar")[0],$this->validador($peticion="agregar")[1]);

        if($validador->fails()){
            return response()->json([
                "status"=>400,
                "errors"=>$validador->messages()
            ]);
        } 
        else {
            $nuevoPost = new Posts();
            $nuevoPost->titulo = trim(ucfirst(mb_strtolower($req["titulo"],"UTF-8" )));
            $nuevoPost->slug = $this->prepareSlug(trim(mb_strtolower($req["slug"],"UTF-8" )), mb_strtolower($nuevoPost->titulo, "UTF-8" ));
            $nuevoPost->descripcion = trim(ucfirst(mb_strtolower($req["descripcion"],"UTF-8" )));

            

            if($req->hasFile('imagen')){
                $file = $req->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' .$extension;
                $file->move('public/imagenes-posts', $filename);
                $nuevoPost->imagen = $filename;
            }

            $nuevoPost->save();
            return response()->json([
                'status' => 200,
                'message' => $nuevoPost->titulo,
            ]);
        }
    }

    public function postForIndex(){
        $posts = DB::table('posts')->orderBy('updated_at', 'desc')->take(12)->get();
        return view("index", compact("posts"));
    }

    public function retornarPosts(){
        $posts = DB::table('posts')->orderBy('updated_at', 'desc')->get();
        return view("posts-list", compact("posts"));
    }

    public function returnPost($slug){
        $post = Posts::where("slug","=",$slug)->get();
        return view("post", compact("post"));
    }

    public function buscarPosts(Request $req){
        $datas = Posts::select("titulo")
        ->where("titulo","LIKE","%{$req->input('texto_para_buscar')}%")
        ->get();
        $dataModified = array();
        foreach ($datas as $data)
        {
            $dataModified[] = $data->titulo;
        }

        return response()->json($dataModified);
    }

    public function postsBusqueda(Request $req){
        $postBuscados = Posts::select("titulo","slug","descripcion")
        ->where("titulo","LIKE","%{$req->input('texto_para_buscar')}%")
        ->orWhere('descripcion',"LIKE","%{$req->input('texto_para_buscar')}%")
        ->get();
        return view("resultados-busqueda", compact("postBuscados"));
    }

    public function editarPost($slug){
        $post = Posts::where("slug","=",$slug)->get();
        return view("editar-posts", compact("post"));
    }

    public function modificarPost(Request $req, $slug){
        $post = Posts::where("slug","=",$slug)->get();


        $validador = Validator::make($req->all(), $this->validador($peticion="editar")[0],$this->validador($peticion="editar")[1]);

        if($req->hasFile('imagen-nueva')){
            $file = $req->file('imagen-nueva');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' .$extension;
            $file->move('public/imagenes-posts', $filename);
            $post[0]->titulo = trim(ucfirst(mb_strtolower($req["titulo"],"UTF-8" )));
            $post[0]->descripcion = trim(ucfirst(mb_strtolower($req["descripcion"],"UTF-8" )));
            $post[0]->imagen = $filename;
            $post[0]->save();
            $message = "El post ". $$post[0]->titulo . " fue modificado con éxtito";
            /*return back()->with('success',$message);*/
            return redirect("/post-list")->with('success',$message);
        } else {
            $post[0]->titulo = trim(ucfirst(mb_strtolower($req["titulo"],"UTF-8" )));
            $post[0]->descripcion = trim(ucfirst(mb_strtolower($req["descripcion"],"UTF-8" )));
            $post[0]->save();
            $message = "El post ". $post[0]->titulo . " fue modificado con éxtito";
            return redirect("/post-list")->with('success',$message);
        }
        
    }

    public function borrarPost($slug){
        $post = Posts::where("slug","=",$slug);
        $post->delete();
        return response()->json(['El Post fue borrado con exito']);
    }
}
