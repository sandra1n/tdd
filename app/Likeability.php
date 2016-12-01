<?php

namespace App;

use Illuminate\Support\Facades\Auth;

/**
 * Created by SmashingTeam.
 * User: sandra1n
 * Date: 12/1/16
 * Time: 11:20 AM
 */
trait Likeability
{
    public function likes()
    {
        return $this->morphMany(Likes::class, 'likeable');
    }

    public function like()
    {
        $like = new Likes(['user_id' => Auth::id()]);
        $this->likes()->save($like);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', Auth::id())->delete();
    }

    public function isLiked()
    {
        return !!$this->likes()->where('user_id', Auth::id())
            ->count();
    }

    public function toggle()
    {
        if ($this->isLiked()) {
            return $this->unlike();
        }

        return $this->like();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}