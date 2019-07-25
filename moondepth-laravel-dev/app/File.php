<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

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
        'tid', 'mid', 's3_path', 'original_name', 'mime_type', 'size'
    ];

    /**
     * Get the thread that owns the file.
     */
    public function thread()
    {
        return $this->belongsTo('\App\Thread', 'tid');
    }

    /**
     * Get the message that owns the file.
     */
    public function message()
    {
        return $this->belongsTo('\App\Message', 'mid');
    }
}
