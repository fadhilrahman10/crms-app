<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalCreateRequest;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search', '');

        $cars = Car::query()
            ->where('is_available', true)
            ->when($search, function ($query, $search) {
                return $query->where('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('rental_rate_per_day', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate($perPage, ['*'], 'page', $page);

        return Inertia::render('Rental/Index', [
            'cars' => $cars,
        ]);
    }

    public function store(RentalCreateRequest $request)
    {
        $isBooked = Rental::query()->where('car_id', $request->input('car_id'))
            ->where('start_date', '<=', $request->end_date)
            ->where('end_date', '>=', $request->start_date)
            ->exists();

        if ($isBooked)
        {
            return back()->withErrors([
                'booked' => "Error"
            ]);
        }

        $data = $request->validated();

        $carPrice = Car::query()->find($data['car_id'])->first()->rental_rate_per_day;
        $diffInDays = (int)Carbon::create($data['start_date'])->diffInDays($data['end_date']);

        if ($diffInDays <= 0) {
            $diffInDays = 1;
        }

        $data['total_amount'] = $carPrice * $diffInDays;
        $data['user_id'] = Auth::id();

        Rental::query()->create($data);

        return Redirect::route('rental')->with('success', 'Rental created.');

    }
}
