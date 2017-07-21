<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 12:45 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{

    protected $guarded = [
        'class_code',
        'active',
        'id'
    ];

    public $primaryKey = 'id';

    public $incrementing = false;

    public function __construct($attributes = array())  {
        parent::__construct($attributes); // Eloquent

        $this->class_code = \App\Enums\EnumClassCode::getClassCode(get_class($this));

        $this->id = $this->class_code . uniqid();

        $this->active = 1;

        return $this;

    }


    /**
     * @param $id
     * @return mixed
     */
    public static function getObjectById($id){
        $class = get_called_class();
        $results = $class::find($id);
        return $results;

    }


    /**
     * Returns whether or not this use is active.
     * @return bool
     * @internal param $id
     */
    public function isActive()
    {
        if ($this->active) {
            return true;
        } else {
            Throw new Exception('This Object is not active.', 409);
        }
    }
    
}