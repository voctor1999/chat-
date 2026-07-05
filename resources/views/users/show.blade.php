@extends('layouts.app')
@section('title',$user->name.'的个人中心')
@section('content')
   <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img class="img-thumbnail border-0 rounded" src="{{$user->avatar}}" alt="avatar">
                <div class="card-body">
                    <hr>
                    <h5 class="text-muted text-center">
                        <i class="fa-solid fa-user-tie"></i>
                        用户名
                    </h5>
                    <h4 class="text-success text-center">
                        {{$user->name}}
                    </h4>
                    <hr>
                    <h5 class="text-muted text-center">
                        <i class="fa-solid fa-clipboard"></i>
                        个人简介
                    </h5>
                    <p class="text-success text-center">
                        {{$user->introduction}}
                        @if($user->introduction == '')
                            <small>暂无个人简介</small>
                        @endif
                    </p>
                    <hr>
                    <h5 class="text-muted text-center">
                        <i class="fa-regular fa-clock"></i>
                        注册时间
                    </h5>
                    <p class="text-success text-center">
                        {{$user->created_at->diffForHumans()}}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h1>{{$user->name}}--<small>{{$user->email}}</small></h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1>暂无信息</h1>
                </div>
            </div>
        </div>
    </div>

@endsection
