<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Establishment extends Model 
{   
    
    use SoftDeletes;
    
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'establishments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_number', 'name', 'phone_number',
        'address', 'comment'
        ];
    
 
    public function classes()
    {
        return $this->hasMany('App\Models\Class_');
    }
    
    public function cashflows() {
        return $this->hasMany('App\Models\Cashflow');
    }
}

