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
        // Check if this is an activation request from an admin
        if (isset($request->is_actived) &&
            (Auth::user()->status === 'admin' || Auth::user()->status === 'superadmin')) {

            $user->is_actived = true;
            $user->actived_at = now();
            $user->actived_by = Auth::id();
            $user->save();

            return redirect()->route('user.pending')->with('success', 'Compte activé avec succès.');
        }

        // Check if this is an unarchive request from a superadmin
        if (isset($request->is_archived) && $request->is_archived == 0 &&
            Auth::user()->status === 'superadmin') {

            $user->is_archived = false;
            $user->archived_at = null;
            $user->archived_by = null;
            $user->save();

            return redirect()->route('user.archived')->with('success', 'Compte restauré avec succès.');
        }

        // Check if this is an archive request from a superadmin
        if (isset($request->is_archived) && $request->is_archived == 1 &&
            Auth::user()->status === 'superadmin') {

            $user->is_archived = true;
            $user->archived_at = now();
            $user->archived_by = Auth::id();
            $user->save();

            return redirect()->route('user.index')->with('success', 'Compte archivé avec succès.');
        }

        // Original profile update logic
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

    /**
     * Display a list of user accounts awaiting activation.
     *
     * @return \Illuminate\View\View
     */
    public function pending()
    {
        // Check if user is admin or superadmin
        if (Auth::user()->status !== 'admin' && Auth::user()->status !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        // Get all non-activated user accounts
        $pendingUsers = User::where('is_actived', false)
                            ->where('is_archived', false)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('user.pending', compact('pendingUsers'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Check if user is admin or superadmin
        if (Auth::user()->status !== 'admin' && Auth::user()->status !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('user.pending')->with('success', 'Compte supprimé avec succès.');
    }

    /**
     * Display a list of archived user accounts.
     *
     * @return \Illuminate\View\View
     */
    public function archived()
    {
        // Check if user is superadmin
        if (Auth::user()->status !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        // Get all archived user accounts
        $archivedUsers = User::where('is_archived', true)
                             ->orderBy('archived_at', 'desc')
                             ->get();

        return view('user.archived', compact('archivedUsers'));
    }

    /**
     * Update user status (superadmin only).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, User $user)
    {
        // Check if user is superadmin
        if (Auth::user()->status !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:reader,admin,superadmin',
        ]);

        // Prevent changing own status for security
        if (Auth::id() === $user->id) {
            return redirect()->route('user.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre statut pour des raisons de sécurité.');
        }

        $user->status = $request->status;
        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'Le statut de l\'utilisateur a été mis à jour avec succès.');
    }
}
