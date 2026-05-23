<?php

namespace App\Http\Controllers;

use App\Models\KpiMember;
use Inertia\Inertia;
use Inertia\Response;

class AboutUsController extends Controller
{
    public function index(): Response
    {
        $kpiData = KpiMember::with('periods')->get()->mapWithKeys(function (KpiMember $member) {
            return [$member->name => [
                'overall' => $member->overall,
                'history' => $member->periods->mapWithKeys(fn($p) => [$p->period_name => $p->score]),
            ]];
        });

        return Inertia::render('AboutUs', [
            'kpiData' => $kpiData,
        ]);
    }
}
