<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('user.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'country_id' => 'required|exists:countries,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'country_id' => $request->country_id,
            'status' => 'reader', // Default status
            'is_actived' => false, // Set to false by default
            'is_archived' => false, // Set to false by default
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully');
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
