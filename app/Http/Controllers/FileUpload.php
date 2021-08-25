<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Controller
{
    public function createForm()
    {
        return view('file-upload');
    }

    public function fileUpload(Request $req)
    {
        $fili = new File();
        $fileName = $req->file->getClientOriginalName();
//        $filePath = $req->file('file')->store('storage');
//        dd($filePath);
//        $path = Storage::putFile('storage' , $req->file('file'));
//        dd($req);
        $path = Storage::putFileAs('storage'  , $req->file('file') , $fileName);
        $fili->name = $fileName;
        $fili->file_path = $path;
        $fili->save();
        dd($fili);


    }

}
