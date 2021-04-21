@extends('layout.main')

@section('content')
    <div class="page-container">


        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">

                        <i class="Hui-iconfont">&#xe600;</i> 修改新闻
            </span>

        </div>
        <div class="mt-20">
            <form action="{{ route('admin.news.update',$new->id)}}"  method="post" class="form form-horizontal"
                  id="form-admin-role-add">
                {{ method_field("PATCH") }}
                @csrf
                {{--<input name="update" value="update"  style="display: none">--}}
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>名称：</label>
                    <div class="formControls col-sm-10">
                        <input type="text" class="input-text" value="{{ $new->name }}" name="name">
                    </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>类别：</label>
                    <div class="formControls col-sm-10">
                        <input type="text" class="input-text" value="{{ $new->cate }}" name="cate">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>子类别：</label>
                    <div class="formControls col-sm-10">
                        <input type="text" class="input-text" value="{{ $new->subCate }}" name="subCate">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>是否展示：</label>
                    <div class="formControls col-sm-10">
                        <input type="radio" name="isShow" value="T"  @if($new->isShow == 'T') checked="checked" @else '' @endif >是
                        <input type="radio" name="isShow" value="F" @if($new->isShow == 'F') checked="checked" @else '' @endif>否
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>是否热门：</label>
                    <div class="formControls col-sm-10">
                        <input type="radio" name="isHot" value="T"  @if($new->isHot == 'T') checked="checked"  @endif>是
                        <input type="radio" name="isHot" value="F" @if($new->isHot == 'F') checked="checked"  @endif>否
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>是否推荐：</label>
                    <div class="formControls col-sm-10">
                        <input type="radio" name="isRem" value="T" @if($new->isRem == 'T') checked="checked"  @endif >是
                        <input type="radio" name="isRem" value="F" @if($new->isRem == 'F') checked="checked"  @endif>否
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>所属网站：</label>
                    <div class="formControls col-sm-10">
                        <input type="text" class="input-text" value="{{ $new->site }}" name="site">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>内容简介：</label>
                    <div class="formControls col-sm-10">
                        <input type="text" class="input-text" value="{{ $new->shot_cont }}" name="shot_cont">
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-2">缩略图片：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <div class="uploader-thum-container">
                            <div id="filePicker">选择图片</div>
                            <input type="hidden" id="course_pic" name="src">
                            <img src="{{ $new->src }}" value="{{$new->src}}" style="width: 100px;" id="pic">
                        </div>
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-sm-2"><span class="c-red">*</span>内容：</label>
                    <div class="formControls col-sm-10">
                        <textarea name="content" id=" content ">{!! $new->content !!}</textarea>
                    </div>

                </div>

                <div class="row cl">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-success radius">
                            <i class="icon-ok"></i>
                            更新新闻
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/admin/lib/webuploader/0.1.5/webuploader.css">
@endsection

@section('js')
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>

    <script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>
    <script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
    <script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
    <script>


      UE.getEditor(' content ')
    $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-role-add").validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: '新闻名称你不能不填写'
                }
            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
            submitHandler: function (form) {
                // alert(form);
                form.submit();
            }
        });

        // var ue = UE.getEditor('editor', {
        //     initialFrameWidth: 1380,
        //     initialFrameHeight: 500
        // });


        var uploader = WebUploader.create({
            auto: true,
            swf: '{{st('admin')}}/lib/webuploader/0.1.5/Uploader.swf',
            // 文件接收服务端。
            server: '{{ route('admin.upfile') }}',
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
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
        uploader.on('uploadSuccess', function (file, res) {
            $('#course_pic').val(res.file);
            $('#pic').attr('src', res.file);
        });
    </script>
@endsection

