<?php

namespace App\Http\Controllers\Path;

use App\Http\Controllers\Controller;
use App\Http\Requests\Path\UpdateRoutineRequest;
use App\Http\Requests\Routine\CreateRoutineRequest;
use App\Http\Requests\Routine\DeleteRoutineRequest;
use App\Http\Services\PathService;
use App\Http\Services\RoutineService;
use App\Models\Path;
use App\Models\Routine;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RoutineController extends Controller
{
    public function __construct(private RoutineService $routineService)
    {

    }
    public function store(CreateRoutineRequest $request, Routine $routine)
    {
        //TODO: Add a Policy
        $this->routineService->create(
            $request->path_id,
            $request->name,
            1,
            $request->amount,
            $request->unit,
            $request->note ?? '',
        );
    }

    public function update(UpdateRoutineRequest $request, Routine $routine)
    {
        if ($request->user()->cannot('update', $routine)) {
            return redirect()->back()->withErrors(['forbidden operation']);
        }
        $this->routineService->update(
            $routine->id,
            $request->name,
            1,
            $request->amount,
            $request->unit,
            $request->note,
        );
    }

    public function destroy(DeleteRoutineRequest $request, Routine $routine)
    {
        if ($request->user()->cannot('delete', $routine)) {
            return redirect()->back()->withErrors(['forbidden operation']);
        }
        $this->routineService->delete(
            id: $routine->id,
        );
    }
}
