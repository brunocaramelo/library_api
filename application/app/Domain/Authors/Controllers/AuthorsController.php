<?php

namespace App\Domain\Authors\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\Authors\Services\AuthorService;

use App\Domain\Authors\Exceptions\AuthorEditException;
use App\Domain\Authors\Exceptions\AuthorNotFoundException;

use App\Jobs\ProcessExperimentalJob;
use Carbon\Carbon;

class AuthorsController extends Controller
{
    public function getAll(AuthorService $authorService)
    {
        return response()->json(['data' => $authorService->getAll()]);
    }

    public function getById(AuthorService $authorService, Request $request)
    {
        try {
            $item = $authorService->getById($request->id);
            return response()->json(['data' => $item ]);
        } catch (AuthorNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 404);
        }
    }

    public function store(AuthorService $authorService, Request $request)
    {
        try {
            \DB::beginTransaction();
            $body = json_decode($request->getContent(), true);
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

    public function create(AuthorService $authorService, Request $request)
    {
        try {
            \DB::beginTransaction();
            $body = json_decode($request->getContent(), true);
            $authorService->create($body);
            \DB::commit();
            return response()->json(['message'=>'Autor Criado com sucesso']);
        } catch (AuthorEditException $error) {
            \DB::rollback();
            return response()->json(['error'=>$error->getMessage()], 422);
        }
    }

    public function sendMessageToQueue(Request $request)
    {
        $this->dispatch(new ProcessExperimentalJob(
            $request->all()['message'].Carbon::now()->format('Y-m-d H:i:s:u')
        ));

        return response()->json([
            'status' => '200',
            'message'=> 'Envio efetuado com sucesso, aguarde o processamento',
            'data'=> null
            ]);
    }
}
