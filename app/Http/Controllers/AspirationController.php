<?php

namespace App\Http\Controllers;

use App\Models\AspirationSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:255'],
            'message'    => ['required', 'string', 'max:2000'],
        ]);

        AspirationSubmission::create($request->only('first_name', 'last_name', 'email', 'message'));

        return redirect()->back()->with('aspiration_success', true);
    }
}
