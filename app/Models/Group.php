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
        'days', 'section', 'start_time', 'end_time',
        'daysWeek', 'grade_id'
        ];
    
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
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
