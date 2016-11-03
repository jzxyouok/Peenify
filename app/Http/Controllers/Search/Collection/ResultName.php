<?php

namespace App\Http\Controllers\Search\Collection;

use App\Services\CollectionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultName extends Controller
{
    /**
     * @var CollectionService
     */
    private $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function __invoke()
    {
        $term = request()->get('term');

        if (empty($term)) return back()->with('message', '請輸入搜尋收藏集關鍵字。');

        $collections = $this->collectionService->paginateSearchResult($term, 12);

        return view('searches.collections', compact('collections', 'term'));
    }
}
