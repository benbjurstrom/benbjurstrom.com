<?php

namespace App\Http\Controllers;

use BenBjurstrom\Prezet\Actions\UpdateIndex;
use BenBjurstrom\Prezet\Models\Document;
use BenBjurstrom\Prezet\Prezet;
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

        $fm = $docs->map(function ($doc) {
            return $doc->frontmatter;
        });

        return view('articles', [
            'articles' => $fm,
            'paginator' => $docs,
        ]);
    }
}
