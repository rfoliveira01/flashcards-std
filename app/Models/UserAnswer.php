<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;
    const ANSWER_STATUS_NOT_ANSWERED = 'Not Answered';
    const ANSWER_STATUS_INCORRECT = 'Incorrect';
    const ANSWER_STATUS_CORRECT = 'Correct';
    const ANSWER_STATUS_ENUM  = [
        self::ANSWER_STATUS_NOT_ANSWERED,
        self::ANSWER_STATUS_INCORRECT,
        self::ANSWER_STATUS_CORRECT
    ];
    
   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;



   public function isCorrect(){
       return $this->status === self::ANSWER_STATUS_CORRECT;
   }
}
