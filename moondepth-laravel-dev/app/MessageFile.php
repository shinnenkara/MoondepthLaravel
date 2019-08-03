<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'message_files';

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
        'mid', 's3_path', 's3_full_path', 'original_name', 'mime_type', 'size', 'width', 'height'
    ];

    /**
     * Get the message that owns the file.
     */
    public function message()
    {
        return $this->belongsTo('\App\Message', 'mid');
    }
}
