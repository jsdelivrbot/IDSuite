<?php
/**
 * Created by PhpStorm.
 * User: amac
 * Date: 10/3/17
 * Time: 9:46 AM
 */

namespace App;


use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class VidyoTokenGenerator
{

    private $expire_seconds = 172800;

    private $host_id, $output;

    public $token, $room;

    public function __construct($username)  {

        $key = env("VIDYO_DEV_KEY");
        $app_id = env("VIDYO_APP_ID");
        $this->host_id = env("VIDYO_HOST_ID");

        $command = 'python '.base_path().'/generateToken.py --key ' . $key . ' --appID ' . $app_id . ' --userName ' . $username . ' --expiresInSecs ' . $this->expire_seconds;

        $process = new Process($command);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->output = $process->getOutput();

        $this->token = trim($this->output, "\n");

        $this->room = $username;

        return $this;
    }


    public function getToken(){
        return $this->token;
    }

    public function getRoom(){
        return $this->room;
    }

}