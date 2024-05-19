<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnCreateRequest;
use App\Models\Rental;
use App\Models\Returned;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search', '');

        $rentals = Rental::query()->with(['car'])
            ->where('status', 'booked')
            ->where('user_id', auth()->user()->id)
            ->when($search, function ($query, $search) {
                return $query->where('start_date', $search)
                    ->orWhere('end_date', $search);
            })
            ->whereHas('car', function ($query) use ($search) {
                $query->where('brand', 'like', '%' . $search . '%');
            })
            ->paginate($perPage, ['*'], 'page', $page);

        $returns = Returned::query()->with(['rental.car'])->paginate();

        return Inertia::render('Return/Index', [
            'rentals' => $rentals,
            'returns' => $returns,
        ]);
    }

    public function show(Request $request, $id){
        $return = Returned::query()->with(['rental.car'])->find($id);

        return Inertia::render('Return/Show', [
            'ret' => $return,
        ]);
    }

    public function create(string $rentalId)
    {
        $rental = Rental::query()->with(['car'])->find($rentalId);
        $additionalCost = false;
        $lateInDays = 0;

        if ($rental->end_date < now())
        {
            $additionalCost = true;
            $lateInDays = (int) Carbon::now()->diffInDays($rental->end_date);
        }

        return Inertia::render('Return/Create', [
            'rental' => $rental,
            'additionalCost' => $additionalCost,
            'lateInDays' => $lateInDays,
        ]);
    }

    public function store(ReturnCreateRequest $request)
    {
        $rental = Rental::query()->with(['car'])->find($request->input('rental_id'));

        $data = [
            'rental_id' => $rental->id,
        ];

        $data['days_rented'] = (int) Carbon::create($rental->start_date)->diffInDays($rental->end_date) + $request->input('lateInDays');
        $data['return_date'] = now();
        $data['total_fee'] = $request->input('totalAmounts');

        Returned::query()->create($data);
        $rental->status = 'returned';
        $rental->save();

        return Redirect::route('return');
    }
}
