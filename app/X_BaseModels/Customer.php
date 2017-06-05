<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/5/17
 * Time: 2:54 AM
 */

namespace App;

use App\Contact;
use App\Model as Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact'
    ];

    /**
     * The attributes that are guarded from mass assignable.
     *
     * @var array
     */
//    protected $guarded = [
//        'active', 'class_code'
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password_hash'
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer';


    /**
     * relationships
     */
    public function contact(){
        return $this->hasOne('App\Contact', 'mrgeid');
    }


    /**
     * Customer constructor.
     * @param $password string
     * @param array $attributes
     * @internal param string $firstname
     * @internal param string $lastname
     * @internal param string $email
     */
    public function __construct(Contact $contact = null, $password, $attributes = array())  {
        parent::__construct($attributes); // Eloquent
        // Your construct code.

        $this->active = 1;
        if($contact !== null) {
            $this->contact = $contact->mrge_id;
        } else {
            $this->contact = null;
        }
        $this->password_hash = Hash::make($password);

        $this->save();

    }


    /**
     * @param $password string
     * set customer password_hash
     */
    public function setPassword($password){
        // TODO Password Validation
        try{
            $this->isActive();
            $this->password_hash = Hash::make($password);
            if($this->exists) {
                $this->save();
            }
        } catch(\Exception $e) {
            dump($e->getMessage());
        }
    }

}