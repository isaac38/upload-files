<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use RealRashid\SweetAlert\Facades\Alert;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = Files::all();
        confirmDelete('Eliminar archivo', 'Quieres eliminar el archivo');
        return view('pages.index', compact('request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        $rules = [
            'name' => 'required',
            'file' => 'required|extensions:jpg,png,jpeg,pdf'
        ];
        $messages = [
            'name.required' => 'Agrega el nombre del archivo.',
            'file.required' => 'Este campo es requerido.',
            'file.extensions' => 'Solo se puede jpg, jpeg, png y pdf.',
        ];
        $this->validate($request, $rules, $messages);

        try {
            $arch = new Files;
            $arch->name = $request->name;
            if ($request->hasFile('file')) {
                $archivo = $request->file('file');
                $archivo->move(public_path().'/archivos/', $archivo->getClientOriginalName());

                $arch->file = $archivo->getClientOriginalName();
                $arch->type = $archivo->getClientOriginalExtension();
            }
            $arch->save();
            toast('Archivo subido','success');

        } catch (\Throwable $th) {
            toast('Error al subir archivo','error');
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $archivo = Files::find($id);
        $archivo_path = public_path().'/archivos/'.$archivo->file;

        if (file_exists($archivo_path)) {
            unlink($archivo_path);
            $archivo->delete();
        }else{
            $archivo->delete();
        }
        toast('Archivo eliminado','success');
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->back();

        //dd($archivo_path);
    }
}
