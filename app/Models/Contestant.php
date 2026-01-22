<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'region',
        'image',
        'payment_status',
        'status',
    ];

    /**
     * The votings that this contestant belongs to.
     */
    public function votings()
    {
        return $this->belongsToMany(Voting::class, 'voting_contestants', 'contestant_id', 'voting_id')
                    ->withPivot('status', 'payments')
                    ->withTimestamps();
    }

    /**
     * The voting contestant records for this contestant.
     */
    public function votingContestants()
    {
        return $this->hasMany(VotingContestant::class, 'contestant_id');
    }
}
