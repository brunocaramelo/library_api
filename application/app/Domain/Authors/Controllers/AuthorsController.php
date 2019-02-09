<?php

namespace App\Domain\Authors\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\Authors\Services\AuthorService;

use App\Domain\Authors\Exceptions\AuthorEditException;
use App\Domain\Authors\Exceptions\AuthorNotFoundException;

class AuthorsController extends Controller
{
    public function getAll()
    {
        $authorService = new AuthorService();
        return response()->json(['data' => $authorService->getAll()]);
    }
    
    public function getById(Request $request)
    {
        $authorService = new AuthorService();
        return response()->json(['data' => $authorService->getById($request->id)]);
    }
    
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $body = json_decode($request->getContent(), true);
            $authorService = new AuthorService();
            $authorService->update($request->route('id'), $body);
            \DB::commit();
            return response()->json(['message'=>'Autor Editado com sucesso']);
        } catch (AuthorEditException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (AuthorNotFoundException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            \DB::beginTransaction();
            $body = json_decode($request->getContent(), true);
            $authorService = new AuthorService();
            $authorService->create($body);
            \DB::commit();
            return response()->json(['message'=>'Autor Criado com sucesso']);
        } catch (AuthorEditException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        }
    }
}