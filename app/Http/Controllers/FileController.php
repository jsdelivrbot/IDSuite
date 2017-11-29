<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{


    public function storeFile(request $request)
    {
        $data = $request->get('image');

        if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $data, $matches)) {
            $imageType = $matches[1];
            $imageData = base64_decode($matches[2]);
            $image = imagecreatefromstring($imageData);
            $filename = md5($imageData) . '.png';

            if (imagepng($image, public_path().'/img/' . $filename)) {
                return response()->json(array('filename' => 'https://idsuite.xyz:8081/img/' . $filename));
            } else {

                return response()->json("could not save the file");

            }
        } else {

            return response()->json("Invalid Data URL");

        }

    }



}
