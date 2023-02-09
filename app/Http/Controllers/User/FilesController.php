<?php

namespace App\Http\Controllers\User;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class FilesController extends Controller
{
    // muestra el listado de archivos propios
    public function index()
    {
        // $files = File::all();
        // SELECT * FROM files

        $files = File::where('user_id', Auth::id())->latest()->get(); // una forma
        $files = File::whereUserId(Auth::id())->latest()->get(); // otra forma
        // SELECT * FROM files WHERE user_id = Auth::id() ORDER BY id DESC
        return view('user.files.index', compact('files'));
    }
    // muestra un archivo en particular 
    public function show($id) // en $id guardamos el id del archivo, que nos llega por URL
    {
        $file = File::whereId($id)->firstOrFail();
        // SELECT * FROM files WHERE id = $id 

        $user_id = Auth::id(); // obtengo el id del usuario autenticado

        if ($user_id == $file->user_id) {
            /* return redirect ('storage'/{{ Auth::id() }}/{{ $file->name }}); */
            return redirect("storage/$user_id/$file->name");
            return "vas a ver el archivo $file->id";
        } else {
            abort(403);
            //return "No tienes permiso para ver este archivo";
            Alert::error('Error!!', 'No tienes permisos para ver este archivo'); // alert de SweetAlert
            return back(); // return a la pagina previa
        }


        /* dd($user_id, $file->user_id); */
    }
    // procesa la subida fisica de archivos y generar el registro asociado en la tabla files de la BD
    public function store(Request $request)
    {
        $max_size = (int)ini_get('upload_max_filesize') * 10240;
        // ini_get('upload_max_filesize') == "40M" - string -
        // (int)ini_get('upload_max_filesize') == 40 - integer -
        // ini_get('upload_max_filesize') == 409600 - integer -

        $files2 = $request->files; // forma de acceder a los archivos cargados desde el form
        $files = $request->file('files'); // forma de acceder a los archivos cargados desde el form

        $user_id = Auth::id(); // obtengo el id del usuario autenticado

        if ($request->hasFile('files')) { // verificamos si el cliente ha enviado archivos

            foreach ($files as $file) {
                $fileName = Str::slug($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
                // almaceno en la variable el-nombre-del-archivo.laextension
                if (Storage::putFileAs("/public/$user_id/", $file, $fileName)) {
                    File::create([
                        'name' => $fileName, // obtengo el nombre del archivo
                        'user_id' => $user_id // id del usuario autenticado
                    ]);
                } // si se almaceno fisicamente el archivo, creamos el registro asociado, en la tabla files



            }
            Alert::success('Exito!!', 'Se ha subido el archivo'); // alert de SweetAlert
            return back(); // return a la pagina previa

        } else {

            Alert::error('Error!!', 'Es necesario subir uno o más archivos'); // alert de SweetAlert
            return back(); // return a la pagina previa

        }
    }
}
