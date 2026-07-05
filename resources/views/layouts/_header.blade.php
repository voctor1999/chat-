 <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm my_navbar">
     <div class="container">
         <a class="navbar-brand d-flex align-items-center" href="{{route('root')}}">
             <img src="{{asset('pics/logo/sanli.jpg')}}" alt="logo" width="32" height="32" class="d-inline-block align-text-bottom me-2">
             MyChat
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                 <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="#">首页</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">Link</a>
                 </li>
             </ul>

             <ul class="navbar-nav">
                 @guest
                 <li class="nav-item">
                     <a class="nav-link" href="{{route('register')}}">注册</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{route('login')}}">登录</a>
                 </li>
                 @else
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <img src="{{Auth::user()->avatar}}" width="40" alt="avatar" class="img-thumbnail" />
                         {{Auth::user()->name}}
                     </a>
                     <ul class="dropdown-menu">
                         <li class="text-center">
                             <a class="dropdown-item" href="{{route('users.show',Auth::user()->id)}}">
                                 <i class="fa-solid fa-user-tie"></i>
                                 个人空间
                             </a>
                         </li>
                         <li class="text-center">
                             <a class="dropdown-item" href="{{route('users.edit',Auth::user()->id)}}">
                                 <i class="fa-solid fa-pen-to-square"></i>
                                 编辑资料
                             </a>
                         </li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                         <li class="text-center">
                             <form action="{{route('logout')}}" method="POST"
                                 onsubmit="return confirm('您是否真的要退出登录？')">
                                 @csrf
                                 <button class="btn btn-sm btn-danger" type="submit">
                                     <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                     退出
                                 </button>
                             </form>
                         </li>
                     </ul>
                 </li>
                 @endguest
             </ul>
         </div>
     </div>
 </nav>