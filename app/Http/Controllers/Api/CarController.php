<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Car::query();

            if ($request->filled('brand')) {
                $brand = trim(strtolower($request->brand));
                $query->whereRaw("LOWER(brand) LIKE ?", ["%{$brand}%"]);
            }

            if ($request->filled('model')) {
                $model = trim(strtolower($request->model));
                $query->whereRaw("LOWER(model) LIKE ?", ["%{$model}%"]);
            }

            return response()->json(
                $query->orderBy('id', 'desc')->paginate(5)
            );
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'brand' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
                'model' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
                'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
                'color' => ['required', 'string', 'max:50', 'regex:/^\S.*\S$|^\S$/'],
                'price' => ['required', 'numeric', 'min:1000', 'max:99999'],
            ]);

            $car = Car::create($validatedData);

            return response()->json([
                'message' => 'Car created successfully.',
                'data' => $car
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Bad request',
                'errors' => $e->errors()
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $car = Car::findOrFail($id);
            return response()->json($car, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Car not found.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $car = Car::findOrFail($id);
            $validatedData = $request->validate([
                'brand' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
                'model' => ['required', 'string', 'max:255', 'regex:/^\S.*\S$|^\S$/'],
                'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
                'color' => ['required', 'string', 'max:50', 'regex:/^\S.*\S$|^\S$/'],
                'price' => ['required', 'numeric', 'min:1000', 'max:99999'],
            ]);

            $car->update($validatedData);

            return response()->json([
                'message' => 'Car updated successfully.',
                'data' => $car
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Bad request',
                'errors' => $e->errors()
            ], 400);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Car not found.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $car = Car::findOrFail($id);
            $car->delete();
            return response()->json([
                'message' => 'Car deleted successfully.',
                'data' => $car
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Car not found.',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Internal server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
