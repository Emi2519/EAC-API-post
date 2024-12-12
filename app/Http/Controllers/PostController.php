<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {

    public function index() {
        $posts = Post::all(['id', 'nombre_autor', 'titulo', 'contenido', 'fecha']);
        return response()->json($posts, 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre_autor' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $post = Post::create([
                'nombre_autor' => $request->nombre_autor,
                'titulo' => $request->titulo,
                'contenido' => $request->contenido,
                'fecha' => now(),
            ]);

            return response()->json(['message' => 'Post creado exitosamente.', 'post' => $post], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el post', 'details' => $e->getMessage()], 500);
        }
    }
}