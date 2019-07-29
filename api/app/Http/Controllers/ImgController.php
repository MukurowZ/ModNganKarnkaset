<?php

namespace App\Http\Controllers;

use App\Model\Img;
use App\Http\Requests\ImgRequest;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Testing\File;

class ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Img::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImgRequest $request)
    {
        $validated = $request->validated();
        return Img::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function show(Img $img)
    {
        return $img;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function update(ImgRequest $request, Img $img)
    {
        $validated = $request->validated();
        $img->update($validated);
        return $img;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function destroy(Img $img)
    {
        $img->delete();
        return response('', 204);
    }

    public function getImgbySet(Img $id)
    {
        $search = $id['id'];
        return Img::all()->where('img_set_id', $search);
    }

    public function getOneImgSet(Img $id)
    {
        $search = $id['id'];
        return Img::where('img_set_id', $search)->first();
    }


    public function post_upload()
    {
		$input = Input::all();
		$rules = array(
		    'file' => 'image|max:3000',
		);
        dd('dsadas');
		$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors->first(), 400);
		}

		$file = Input::file('file');

        $extension = File::extension($file['name']);
        $directory = path('public').'uploads/'.sha1(time());
        $filename = sha1(time().time()).".{$extension}";

        $upload_success = Input::upload('file', $directory, $filename);

        if( $upload_success ) {
        	return Response::json('success', 200);
        } else {
        	return Response::json('error', 400);
        }
	}
}
