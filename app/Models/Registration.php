<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'registrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'student_id', 'period_id'
        ];
    
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function Period()
    {
        return $this->belongsTo('App\Models\Period');
    }
}
