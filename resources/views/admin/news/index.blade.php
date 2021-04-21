@extends('layout.main')

@section('content')
    <div class="page-container">


        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">

                 <a href="{{ route('admin.news.create')}}" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加新闻</a></span>
            </span>
            <span class="r">共有数据：<strong>{{ \App\Models\Admin\News::count() }}</strong> 条</span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>

                <tr class="text-c">
                    <th width="80">ID</th>
                    <th width="100">新闻标题</th>
                    <th width="70">类别</th>
                    <th width="70">子类别</th>
                    <th width="70">是否展示</th>
                    <th width="70">是否热门</th>
                    <th width="70">是否推荐</th>
                    <th width="70">所属网站</th>
                    <th width="130">新闻简介</th>
                    <th width="130">缩略图</th>
                    <th width="130">新闻内容</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>


                @forelse($news as $new)
                    <tr id="{{ $new->id }}">
                        <td>{{ $new->id }}</td>
                        <td name="name" class="name">{{ $new->name }}</td>

                        <td name="cate" class="name">{{ $new->cate }}</td>
                        <td name="subCate" class="name">{{ $new->subCate }}</td>
                        <td class="isFlag success" name="isShow">{{ $new->isShow }} </td>
                        <td class="isFlag success" name="isHot">
                            {{ $new->isHot }}
                        </td>
                        <td class="isFlag success" name="isRem">{{ $new->isRem }}</td>
                        <td name="site" class="name">{{ $new->site }}</td>
                        <td name="shot_cont" class="name">{{ $new->shot_cont }}</td>
                        <td>
                            {{--<label>图片</label>--}}
                            {{--<img src="{ $new->src }}" alt="" id="img" />--}}
                            {{--<input type="file" name="file" id="src{{ $new->id }}" onchange="postData()">--}}
                            <div  id="src{{ $new->id }}" style="">选择图片</div>
                            <img class="src" src="{{ $new->src }}" alt="" width="30%">
                        </td>
                        <td name="content">
                            {{ str_limit(strip_tags( $new->content) ,$limit = 30, $end = '...') }}
                            <span>
                                <button onclick='show_detail(this,"{{ $new->name }}")'
                                        class="cont btn size-MINI btn-primary radius">详情</button>
                                <div style="display: none" class="cont">{!! $new->content !!}</div>
                             </span>
                        </td>
                        <td class="text-c"  class="td-manage">
                            {{--修改 和 删除--}}
                            <a style="text-decoration:none" class="ml-12"
                               href='/admin/news/{{ $new->id }}/edit' ><i class="Hui-iconfont">&#xe60c;</i>
                            </a>
                            &nbsp; &nbsp;
                            <a title="删除" href="javascript:;" onclick="member_del(this,{{ $new->id }})" class="ml-12"
                               style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>
                            </a>
                        </td>
                        @empty
                            <td colspan="12">暂无数据</td>
                    </tr>

                @endforelse

                </tbody>
            </table>
            {{ $news->links() }}

        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
