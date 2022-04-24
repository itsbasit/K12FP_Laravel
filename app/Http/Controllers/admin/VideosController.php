<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\helper;
use App\Models\admin\VideosModel;
use DataTables;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VideosModel::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="videos/'.$row->id.'/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>';
                           $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

      return view('dashboard.pages.admin.videos.videos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('dashboard.pages.admin.videos.addVideo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new VideosModel;
        $data->title = $request->title;
        $data->video_link = $request->url;
        $data->save();
        toastr()->success('Record inserted Successfully');
        return redirect('admin/videos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $data = VideosModel::find($id);
    return view('dashboard.pages.admin.videos.editVideo',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $data = VideosModel::find($id);
            $data->title = $request->title;
            $data->video_link = $request->url;
            $data->update();
            toastr()->success('Record Updated Successfully');
            return redirect('admin/videos');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VideosModel::where('id', $id)->delete();
        return response()->json("success");
    }
}