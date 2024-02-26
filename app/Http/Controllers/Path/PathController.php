<?php

namespace App\Http\Controllers\Path;

use App\Http\Controllers\Controller;
use App\Http\Requests\Path\DeletePathRequest;
use App\Http\Requests\Path\UpdatePathRequest;
use App\Http\Requests\Path\UpdateRoutineRequest;
use App\Http\Services\PathService;
use App\Models\Path;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PathController extends Controller
{
    public function __construct(private PathService $pathService)
    {

    }

    public function index()
    {
        return Inertia::render('Path/Index')->with([
            'paths' => $this->pathService->get(Auth::id())
        ]);
    }

    public function store()
    {
        $this->pathService->createDefault(Auth::id());
    }

    public function show(Path $path)
    {
        return Inertia::render('Path/Detail')->with([
            'path' => $path->load('routines')
        ]);
    }

    public function update(UpdatePathRequest $request, Path $path, )
    {
        if ($request->user()->cannot('update', $path)) {
            return redirect()->back()->withErrors(['forbidden operation']);
        }
        $this->pathService->update(
            id: $path->id,
            name: $request->name,
            note: $request->note ?? '',
        );
    }

    public function destroy(DeletePathRequest $request, Path $path)
    {
        if ($request->user()->cannot('delete', $path)) {
            return redirect()->back()->withErrors(['forbidden operation']);
        }
        $this->pathService->delete($path->id);

        return to_route('paths.index');
    }
}
