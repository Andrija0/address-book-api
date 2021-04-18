<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoRequest $request)
    {
        if ($files = $request->file('file')) {

            $file = $request->file->store('photos');

            $photo = Photo::create([
                'path' => $file,
                'user_id' => auth()->guard('api')->user()->id,
            ]);

            return response($photo, Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return response($photo, Response::HTTP_OK);
    }
}
