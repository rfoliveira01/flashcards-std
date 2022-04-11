<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Flashcard;
use Validator;

class FlashcardNew extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new flashcard';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $flashCardData = [];
        $flashCardData['question'] = $this->ask('Please write your question:');
        $flashCardData['answer']  = $this->ask('What is the answer to your question?');

        $validator = Validator::make($flashCardData, [
            'question' => 'required|unique:flashcards|max:500',
            'answer' => 'required',
        ]);

        if (!$validator->fails() && $this->confirm('Do you wish to insert this Flashcard?', 'yes')) {

            $flashcard = Flashcard::create($flashCardData);

            $this->info('The flashcard was inserted');
            return self::SUCCESS;
        } else {
            $this->warn('The question and answer are required and the quetion must be unique');
            return self::INVALID;
        }

    }
}
