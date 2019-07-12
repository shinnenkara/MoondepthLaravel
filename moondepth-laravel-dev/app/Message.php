<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /**
     * Get the thread that owns the message.
     */
    public function thread()
    {
        return $this->belongsTo('\App\Thread', 'tid');
    }

    /**
     * Get the user that owns the message.
     */
    public function user()
    {
        return $this->belongsTo('\App\User', 'uid');
    }
}
