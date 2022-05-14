<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\PasswordReset;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'mobile_number',
        'avatar',
        'address_line1',
        'address_line2',
        'city',
        'country',
        'github_link',
        'about'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->belongsToMany(Question::class, 'vote_questions');
    }

    public function voteAnswers()
    {
        return $this->belongsToMany(Answer::class, 'vote_answers');
    }

    public function getAvatarAttribute()
    {
        return isset($this->attributes['avatar'])
            ? 'images/' . $this->attributes['avatar']
            : 'images/avatar-default.png';
    }

    public function getRegisteredAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        if ($voteAnswers->where('answer_id', $answer->id)->exists()) {
            $voteAnswers->updateExistingPivot($answer, ['vote_value' => $vote]);
        } else {
            $voteAnswers->attach($answer, ['vote_value' => $vote]);
        }

        $answer->load('voteAnswers');
        $votesDown = $answer->voteAnswers()->wherePivot('vote_value', -1)->sum('vote_value');
        $votesUp = $answer->voteAnswers()->wherePivot('vote_value', 1)->sum('vote_value');
        $answer->votes_count = (int)$votesDown + (int)$votesUp;
        $answer->save();
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('question_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question, ['vote_value' => $vote]);
        } else {
            $voteQuestions->attach($question, ['vote_value' => $vote]);
        }

        $question->load('voteQuestions');
        $votesDown = $question->voteQuestions()->wherePivot('vote_value', -1)->sum('vote_value');
        $votesUp = $question->voteQuestions()->wherePivot('vote_value', 1)->sum('vote_value');
        $question->votes_count = (int)$votesDown + (int)$votesUp;
        $question->save();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }
}
