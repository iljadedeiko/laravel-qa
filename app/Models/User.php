<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

    public function questions() {
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

    public function getUrlAttribute() {
//        return route("question.show", $this->id);
        return '#';
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        if ($voteAnswers->where('answer_id', $answer->id)->exists()) {
            $voteAnswers->updateExistingPivot($answer, ['votes_sum' => $vote]);
        } else {
            $voteAnswers->attach($answer, ['votes_sum' => $vote]);
        }

        $answer->load('voteAnswers');
        $votesDown = $answer->voteAnswers()->wherePivot('votes_sum', -1)->sum('votes_sum');
        $votesUp = $answer->voteAnswers()->wherePivot('votes_sum', 1)->sum('votes_sum');
        $answer->votes_count = (int)$votesDown + (int)$votesUp;
        $answer->save();
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('question_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question, ['votes_sum' => $vote]);
        } else {
            $voteQuestions->attach($question, ['votes_sum' => $vote]);
        }

        $question->load('voteQuestions');
        $votesDown = $question->voteQuestions()->wherePivot('votes_sum', -1)->sum('votes_sum');
        $votesUp = $question->voteQuestions()->wherePivot('votes_sum', 1)->sum('votes_sum');
        $question->votes_count = (int)$votesDown + (int)$votesUp;
        $question->save();
    }
}
