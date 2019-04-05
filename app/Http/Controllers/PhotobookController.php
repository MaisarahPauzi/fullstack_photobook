<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photobook;
use Illuminate\Support\Facades\File;
class PhotobookController extends Controller
{
    public function index(){
        $data = auth()->user()->photobooks;
 
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    public function show($id){
        $data = auth()->user()->photobooks()->find($id);
 
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Photo with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $data->toArray()
        ], 400);
    }
    public function store (Request $request){
        $data = new Photobook();
        
        $data->title = $request->input('title');
        $data->caption = $request->input('caption');
        $data->filename=$request->input('filename');
        if (auth()->user()->photobooks()->save($data))
            return response()->json([
                'success' => true,
                'data' => $data->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Data could not be added'
            ], 500);
    }

    public function update(Request $request, $id){
        $data = auth()->user()->photobooks()->find($id);
 
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'data with id ' . $id . ' not found'
            ], 400);
        }
        
        $updated = $data->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true,
                'data' => $data->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'data could not be updated'
            ], 500);
    }
    
    public function destroy($id){
        $data = auth()->user()->photobooks()->find($id);
 
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'data with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($data->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data could not be deleted'
            ], 500);
        }
    }

    public function upload(Request $request){
        // cache the file
        $file = $request->file('file');
  
        // generate a new filename. getClientOriginalExtension() for the file extension
        $filename = $file->getClientOriginalName();
    
        // save to storage/app/photos as the new $filename
        $path = $file->storeAs('storage', $filename);

        dd($path);
      }
  
      public function del(Request $request, $dfile){
              unlink('../public/storage/'.$dfile);         
              return "Fail berjaya dibuang";
          
          
      }


}
