<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Flashcard extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flashcards';

   /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question', 'answer'];

    /**
     * Get the amswer associated with the flashcard.
    */
    public function userAnswer()
    {
        return $this->hasOne(UserAnswer::class);
    }

    public function testAnswer($answer){
        return trim(strtolower($answer)) == trim(strtolower($this->answer));
    }
}
