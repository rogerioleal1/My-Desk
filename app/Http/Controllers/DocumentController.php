<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        Storage::delete($document->filepath);

        $document->delete();

        return back()->withSuccess('Documento excluído com sucesso!');
    }
}
