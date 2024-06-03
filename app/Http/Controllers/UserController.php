<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            abort(403);
        }

        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            abort(403);
        }

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.show', $user)->with('success', 'Profile updated successfully.');
    }
}
