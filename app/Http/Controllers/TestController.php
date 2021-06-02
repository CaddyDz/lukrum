<?php

namespace App\Http\Controllers;

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Argument\Text\FontWeight;
use Cloudinary\Transformation\ImageTransformation;
use Cloudinary\Transformation\Overlay;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Source;
use Cloudinary\Transformation\TextStyle;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test() {

        $cld = new Cloudinary();

        $img = $cld->image("pmc/assets/zdmoy2ms4kko4h5xbuff")
            ->resize(Resize::scale()->width(10));

        $img->overlay(Overlay::source(Source::text('Bibeg', (new TextStyle('Times New Roman', 40)))));

        dd((string)$img->toUrl());


        $x = Overlay::source(
            Source::text(
                'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                (new TextStyle('Neucha', 26))
                    ->fontWeight(FontWeight::bold())
            )->transformation(
                (new ImageTransformation())
                    ->resize(Resize::fit()->width(200))

            )
        );

        dd(Source::text(
            'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            (new TextStyle('Neucha', 26))
                ->fontWeight(FontWeight::bold())
        )->re());

    }
}
