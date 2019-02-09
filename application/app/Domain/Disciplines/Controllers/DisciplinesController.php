<?php

namespace App\Domain\Disciplines\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\Disciplines\Services\DisciplineService;

use App\Domain\Disciplines\Exceptions\DisciplineEditException;
use App\Domain\Disciplines\Exceptions\DisciplineNotFoundException;

class DisciplinesController extends Controller
{
    public function getAll()
    {
        $disciplineService = new DisciplineService();
        return response()->json(['data' => $disciplineService->getAll()]);
    }
    
    public function getById(Request $request)
    {
        $disciplineService = new DisciplineService();
        return response()->json(['data' => $disciplineService->getById($request->id)]);
    }
    
    public function store(Request $request)
    {
        try {
            $body = json_decode($request->getContent(), true);
            $disciplineService = new DisciplineService();
            $disciplineService->update($request->route('id'), $body);
            return response()->json(['message'=>'Disciplina Editada com sucesso']);
        } catch (DisciplineEditException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        } catch (DisciplineNotFoundException $error) {
            return response()->json(['error'=>$error->getMessage()], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            $body = json_decode($request->getContent(), true);
            $disciplineService = new DisciplineService();
            $disciplineService->create($body);
            return response()->json(['message'=>'Disciplina Criada com sucesso']);
        } catch (DisciplineEditException $error) {
            return response()->json(['error'=>$error->getMessage()], 422);
        }
    }
}