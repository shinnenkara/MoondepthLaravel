<?php

namespace App;

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
     * Get the threads for the defined board.
     */
    public function threads()
    {
        return $this->hasMany('\App\Thread', "bid");
    }
}
