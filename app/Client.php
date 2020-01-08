<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    
    /**
     * Get the policies for the client
     */
    public function policies()
    {
        return $this->hasMany('App\Policies');
    }
    
    
    /**
     * Get the customers for the client
     */
    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
