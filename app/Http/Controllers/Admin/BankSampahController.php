<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BankSampahController extends Controller
{
    public function index(): Response
    {
        $bankSampahs = BankSampah::all()
            ->latest()
            ->get();

        return Inertia::render('Admin/BankSampah/Index', [
            'bankSampahs' => $bankSampahs,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/BankSampah/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:bank_sampahs,code'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'operating_hours' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        BankSampah::create($validated);

        return redirect()
            ->route('bank-sampah.index')
            ->with('success', 'Bank sampah berhasil ditambahkan.');
    }

    public function edit(BankSampah $bankSampah): Response
    {
        return Inertia::render('Admin/BankSampah/Edit', [
            'bankSampah' => $bankSampah,
        ]);
    }

    public function update(Request $request, BankSampah $banksampah): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:bank_sampahs,code,' . $banksampah->id],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'operating_hours' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $banksampah->update($validated);

        return redirect()
            ->route('bank-sampah.index')
            ->with('success', 'Bank sampah berhasil diperbarui.');
    }

    public function destroy(BankSampah $banksampah): RedirectResponse
    {
        $banksampah->delete();

        return redirect()
            ->route('bank-sampah.index')
            ->with('success', 'Bank sampah berhasil dihapus.');
    }
}
