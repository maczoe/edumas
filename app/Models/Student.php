<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model 
{
    use SoftDeletes;
    
    
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';
    
    protected $dates = ['birth_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'id_number',
        'phone_number', 'cellphone_number', 'address',
        'birth_date', 'gender', 'comment'
        ];
    
    public function setBirthDateAttribute($date) {
         $this->attributes['birth_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $date);
    }
    
    public function getBirthDateAttribute($date) {
        if(is_null($date)) {
            return \Carbon\Carbon::now();
        }
        return $this->asDateTime($date);
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function paymentPlans() {
        return $this->belongsToMany('App\Models\PaymentPlan', 'students_plans');
    }
    
    public function payments() {
        return $this->hasMany('App\Models\Payment');
    }
    
    public function attendances() {
        return $this->hasMany('App\Models\Attendance');
    }
    
    public function marks() {
        return $this->hasMany('App\Models\Mark');
    }
    
    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }
    
    public function getIdNameAttribute() {
        return $this->id_number.' - '.$this->first_name.' '.$this->last_name;
    }
}
