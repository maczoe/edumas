<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Class_ extends Model 
{   
    
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time', 'end_time',
        'subject_id', 'teacher_id',
        'establishment_id', 'group_id'
        ];
    
 
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }
    
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
    
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
    
    public function establishment()
    {
        return $this->belongsTo('App\Models\Establishment');
    }
    
    public function attendances() {
        return $this->hasMany('App\Models\Attendance');
    }
    
    public function marks() {
        return $this->hasMany('App\Models\Mark');
    }
    
    public function getNameAttribute() {
        return $this->subject()->first()->title.'-'
                .$this->teacher()->first()->fullname.' ('.$this->start_time.'-'.$this->end_time.')';
    }
}
