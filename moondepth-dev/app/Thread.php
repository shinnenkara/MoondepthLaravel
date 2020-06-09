<?php

namespace App;

//use BaoPham\DynamoDb\DynamoDbModel;
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bid', 'uid', 'topic', 'subject_text', 'amount_of_messages', 'amount_of_documents',
    ];

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

    /**
     * Get the files for the defined thread.
     */
    public function files()
    {
        return $this->hasMany('\App\ThreadFile', "tid");
    }
}
