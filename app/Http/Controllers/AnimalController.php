<?php

namespace App\Http\Controllers;

use App\Models\Animal;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animals = Animal::query()
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view(
            'animals.animals',
            compact(
                'animals'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $animal = new Animal();

        return view('animals/CRUD/form', compact( // we return using view path to the file where we will see out form, and in compact what we will see in this case 'movie'
            'animal'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validateAnimal($request);


        $animal = new Animal();
        $animal->name = $request->input('name');
        $animal->species = $request->input('species');
        $animal->breed = $request->input('breed');
        $animal->age = $request->input('age');
        $animal->weight = $request->input('weight');

        $animal->save();

        session()->flash('success_message', 'The animal was successfully saved ');

        return redirect()->route('animals.edit', $animal->id); // we have id because we called save  $movie->save();
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
        $animal = Animal::findOrFail($id);

        return view('animals/CRUD/form', compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $this->validateAnimal($request);

        $animal = Animal::findOrFail($id);
        $animal->name = $request->input('name');
        $animal->species = $request->input('species');
        $animal->breed = $request->input('breed');
        $animal->age = $request->input('age');
        $animal->weight = $request->input('weight');
        $animal->update();

        session()->flash('success_message', 'The animal was successfully updated ');

        return redirect()->route('animals.edit', $animal->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return (redirect('/'));
    }



    private function validateAnimal(Request $request)

    {
        $this->validate($request, [

            'name' => 'required',
            'species' => 'required',
            'age' => 'required|numeric',
            'breed' => 'required',
            'weight' => 'required|numeric',

        ]);
    }
}
