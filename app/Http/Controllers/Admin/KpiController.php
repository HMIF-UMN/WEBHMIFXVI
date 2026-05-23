<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KpiMember;
use App\Models\KpiPeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class KpiController extends Controller
{
    public function index(): Response
    {
        // TODO: return paginated KPI members with their periods
    }

    public function edit(KpiMember $kpiMember): Response
    {
        // TODO: return edit form with member and their periods
    }

    public function update(Request $request, KpiMember $kpiMember): RedirectResponse
    {
        // TODO: validate and update member overall + upsert periods
    }
}
