<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarUpdateRequest;
use App\Http\Requests\CreateCarRequest;
use App\Models\Car;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search', '');

//        dd(Auth::user()->id);
        $cars = Car::query()
            ->where('user_id', Auth::user()->id)
            ->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('brand', 'like', "%{$search}%")
                        ->orWhere('model', 'like', "%{$search}%")
                        ->orWhere('rental_rate_per_day', 'like', "%{$search}%");
                }
            })
            ->paginate($perPage, ['*'], 'page', $page);

//        dd($cars);

        return Inertia::render('Car/Index', [
            'cars' => $cars
        ]);
    }

    public function store(CreateCarRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::user()->id;

        Car::create($data);

        return Redirect::route('car');
    }

    public function edit(string $id)
    {
        $car = Car::query()->find($id);

        return Inertia::render('Car/Edit', [
            'car' => $car
        ]);
    }

    public function update(CarUpdateRequest $request, string $id)
    {
        $car = Car::query()->find($id);

        $car->fill($request->validated());

        $car->save();

        return Redirect::route('car.edit', $id);
    }

    public function destroy(string $id)
    {
        $car = Car::query()->find($id);
        $car->delete();
        return Redirect::route('car');
    }
}
