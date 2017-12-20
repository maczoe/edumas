<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{
    
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_number', 'document_series', 'date_time',
        'payment', 'serie_id'
        ];
    
    protected $dates = [
        'date_time'
        ];
    
 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    
    public function serie()
    {
        return $this->belongsTo('App\Models\Serie');
    }
    
    public function paymentDetails() {
        return $this->hasMany('App\Models\PaymentDetail');
    }
    
    public function getPaymentCurrencyAttribute() {
        //TODO replace here with currency locale set by global config
        return 'Q '.number_format($this->payment,2);
    }
}

