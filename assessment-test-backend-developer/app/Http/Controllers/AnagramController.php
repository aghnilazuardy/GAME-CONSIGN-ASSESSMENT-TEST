<?php

namespace App\Http\Controllers;

use App\Services\AnagramService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnagramController extends Controller
{
    protected $anagramService;

    public function __construct(AnagramService $anagramService)
    {
        $this->anagramService = $anagramService;
    }

    /**
     * Group anagrams from the given array
     *
     * @return JsonResponse
     */
    public function groupAnagrams(Request $request): JsonResponse
    {
        $words = $request->all();
        $result = $this->anagramService->groupAnagrams($words);

        return response()->json($result);
    }
}
