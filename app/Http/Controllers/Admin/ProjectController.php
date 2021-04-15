<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Product;
use App\Models\M3Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->m3_result = new M3Result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(env('APP_URL'));
        $products   = Product::orderBy('created_at','desc')->orderBy('updated_at','desc')->get();
//        dd($products);
        return view('admin.project.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加工程

        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//                dd($request->input());
        Product::create($request->except(['_token','file']));
        return redirect()->route('admin.project.index')->with('msg', '添加成功');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

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
//        dd( $request->get());

       $data =  $request->except("_token");

       $key  =array_keys($data)[0] ;

        if(Product::find($id)->update($data)){
            $this->m3_result->status = 0;
            $this->m3_result->message = '修改【'.$id.'】的值【'.$key.'】成功！！！';
            return $this->m3_result->toJson();
        } ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

      if (Product::destroy($id)){
          $this->m3_result->status = 0;
          $this->m3_result->message = '删除'.$id.'成功！！！';
          return $this->m3_result->toJson();
      }

    }
}
