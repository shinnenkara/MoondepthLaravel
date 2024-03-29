<?php

namespace App;

//use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boards';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'headline';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount_of_threads',
    ];

    /**
     * Get the threads for the defined board.
     */
    public function threads()
    {
        return $this->hasMany('\App\Thread', "bid");
    }
}
