<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FlashcardInteractive extends Command
{
    public const MENU_OPTIONS = [
        [1, 'Create a flashcard'],
        [2, 'List all flashcads'],
        [3, 'Pratice'],
        [4, 'Show stats'],
        [5, 'Reset'],
        [6, 'Exit']
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:interactive';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Start Flashcards App';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line("Welcome to Flashcards");

        $this->table(['# ', 'Option '], self::MENU_OPTIONS);

        $option  = $this->ask("Select the desired option", 6);

        switch ($option) {
            case 1:
                $this->call('flashcard:new');
                break;
            case 2:
                $this->call('flashcard:list');
                break;
            case 3:
                $this->call('flashcard:pratice');
                break;
            case 4:
                $this->call('flashcard:stats');
                break;
            case 5:
                $this->call('flashcard:reset');
                break;
            case 6:
                return self::SUCCESS;
                break;
            default:
                $this->warn("Invalid option");
                return self::INVALID;
        }

        $this->ask("Press enter to continue");

        //Start the command again untill the user selects 6
        $this->call('flashcard:interactive');
    }
}
