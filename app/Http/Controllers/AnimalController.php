<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Support\Facades\DB;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function search()
    {
        $search_term = $_GET['search'] ?? null;

        if ($search_term) {
            $results = DB::select("
                SELECT *
                FROM `animals`
                WHERE `name` LIKE ?
                ORDER BY `name` ASC
            ", [
                '%' . $search_term . '%'
            ]);
        }

        return view('animals.search', [
            'search_term' => $search_term,
            'results' => $results ?? []
        ]);
    }
}
