<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // Import RedirectResponse
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login'); // Ensure this view exists
    }
    
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse // Change to RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect to the companies index with a success message
        return redirect()->route('companies.index')->with('success', 'You have logged in successfully.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse // Change to RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect to the home page with a success message
        return redirect('/')->with('success', 'You have logged out successfully.');
    }
}