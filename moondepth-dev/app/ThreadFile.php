<?php

namespace App;

//use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class ThreadFile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'thread_files';

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
        'tid', 's3_path', 's3_full_path', 'original_name', 'mime_type', 'size', 'width', 'height'
    ];

    /**
     * Get the thread that owns the file.
     */
    public function thread()
    {
        return $this->belongsTo('\App\Thread', 'tid');
    }
}
