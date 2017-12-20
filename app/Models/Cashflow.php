<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model 
{   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cashflows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_number', 'customer', 'detail',
        'opening_balance', 'credit', 'debit',
        'final_balance'
        ];
    
 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function establishment()
    {
        return $this->belongsTo('App\Models\Establishment');
    }
    
}
