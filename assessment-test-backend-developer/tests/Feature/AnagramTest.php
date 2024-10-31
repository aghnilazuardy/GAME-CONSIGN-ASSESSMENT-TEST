<?php

namespace Tests\Feature;

use App\Services\AnagramService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnagramTest extends TestCase
{
    protected AnagramService $anagramService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->anagramService = new AnagramService();
    }
    
    public function test_it_groups_anagrams_correctly()
    {
        // Arrange
        $words = ['kita', 'atik', 'tika', 'suka', 'aku', 'kia', 'kaus', 'makan', 'kua'];

        // Act
        $result = $this->anagramService->groupAnagrams($words);

        // Assert
        $this->assertEquals([
            ['atik', 'kita', 'tika'],
            ['aku', 'kua'],
            ['kaus', 'suka'],
            ['kia'],
            ['makan']
        ], $result);
    }

    public function test_it_handles_empty_array()
    {
        $result = $this->anagramService->groupAnagrams([]);
        $this->assertEquals([], $result);
    }

    public function test_it_handles_single_word()
    {
        $result = $this->anagramService->groupAnagrams(['hello']);
        $this->assertEquals([['hello']], $result);
    }
}
