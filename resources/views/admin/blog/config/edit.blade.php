@extends('layouts.admin-app')

@section('content')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> Dashboard <span>博客管理</span></h2>
        {!! Breadcrumbs::render('admin-blog-config-edit') !!}
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
                        <h4 class="panel-title">编辑配置</h4>
                    </div>

                    <form class="form-horizontal form-bordered"
                          action="{{ route('admin.blog.config.update',['id'=>$config->cid]) }}" method="POST">

                        <div class="panel-body panel-body-nopadding">

                            {{-- 校验字段重复的时候能够用到 --}}
                            <input type="hidden" name="cid" value="{{ $config->cid }}">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">名称 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text"  data-toggle="tooltip" name="name"
                                           data-trigger="hover" class="form-control tooltips"
                                           data-original-title="必填项，不能重复" value="{{ $config->name }}" 
                                           required="required" maxlength="20">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">值 <span class="asterisk">*</span></label>

                                <div class="col-sm-6">
                                    <textarea name="value" maxlength="200" class="form-control" rows="5">{{ $config->value }}</textarea>
                                </div>
                            </div>                   

                            <div class="form-group">
                                <label class="col-sm-3 control-label">描述 <span class="asterisk"></span></label>

                                <div class="col-sm-6">
                                    <textarea name="desc" maxlength="100" class="form-control" rows="5">{{ $config->desc }}</textarea>
                                </div>
                            </div> 

                            <input type="hidden" name="_method" value="PUT">

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
