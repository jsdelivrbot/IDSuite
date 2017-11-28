<?php

namespace App;

use App\Model as Model;

/**
 * App\File
 *
 * @mixin \Eloquent
 */
class File extends Model
{
    protected $table = "file";

    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * File constructor.
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        return $this;

    }




    


}
