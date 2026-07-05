@extends('layouts.app')
@section('title',$user->name.'的个人编辑页面')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center pt-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                        编辑资料
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{route('users.update',$user->id)}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('shared._errors')
                        <div class="mb-3">
                            <label for="name" class="form-label">用户名</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="请输入用户名"
                                   value="{{old('name',$user->name)}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">邮箱</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   readonly  value="{{old('email',$user->email)}}">
                        </div>
                        <div class="mb-3">
                            <label for="introduction" class="form-label">个人简介</label>
                            <textarea name="introduction" class="form-control" id="introduction" rows="3">{{old('introduction',$user->introduction)}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">用户头像</label>
                            <input type="file" class="form-control" id="avatar" name="avatar"
                               > 
                        </div>
                        @if($user->avatar)
                        <img src="{{$user->avatar}}" alt="用户头像" class="img-fluid" style="display: block; margin: 0 auto;" width="100px">
                        @endif
                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection