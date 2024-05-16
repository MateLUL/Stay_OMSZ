<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'password.confirmed' => 'A megadott 2 jelszó nem egyezik meg.',
            'password.required' => 'Meg kell adnod egy új jelszót.',
            'password.min' => 'Túl rövid a jelszó. Minimum 8 karakterből kell állnia.',

            'current_password.required' => 'Meg kell adnod a jelenlegi jelszavad.',
            'current_password.current_password' => 'Hibás jelszó.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
