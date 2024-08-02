<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\ReferenceFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{


    public function index(Reference $reference)
    {
        $files = $reference->files()->get();

        return view('reference.files.index', compact('reference', 'files'));
    }




    public function create(Reference $reference)
    {
        return view('reference.files.create', compact('reference'));
    }




    public function store(Request $request, Reference $reference)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'file' => 'required|file|max:10240', // Max file size is 10 MB
        ]);

        $filePath = $request->file('file')->storePublicly('files');
        $fileCrypt = $request->file('file')->hashName();

        ReferenceFile::create([
            'name' => $request->input('name'),
            'file_path' => $filePath,
            'file_crypt' => $fileCrypt,
            'reference_id' => $reference->id,
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return redirect()->route('reference.file.index', $reference)->with('success', 'File uploaded successfully.');
    }






    public function show(Reference $reference, ReferenceFile $file)
    {
        return view('reference.files.show', compact('reference', 'file'));
    }






    public function edit(Reference $reference, ReferenceFile $file)
    {
        return view('reference.files.edit', compact('reference', 'file'));
    }





    public function update(Request $request, Reference $reference, ReferenceFile $file)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'file' => 'nullable|file|max:10240', // Max file size is 10 MB
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($file->file_path);

            $filePath = $request->file('file')->store('reference-files');
            $fileCrypt = $request->file('file')->hashName();

            $file->update([
                'name' => $request->input('name'),
                'file_path' => $filePath,
                'file_crypt' => $fileCrypt,
            ]);
        } else {
            $file->update([
                'name' => $request->input('name'),
            ]);
        }
        return redirect()->route('reference.file.index', $reference)->with('success', 'File updated successfully.');
    }





    public function destroy(Reference $reference, ReferenceFile $file)
    {
        Storage::delete($file->file_path);
        $file->delete();
        return redirect()->route('reference.file.index', $reference)->with('success', 'File deleted successfully.');
    }



    public function download(Reference $reference, string $name)
    {
        $referenceFile = ReferenceFile::where('reference_id', $reference->id)
                                        ->where('name', $name)
                                        ->first();

        $filePath=Storage::path( $referenceFile->file_path);

        return response()->download($filePath);
    }



}
