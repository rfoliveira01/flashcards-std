<?php

namespace App\Console\Commands;


use App\Models\Flashcard;
use App\Models\UserAnswer;
use Illuminate\Console\Command;

class FlashcardPratice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:pratice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pratice With Yor Flashcards';

    /**
     * Print table with the Flashcards and the percentage of correct answers
     *
     * @void
     */
    private function printTable()
    {

        //Get all the flashcards with the status of the answer
        $flashcards = Flashcard::with('userAnswer')->get()->map(function ($flashcard) {
            return [
                $flashcard->id,
                $flashcard->answer,
                $flashcard->userAnswer->status ?? UserAnswer::ANSWER_STATUS_NOT_ANSWERED
            ];
        });

        //Getting just the count of the correct answers to calculate the percentage        
        $correct = UserAnswer::where('status', UserAnswer::ANSWER_STATUS_CORRECT)->count();

        $headers = ['#', 'Question', 'Status'];

        $total = count($flashcards);

        $correctPercentage = ($correct / $total) * 100;

        $this->table($headers, $flashcards);

        $this->info(sprintf('Correct answers: %d%%  of %d ', $correctPercentage, $total));
    }
    /**
     * Asks for the next flashcard to be answered and check if the answer is correct
     *
     * @void
     */
    public function pratice()
    {
        $flashcardID = $this->ask('Choose the next flashcard');

        $flashcard = Flashcard::with('userAnswer')->find($flashcardID);
        if ($flashcard) {
            //TODO : create scope isCorrect inside UserAnswer
            $userAnswer = $flashcard->userAnswer;
            if (!isset($userAnswer)) {
                $userAnswer = new UserAnswer();
            }

            if (!$userAnswer->isCorrect()) {
                $userAnswer->user_answer = $this->ask($flashcard->question);

                if ($flashcard->testAnswer($userAnswer->user_answer)) {
                    $userAnswer->status = UserAnswer::ANSWER_STATUS_CORRECT;
                    $this->info('You got it right!');
                } else {
                    $userAnswer->status = UserAnswer::ANSWER_STATUS_INCORRECT;
                    $this->warn('Wrong Answer!');
                }
                $flashcard->userAnswer()->save($userAnswer);
            } else {
                $this->warn("You've answered this one already");
            }
        } else {
            $this->info('Flashcard not found');
        }
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->printTable();

        $this->line('');

        $this->pratice();

        return self::SUCCESS;
    }
}
