<?php

namespace Tests\Feature;

use App\Console\Commands\FlashcardInteractive;
use Illuminate\Console\Command;
use Tests\TestCase;

class FlashCardTest extends TestCase
{
     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_menu_invalid_entry()
    {
        $this->artisan('flashcard:interactive')
        ->expectsOutput('Welcome to Flashcards')
        ->expectsTable(['# ', 'Option '], FlashcardInteractive::MENU_OPTIONS)
        ->expectsQuestion('Select the desired option', 999)
        ->expectsOutput('Invalid option')
        ->assertExitCode(Command::INVALID);
    } 
    
     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_menu_invalid_exit()
    {
        $this->artisan('flashcard:interactive')
        ->expectsOutput('Welcome to Flashcards')
        ->expectsTable(['# ', 'Option '], FlashcardInteractive::MENU_OPTIONS)
        ->expectsQuestion('Select the desired option', 6)
        ->assertSuccessful();
    } 

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_new_flashcard_invalid()
    {
        $this->artisan('flashcard:new')
        ->expectsQuestion('Please write your question:', '')
        ->expectsQuestion('What is the answer to your question?', '')
        ->expectsOutput('The question and answer are required and the quetion must be unique')
        ->assertExitCode(Command::INVALID);
    }


    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_pratice()
    {
        $this->artisan('flashcard:pratice')
        ->expectsQuestion('Choose the next flashcard', -932)
        ->expectsOutput('Flashcard not found')
        ->assertExitCode(Command::SUCCESS);
    }

    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_reset_yes()
    {
        $this->artisan('flashcard:reset')
        ->expectsConfirmation('Do you really wish to reset all your progress?', 'yes')
        ->expectsOutput('All your progress was erased')
        ->assertExitCode(Command::SUCCESS);
    }

    
    /**
    * A basic feature test example.
    *
    * @return void
    */
    public function test_reset_no()
    {
        $this->artisan('flashcard:reset')
        ->expectsConfirmation('Do you really wish to reset all your progress?', 'no')
        ->expectsOutput('All your progress was kept')
        ->assertExitCode(Command::SUCCESS);
    }
}
