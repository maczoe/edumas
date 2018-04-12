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
        'document_number', 'document_series', 'date_time', 'payment_date',
        'payment', 'serie_id', 'status'
        ];
    
    protected $dates = [
        'date_time', 'payment_date'
        ];
    
 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function paymentPlan() 
    {
        return $this->belongsTo('App\Models\PaymentPlan');
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

    public function getStatusAttribute() 
    {
        if($this->attributes['status']) {
            if($this->attributes['status']=='ok') {
                return 'Finalizado';
            } else if($this->attributes['status']=='canceled'){
                return 'Anulado';
            } else {
                return 'Desconocido';
            }
        } else {
            return null;
        }
    }

    public function setStatusAttribute($value) 
    {
        if($value=='Finalizado') {
            $this->attributes['status'] = 'ok';
        } else if($value=='Anulado') {
            $this->attributes['status'] = 'canceled';
        } else {
            $this->attributes['status'] = 'unknown';
        }
    }
}

