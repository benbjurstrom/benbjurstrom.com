<?php

namespace App\Http\Controllers;

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

        $fm = $docs->map(function ($doc) {
            return $doc->frontmatter;
        });

        return view('index', [
            'articles' => $fm,
        ]);
    }
}
