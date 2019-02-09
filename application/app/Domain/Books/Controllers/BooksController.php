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
        $bookService = new BookService();
        return response()->json(['data' => $bookService->getById($request->id)], 200, [], JSON_NUMERIC_CHECK);
    }
    
    public function store(Request $request)
    {
        try {
            $body = json_decode($request->getContent(), true);
            $bookService = new BookService();
            $bookService->update($request->route('id'), $body);
            return response()->json(['message'=>'Livro Editado com sucesso']);
        } catch (BookEditException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (BookNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 404);
        } catch (AuthorNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (DisciplineNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        }
    }

    public function create(Request $request)
    {
        try {
            $body = json_decode($request->getContent(), true);
            $bookService = new BookService();
            $bookService->create($body);
            return response()->json(['message'=>'Livro Criado com sucesso']);
        } catch (BookEditException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (AuthorNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (DisciplineNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        }
    }
}