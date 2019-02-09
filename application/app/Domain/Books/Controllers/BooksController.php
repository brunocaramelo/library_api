<?php

namespace App\Domain\Books\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\Books\Services\BookService;

use App\Domain\Books\Exceptions\BookEditException;
use App\Domain\Books\Exceptions\BookNotFoundException;
use App\Domain\Authors\Exceptions\AuthorNotFoundException;
use App\Domain\Disciplines\Exceptions\DisciplineNotFoundException;

class BooksController extends Controller
{
    public function getAll()
    {
        $bookService = new BookService();
        return response()->json(['data' => $bookService->getAll()], 200, [], JSON_NUMERIC_CHECK);
    }
    
    public function getById(Request $request)
    {
        try {
            $bookService = new BookService();
            return response()->json(['data' => $bookService->getById($request->id)], 200, [], JSON_NUMERIC_CHECK);
        } catch (BookNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 404);
        }
    }
    
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $body = json_decode($request->getContent(), true);
            $bookService = new BookService();
            $bookService->update($request->route('id'), $body);
            \DB::commit();
            return response()->json(['message'=>'Livro Editado com sucesso']);
        } catch (BookEditException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (BookNotFoundException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 404);
        } catch (AuthorNotFoundException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (DisciplineNotFoundException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        }
    }

    public function create(Request $request)
    {
        try {
            \DB::beginTransaction();
            $body = json_decode($request->getContent(), true);
            $bookService = new BookService();
            $bookService->create($body);
            \DB::commit();
            return response()->json(['message'=>'Livro Criado com sucesso']);
        } catch (BookEditException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (AuthorNotFoundException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (DisciplineNotFoundException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        }
    }

    public function remove(Request $request)
    {
        try {
            \DB::beginTransaction();
            $bookService = new BookService();
            $bookService->remove($request->id);
            \DB::commit();
            return response()->json(['data' => 'Livro Removido com sucesso'], 200);
        } catch (BookNotFoundException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 404);
        }
    }
}