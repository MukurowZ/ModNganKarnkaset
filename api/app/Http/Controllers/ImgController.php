<?php

namespace App\Http\Controllers;

use App\Model\Img;
use App\Model\Img_set;
use Illuminate\Http\Request;
use App\Http\Requests\ImgRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Input;
// use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Http\Testing\File;

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


    public function post_upload(Request $request)
    {
        $files = $request->file('file');
        if(!empty($files)):
            $set = Img_set::create([
                'name' => $request['name'],
                'owner_id' => $request['owner_id']
            ]);
            foreach ($files as $file) {
                $path = '';
                $cater = '';
                $path = $file->getClientOriginalName();
                if (strpos($path, '.jpg') !== false) {
                    $cater = '.jpg';
                } elseif (strpos($path, '.png') !== false ){
                    $cater = '.png';
                } elseif (strpos($path, '.jpeg') !== false ){
                    $cater = '.jpeg';
                } elseif (strpos($path, '.gif') !== false ){
                    $cater = '.gif';
                };
                $path = Hash::make($path);
                $path = str_replace("/","-",$path);
                $path = str_replace(".","-",$path);
                $path = "".$path.$cater;
                Img::create([
                    'img_set_id' => $set['id'],
                    'path' => $path
                ]);
                Storage::put("public/imgs/".$path,file_get_contents($file),'public');
            }
        endif;

       return response()->json(array('success' => true));
	}
}
