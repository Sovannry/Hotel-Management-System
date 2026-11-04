<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $guests = Guest::withCount('bookings')
            ->when($request->search, function ($q, $s) {
                $q->where('full_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            })->latest()->paginate(10)->withQueryString();
        return view('guests.index', compact('guests'));
    }

    public function create() { return view('guests.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'address' => ['nullable', 'string'],
            'identity_number' => ['nullable', 'string', 'max:100'],
        ]);
        Guest::create($data);
        return redirect()->route('guests.index')->with('success', 'Guest created.');
    }

    public function edit(Guest $guest) { return view('guests.edit', compact('guest')); }

    public function update(Request $request, Guest $guest)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'address' => ['nullable', 'string'],
            'identity_number' => ['nullable', 'string', 'max:100'],
        ]);
        $guest->update($data);
        return redirect()->route('guests.index')->with('success', 'Guest updated.');
    }

    public function destroy(Guest $guest)
    {
        if ($guest->bookings()->exists()) return back()->with('error', 'Guest has booking records and cannot be deleted.');
        $guest->delete();
        return back()->with('success', 'Guest deleted.');
    }
}
