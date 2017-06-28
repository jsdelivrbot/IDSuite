<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 6/28/17
 * Time: 11:20 AM
 */

namespace App\Http\Controllers;


class RandomNumberController
{
    public function getRandomNumber(){
        return session('randomnumber');
    }

}