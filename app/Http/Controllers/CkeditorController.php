<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function index(){
        return view('ckeditor');
    }

    public function upload(Request $request):JsonResponse{
       if($request->hasFile('upload')){
        $originalName=$request->file('upload')->getClientOriginalName();
        $fileName=pathinfo($originalName,PATHINFO_FILENAME);
        $extension=$request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('images'),$fileName);
        $url = asset('media/' . $fileName);
        return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
       }
    }
}
