<?php

namespace App\Console\Commands;

use App\Models\Flashcard;
use Illuminate\Console\Command;

class FlashcardList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all flashcards';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $headers = ['#', 'Question', 'Answer'];

        $data = Flashcard::All(['id','question','answer'])->toArray();

        $this->table($headers, $data);

        return self::SUCCESS;
    }
}
