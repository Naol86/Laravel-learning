<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteChirpRequest;
use App\Http\Requests\StoreChirpRequest;  
use App\Http\Requests\UpdateChirpRequest;
use App\Models\Chirp;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
        // return response('hello world');
        return Inertia::render('Chirps/Index', [
          'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
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
    public function store(StoreChirpRequest $request): RedirectResponse
    {
        //
        $validated = $request->validated();

      $request->user()->chirps()->create($validated);

      return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChirpRequest $request, Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('update', $chirp);
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:255'],
        ]);
        $chirp->update($validated);
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('delete', $chirp);
        $chirp->delete();
        return redirect(route('chirps.index'));
    }
}
