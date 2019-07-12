<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'threads';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /**
     * Get the board that owns the thread.
     */
    public function board()
    {
        return $this->belongsTo('\App\Board', 'bid');
    }

    /**
     * Get the user that owns the thread.
     */
    public function user()
    {
        return $this->belongsTo('\App\User', 'uid');
    }

    /**
     * Get the messages for the defined thread.
     */
    public function messages()
    {
        return $this->hasMany('\App\Message', "tid");
    }
}
