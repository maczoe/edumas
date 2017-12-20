<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attendances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'attended'
        ];
    
 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function class_()
    {
        return $this->belongsTo('App\Models\Class');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    
}
