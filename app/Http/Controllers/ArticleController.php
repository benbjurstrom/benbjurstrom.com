<?php

namespace App\Http\Controllers;

use BenBjurstrom\Prezet\Data\DocumentData;
use BenBjurstrom\Prezet\Models\Document;
use Illuminate\Http\Request;

class ArticleController
{
    public function __invoke(Request $request)
    {
        //        $category = $request->input('category');
        //        $tag = $request->input('tag');

        $query = Document::where('draft', false);

        //        if ($category) {
        //            $query->where('category', $category);
        //        }
        //
        //        if ($tag) {
        //            $query->whereHas('tags', function ($q) use ($tag) {
        //                $q->where('name', $tag);
        //            });
        //        }

        $docs = $query->orderBy('date', 'desc')
            ->paginate(4);

        $docsData = $docs->map(fn (Document $doc) => app(DocumentData::class)::fromModel($doc));

        return view('articles', [
            'articles' => $docsData,
            'paginator' => $docs,
        ]);
    }
}
