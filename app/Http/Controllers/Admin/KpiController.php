<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KpiMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class KpiController extends Controller
{
    public function index(): Response
    {
        $kpiMembers = KpiMember::orderBy('division')->orderBy('name')->get();

        return Inertia::render('Admin/Kpi/Index', [
            'kpiMembers' => $kpiMembers,
        ]);
    }

    public function edit(KpiMember $kpiMember): Response
    {
        $kpiMember->load('periods');

        return Inertia::render('Admin/Kpi/Edit', [
            'kpiMember' => $kpiMember,
        ]);
    }

    public function update(Request $request, KpiMember $kpiMember): RedirectResponse
    {
        $validated = $request->validate([
            'periods'                    => 'required|array',
            'periods.*.id'               => 'required|integer|exists:kpi_periods,id',
            'periods.*.score'            => 'required|integer|min:0|max:99999',
            'new_periods'                => 'nullable|array',
            'new_periods.*.period_name'  => 'required|string|max:100',
            'new_periods.*.score'        => 'required|integer|min:0|max:99999',
        ]);

        foreach ($validated['periods'] as $p) {
            $kpiMember->periods()->where('id', $p['id'])->update(['score' => $p['score']]);
        }

        foreach ($validated['new_periods'] ?? [] as $p) {
            $kpiMember->periods()->create([
                'period_name' => $p['period_name'],
                'score'       => $p['score'],
            ]);
        }

        $kpiMember->update(['overall' => $kpiMember->periods()->sum('score')]);

        return redirect()->route('admin.kpi.index')
            ->with('success', "KPI updated for {$kpiMember->name}.");
    }
}
