<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Car::query();

        if ($request->filled('brand')) {
            $brand = trim(strtolower($request->brand));
            $query->whereRaw("LOWER(brand) LIKE ?", ["%{$brand}%"]);
        }

        if ($request->filled('model')) {
            $model = trim(strtolower($request->model));
            $query->whereRaw("LOWER(model) LIKE ?", ["%{$model}%"]);
        }

        $cars = $query->orderBy('id', 'desc')->paginate(5);

        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'brand' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
            'model' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
            'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'color' => ['required', 'string', 'max:50', 'regex:/^\S.*\S$|^\S$/'],
            'price' => ['required', 'numeric', 'min:1000', 'max:99999'],
        ]);

        Car::create($request->all());
        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car): View
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car): View
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car): RedirectResponse
    {
        $request->validate([
            'brand' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
            'model' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
            'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'color' => ['required', 'string', 'max:50', 'regex:/^\S.*\S$|^\S$/'],
            'price' => ['required', 'numeric', 'min:1000', 'max:99999'],
        ]);

        $car->update($request->all());
        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): RedirectResponse
    {
        $car->delete();
        return redirect()->route('cars.index',
            ['page' => 1])->with('success', 'Car deleted successfully.');
    }
}
