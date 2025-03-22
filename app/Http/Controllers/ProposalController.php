<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProposalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->route()->getName() === 'proposal.destroy' && Auth::user()->status !== 'superadmin') {
                abort(403, 'Seuls les super administrateurs peuvent supprimer des propositions.');
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = Proposal::with('attachments')->orderBy('created_at', 'desc')->paginate(10);
        return view('proposal.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proposal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240', // 10MB max per file
        ]);

        $proposal = Proposal::create([
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('proposal_attachments', $filename, 'public');

                ProposalAttachment::create([
                    'proposal_id' => $proposal->id,
                    'filename' => $filename,
                    'original_filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('proposal.thanks')->with('success', __('Votre proposition a été soumise avec succès.'));
    }

    /**
     * Display the thanks page after submission.
     */
    public function thanks()
    {
        return view('proposal.thanks');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proposal = Proposal::with('attachments')->findOrFail($id);
        return view('proposal.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proposal = Proposal::with('attachments')->findOrFail($id);
        return view('proposal.edit', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $proposal->update([
            'status' => $request->status,
        ]);

        return redirect()->route('proposal.show', $proposal->id)->with('success', __('Statut de la proposition mis à jour.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proposal = Proposal::with('attachments')->findOrFail($id);

        // Delete all attachments from storage
        foreach ($proposal->attachments as $attachment) {
            Storage::disk('public')->delete('proposal_attachments/' . $attachment->filename);
        }

        $proposal->delete();

        return redirect()->route('proposal.index')->with('success', __('La proposition a été supprimée.'));
    }

    /**
     * Download the specified attachment.
     */
    public function downloadAttachment(string $id)
    {
        $attachment = ProposalAttachment::findOrFail($id);
        $filePath = storage_path('app/public/proposal_attachments/' . $attachment->filename);

        return response()->download($filePath, $attachment->original_filename);
    }
}