@endsection
@section('js')
    <script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>

    <script>


        function show_detail(t, tit) {

// alert(tit);
            var cont = $(t).next().html()
// alert($(t).next().html()) ;
            layer.open({
                type: 1,
                title: tit,
                skin: 'layui-layer-rim', //加上边框
                area: ['520px', '440px'], //宽高
                content: cont
            });
        }

        // 修改图片

        $(".src").each(function () {
            $(this).click(function () {
                var input = $(this).prev().children();
                if (input.children("input").length > 0) {
                    //当前td中的input，不执行click处理
                    return false;
                }
                let uploader = WebUploader.create({
                    auto: true,
                    swf: '{{st('admin')}}/lib/webuploader/0.1.5/Uploader.swf',
                    // 文件接收服务端。
                    server: '{{ route('admin.upfile') }}',
                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                    pick: '#src_{{ $new->id }}',
                    pick: '#' + $(this).siblings().attr('id'),
                    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                    resize: false,
                    // 只允许选择图片文件。
                    accept: {
                        title: 'Images',
                        extensions: 'gif,jpg,jpeg,bmp,png',
                        mimeTypes: 'image/*'
                    },
                    fileVal: 'pic',
                    formData: {
                        _token: "{{ csrf_token() }}"
                    }
                });
                var that = $(this);
                var ids =that.parent().parent().find('td').html();
               // alert(that.parent().parent().find('td').html());
                uploader.on('uploadSuccess', function (file, res) {
                    that.attr('src', res.file);
                    var data = {};
                    data['src'] = res.file;
                    data['_token'] = "{{ csrf_token() }}";
                    //将td的内容修改为文本框的内容
                    var url = '/admin/news/' + ids;
                    $.ajax({

                        url,
                        type: 'put',
                        data,
                        dataType: 'json',
                        success: ret => {

                            console.log(1111);
                            console.log(ret);
                            layer.msg(ret['message'], {time: 2000, icon: 6});
                        },
                        error: ret => {
                            console.log(ret);
                        }

                    })

                    that.prev().html('<div  id="src{{ $new->id }}" style="">选择图片</div>');
                });
            });
        });


        //修改名称
        $(".name").each(function () {
            $(this).click(function () {
                //找到当前鼠标点击的td
                var tdObj = $(this);
                //
                if (tdObj.children("input").length > 0) {
                    //当前td中的input，不执行click处理
                    return false;
                }
                var text = tdObj.html();
                //清空td的内容
                tdObj.html("");

                //创建一个文本框
                //去掉文本框的边框
                //文本框的文字大小16px
                //文本框的宽度与td相同
                //设置文本框的背景色
                //将td中的内容放到文本框中
                //将文本框插入到td中
                var inputObj = $("<input  type='text' />").css("border-width", "0")
                    .css("font-size", "16px")
                    .width(tdObj.width())
                    // .css("background-color", tdObj.css("background-color"))
                    .css("background-color", "pink")
                    .css("font", tdObj.css("font"))
                    .val(text)
                    .appendTo(tdObj);
                //文本框插入后被选中
                //inputObj.get(0).select();
                inputObj.trigger("focus").trigger("select");
                inputObj.click(function () {
                    return false;
                });
                //处理文本框的回车和Esc操作
                inputObj.keyup(function (event) {
                    //获取键值
                    var keycode = event.which;
                    //回车
                    if (keycode == 13) {
                        // console.log(1111111);
                        //获取当前文本框的内容
                        var inputText = $(this).val();
                        var tagName = tdObj.attr('name');
                        var data = {};
                        data[tagName] = inputText;
                        data['_token'] = "{{ csrf_token() }}";
                        //将td的内容修改为文本框的内容
                        var id = tdObj.parent().attr("id");
                        console.log(data);
                        var url = '/admin/news/' + id;
                        $.ajax({

                            url,
                            type: 'put',
                            data,
                            dataType: 'json',
                            success: ret => {

                                // console.log(ret);
                                tdObj.html(inputText);
                                layer.msg(ret['message'], {time: 2000, icon: 6});
                            },
                            error: ret => {
                                console.log(ret);
                            }

                        })


                    }

                    //esc情况,
                    //将td的内容还原成text
                    if (keycode == 27) {
                        tdObj.html(text);
                    }

                });

            });


        });

        //修改isFlag
        $(".isFlag").each(function () {
            $(this).click(function () {
                var id = $.trim($(this).parent().attr("id"));
                var value = $.trim(this.innerHTML);
                var url = '/admin/news/' + id;
                value = value == 'T' ? 'F' : 'T';
                var tagName = $(this).attr('name');
                var data = {};
                data[tagName] = value;
                data['_token'] = "{{ csrf_token() }}";
                // data =$.toJSON(data)
                // console.log( $.type(data));
                // console.log(data);


                $.ajax({

                    url,
                    type: 'put',
                    data,
                    dataType: 'json',
                    success: ret => {

                        console.log(ret);
                        $(this).html(value);
                        layer.msg(ret['message'], {time: 2000, icon: 6});
                    },
                    error: ret => {
                        console.log(ret);
                    }

                })
            });
        });


        // 删除
        function member_del(t, id) {
            layer.confirm('确认要删除吗？', function (index) {
                // 阻止默认事件
                url = '/admin/news/' + id;
                $.ajax({

                    url,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: ret => {
                        // console.log(ret);
                        $(t).parents('tr').remove();
                        layer.msg(ret['message'], {time: 2000, icon: 6});
                    }
                })
            });
        }

        //return false;

    </script>

@endsection