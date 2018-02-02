<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'periods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_date',
        'end_date'
        ];
    
    protected $dates = [
        'start_date',
        'end_date'
        ];
 
    public function setStartDateAttribute($date) {
        $this->attributes['start_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $date);
    }
    
    public function getStartDateAttribute($date) {
        if(is_null($date)) {
            return \Carbon\Carbon::now();
        }
        return $this->asDateTime($date);
    }
    
    public function setEndDateAttribute($date) {
        $this->attributes['end_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $date);
    }
    
    public function getEndDateAttribute($date) {
        if(is_null($date)) {
            return \Carbon\Carbon::now();
        }
        return $this->asDateTime($date);
    }
    
    public function registrations() {
        return $this->hasMany('App\Models\Registration');
    }
}
