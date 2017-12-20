<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model 
{
   
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'marks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mark', 'detail'
        ];
    
 
    public function class_()
    {
        return $this->belongsTo('App\Models\Class');
    }
    
    public function student() {
        return $this->belongsTo('App\Models\Student');
    }
   
}
