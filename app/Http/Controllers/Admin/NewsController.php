<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\News;
use App\Models\M3Result;
use http\Env;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
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
        $news = News::orderBy('updated_at','desc')->paginate(5);
//        dd($products);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加新闻

        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->input());
        News::create($request->except(['_token', 'file']));
        return redirect()->route('admin.news.index')->with('msg', '添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = News::where('id', $id)->first();
//        dd($data);
        $this->m3_result->status  = 0;
        $this->m3_result->message = '获取新闻' . $id . '详情成功！！！';
        $this->m3_result->data    = $data;
        return $this->m3_result->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $new = News::where('id', $id)->first();
//        dump($new);
        return view('admin.news.edit', compact('new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $data['src'] = \DB::table('NEWS')->where('id',$id)->first(['src'])->src;
//        dd($data['src']);
//        exit(222);
//        dump(11111);
//        echo($request->method());
        if ($request->method() == 'PATCH') {
            $data = $request->except(['_token','file', '_method']);
            $data['src'] = $request->input('src');
//            dump($data['src']);
            if(!$data['src']){
//                dump(111111111);
                $data['src'] = \DB::table('NEWS')->where('id',$id)->first(['src'])->src;
            }

          News::find($id)->update($data);
//          $new =  News::find($id);
//          $new->name = $data['name'];
//          $new->cate = $data['cate'];
//          $new->subCate = $data['subCate'];
//          $new->isShow = $data['isShow'];
//          $new->isHot = $data['isHot'];
//          $new->isRem = $data['isRem'];
//          $new->site = $data['site'];
//          $new->shot_cont = $data['shot_cont'];
//          $new->src = $data['src'];
//          $new->content = $data['content'];
//           $new->save();
            return redirect()->route('admin.news.index')->with('msg', '修改成功');

        }

        $data = $request->except("_token");
        $key = array_keys($data)[0];

        if (News::find($id)->update($data)) {
            $this->m3_result->status  = 0;
            $this->m3_result->message = '修改【' . $id . '】的值【' . $key . '】成功！！！';
            return $this->m3_result->toJson();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (News::destroy($id)) {
            $this->m3_result->status  = 0;
            $this->m3_result->message = '删除新闻' . $id . '成功！！！';
            return $this->m3_result->toJson();
        }
    }
}
