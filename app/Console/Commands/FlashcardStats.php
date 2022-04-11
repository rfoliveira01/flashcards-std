<?php

namespace App\Console\Commands;

use App\Models\Flashcard;
use App\Models\UserAnswer;
use Illuminate\Console\Command;
class FlashcardStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $total = Flashcard::All()->count();
        
        $answered = UserAnswer::where('status',UserAnswer::ANSWER_STATUS_CORRECT)->orWhere('status','=',UserAnswer::ANSWER_STATUS_INCORRECT)->count();
        
        $correct = UserAnswer::where('status',UserAnswer::ANSWER_STATUS_CORRECT)->count();

        $answeredPercentage = ($answered/$total) * 100;
        $correctPercentage = ($correct/$total) * 100;
        $this->info(sprintf("You answered %d%% of %d flashcards", $answeredPercentage, $total));
        $this->info(sprintf("You answered right %d%% of %d flashcards", $correctPercentage, $total));

        return 1;
    }
}
