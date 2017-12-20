<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentPlan extends Model 
{   
    
    use SoftDeletes;
    
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'pay_day', 'period',
        'price', 'fault',
        'grade_id', 'subject_id',
        'establishment_id'
        ];
    
 
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }
    
    public function establishment()
    {
        return $this->belongsTo('App\Models\Establishment');
    }
    
    public function subject() {
        return $this->belongsTo('App\Models\Subject');
    }
    
    public function students() {
        return $this->belongsToMany('App\Models\Student', 'students_plans');
    }
    
    public function getPriceCurrencyAttribute() {
        //TODO replace here with currency locale set by global config
        return 'Q '.$this->price;
    }
    
    public function getFaultCurrencyAttribute() {
        //TODO replace here with currency locale set by global config
        return 'Q '.$this->fault;
    }
    
    public function getPeriodLocalAttribute() {
        return \Illuminate\Support\Facades\Lang::get('attrib.'.$this->period);
    }
}
