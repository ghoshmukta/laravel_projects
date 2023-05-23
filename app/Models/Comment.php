<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [ 'body',
    'user_id',
    'thread_id',
    'is_best_reply',];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
