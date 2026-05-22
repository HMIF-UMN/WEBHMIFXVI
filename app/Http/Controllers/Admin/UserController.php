<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        // TODO: return paginated user list
    }

    public function create(): Response
    {
        // TODO: return create user form
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: validate and create user with hashed password and role
    }

    public function edit(User $user): Response
    {
        // TODO: return edit form with user data
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        // TODO: validate and update user (name, email, role, optional password)
    }

    public function destroy(User $user): RedirectResponse
    {
        // TODO: delete user (prevent deleting self)
    }
}
