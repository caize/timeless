@extends('layouts.admin-app')

@section('css')
    @parent

    {{-- 标签输入框样式 --}}
    <link href="{{ asset('css/jquery.tagsinput.css') }}" rel="stylesheet">

    {{-- 下拉多选框样式 --}}
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>博客管理</span></h2>
        {!! Breadcrumbs::render('admin-blog-post-create') !!}
    </div>

    <div class="contentpanel">

        <div class="row">

            <div class="col-sm-12 col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="panel-close">×</a>
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">添加文章</h4>
                    </div>

                    <form class="form-horizontal form-bordered" action="{{ route('admin.blog.post.store') }}" method="POST">

                        <div class="panel-body panel-body-nopadding">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="title"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="必填项" value="{{ old('title') }}" 
                                           required="required" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SEO标题 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="slug"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="多个英文数字以-相连" value="{{ old('slug') }}" 
                                           required="required" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">类型 <span class="asterisk">*</span></label>

                                <div class="col-sm-2">
                                    <select class="form-control input-sm" name="type">
                                        <option value="post" {{ old('type') == 'post' ? 'selected' : '' }}>文章</option>
                                        <option value="page" {{ old('type') == 'page' ? 'selected' : '' }}>页面</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类 <span class="asterisk">*</span></label>

                                <div class="col-sm-5">
                                    <select class="select2" 
                                    name="classes[]" multiple data-placeholder="选择分类">
                                        <option value=""></option>                                        
                                        @inject('blogMetasPresenter', 'App\Presenters\BlogMetasPresenter')

                                        {!! $blogMetasPresenter->classesSelect() !!}
                                    </select>
                                </div>
                                <div class="col-sm-1 help-block">
                                    <a href="{{ route('admin.blog.meta.create') }}" class="btn btn-white tooltips"
                                       data-toggle="tooltip" data-original-title="新增分类"><i
                                                class="glyphicon glyphicon-plus"></i></a>                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">书签 <span class="asterisk"></span></label>
                                
                                <div class="col-sm-2">
                                    <input name="tags" id="tags" class="form-control" value="{{ old('tags') }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">来源 <span class="asterisk"></span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="source"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="若是转载文章，此处填写出处" value="{{ old('source') }}" 
                                           maxlength="20">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">来源链接 <span class="asterisk"></span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="source_url"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="转载文章的链接地址" value="{{ old('source_url') }}" 
                                           maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">摘要 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <textarea name="summary" maxlength="500" class="form-control" rows="5">{{ old('summary') }}</textarea>
                                </div>
                            </div> 


                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容 <span class="asterisk">*</span></label>

                                <div class="col-sm-7">
                                    {{-- 加载编辑器的容器 --}}
                                    <script id="container" name="content" type="text/plain">
                                        {!! old('content') !!}
                                    </script>
                                </div>
                            </div>

                            {{ csrf_field() }}

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-primary">保存</button>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>
                </div>

            </div><!-- col-sm-9 -->

        </div><!-- row -->

    </div>
@endsection

@section('javascript')
    @parent

    <script src="{!! asset('/laravel-u-editor/ueditor.config.js') !!}"></script>
    <script src="{!! asset('/laravel-u-editor/ueditor.all.min.js') !!}"></script>

    {{-- 实例化编辑器--}}
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            initialFrameHeight: 600,
            textarea: 'content',
        });

        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');   
        });
    </script>

    {{-- 书签输入框 --}}
    <script src="{!! asset('js/jquery.tagsinput.min.js') !!}"></script>
    
    <script type="text/javascript">
        $('#tags').tagsInput({width: 'auto', defaultText: '添加书签'});       
    </script>

    {{-- 多选框 --}}
    <script src="{!! asset('js/select2.min.js') !!}"></script>
    
    <script type="text/javascript">
        $(".select2").select2({width: '100%'});       
    </script>    
        
@endsection
