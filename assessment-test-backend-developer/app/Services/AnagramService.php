<?php

namespace App\Services;

class AnagramService
{
    /**
     * Group anagrams and sort them by group size (descending) and words (ascending)
     *
     * @param array $words Array of strings to be grouped
     * @return array Array of arrays containing grouped anagrams
     */
    public function groupAnagrams(array $words): array
    {
        $anagramGroup = [];
        
        // characters sorting each group
        foreach ($words as $word) {
            $sortedWord = collect(str_split($word))
                ->sort()
                ->implode('');
            
            $anagramGroup[$sortedWord][] = $word;
        }
        
        // sort words in each group
        $result = collect($anagramGroup)->map(function ($group) {
            return collect($group)->sort()->values()->all();
        })->values()->all();
        
        // sort groups by size (descending) and name (ascending)
        usort($result, function ($a, $b) {
            // compare by size first
            $sizeCompare = count($b) - count($a);
            if ($sizeCompare !== 0) {
                return $sizeCompare;
            }
            // if sizes are equal, compare by first word
            return strcmp($a[0], $b[0]);
        });
        
        return $result;
    }
}