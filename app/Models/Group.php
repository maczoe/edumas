<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'days', 'section', 'start_date',
        'end_date', 'start_time', 'end_time',
        'daysWeek', 'grade_id'
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
    
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }
    
    public function students()
    {
        return $this->belongsToMany('App\Models\Student');
    }
    
    public function classes() {
        return $this->hasMany('App\Models\Class');
    }
    
    public function setDaysWeekAttribute($value) {
        if(is_array($value)) {
            $this->attributes['days'] = implode(",", $value);
        } else {
            $this->attributes['days'] = $value;
        }
    }
    
    public function getDaysWeekAttribute() {
        if($this->days) {
        $value = explode(',', $this->days);
        $array = array();
        foreach($value as $day) {
            switch ($day) {
                case "1":
                    $array["Lunes"] = 1;
                    break;
                case "2":
                    $array["Martes"] = 2;
                    break;
                case "3":
                    $array["Miercoles"] = 3;
                    break;
                case "4":
                    $array["Jueves"] = 4;
                    break;
                case "5":
                    $array["Viernes"] = 5;
                    break;
                case "6":
                    $array["Sábado"] = 6;
                    break;
                case "7":
                    $array["Domingo"] = 7;
                    break;
            }
        }
        return $array;
        } else {
            return null;
        }
    }
    
    public function getNameAttribute() {
        return $this->section.' ('.$this->start_time.'-'.$this->end_time.')';
    }
}
