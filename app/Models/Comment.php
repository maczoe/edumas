<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{   
    use SoftDeletes;

    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment'
        ];
}
