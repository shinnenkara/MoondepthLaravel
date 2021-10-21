<?php

namespace App\Models;

//use BaoPham\DynamoDb\DynamoDbModel;
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tid',
        'uid',
        'response_to',
        'text',
        'amount_of_documents',
    ];

    /**
     * Get the thread that owns the message.
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class, 'tid');
    }

    /**
     * Get the user that owns the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }

    /**
     * Get the files for the defined message.
     */
    public function files()
    {
        return $this->hasMany(MessageFile::class, "mid");
    }

    /**
     * Get the files for the defined message.
     */
    public function replies()
    {
        return $this->hasMany(Message::class, "response_to");
    }
}
