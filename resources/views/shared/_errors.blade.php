@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul class="list-unstyled mb-2 mt-2">
        @foreach($errors->all() as $error)
            <li> 
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ $error }}
            </li>
        @endforeach
        </ul>
    </div>
@endif