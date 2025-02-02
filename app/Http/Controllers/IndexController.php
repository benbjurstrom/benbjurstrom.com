<?php

namespace App\Http\Controllers;

use BenBjurstrom\Prezet\Data\DocumentData;
use BenBjurstrom\Prezet\Models\Document;
use Illuminate\Http\Request;

class IndexController
{
    public function __invoke(Request $request)
    {

        $docs = Document::where('draft', false)
            ->orderBy('date', 'desc')
            ->limit(3)
            ->get();

        $docsData = $docs->map(fn (Document $doc) => app(DocumentData::class)::fromModel($doc));

        return view('index', [
            'articles' => $docsData,
        ]);
    }
}
