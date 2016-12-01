<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size', 'team_id'];

    public function add($user)
    {
        $this->guardAgainstTooManyMembers();

        $method = $user instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($user);
    }

    public function remove(User $user)
    {
        $user->leaveTeam();
    }

    public function removeMany($users){
        $this->members()
            ->whereIn('id', $users->pluck('id'))
            ->update(['team_id'=>null]);
    }

    public function restart()
    {
        return $this->members()->update(['team_id' => null]);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    protected function guardAgainstTooManyMembers()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception;
        }
    }
}
