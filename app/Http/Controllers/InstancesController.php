<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstancesController extends Controller
{
    public function FrontEndJson() {
        return response()->json(instance()->FrontEndJson());
    }

    public function Favicon() {
        $content = instance()->Favicon();
        header('accept-ranges: bytes');
        header('Content-Type: image/png');
        header('Content-Length: '.strlen($content));
        header('etag: "Batman"');
        header('last-modified: Sat, 01 May 2021 12:50:06 GMT');
        die($content);
    }
}
