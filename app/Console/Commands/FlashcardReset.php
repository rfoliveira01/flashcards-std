<?php

namespace App\Console\Commands;

use App\Models\UserAnswer;
use Illuminate\Console\Command;

class FlashcardReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:reset';

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
        if($this->confirm("Do you really wish to reset all your progress?")){
            $answers = UserAnswer::all();

            foreach ($answers as $answer){
                $answer->status = UserAnswer::ANSWER_STATUS_NOT_ANSWERED;
                $answer->save();
            }

            $this->warn("All your progress was erased");
        }else{
            $this->info("All your progress was kept");
        }

        return self::SUCCESS;
    }
}
