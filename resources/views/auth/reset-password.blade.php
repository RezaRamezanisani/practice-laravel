<form action="{{route('reset.password.post')}}" method="POST">
    @csrf
    <input type="hidden" value="{{$token}}" name="token"/>
    <input type="email" name="email" placeholder="email"/>
    <input type="password" name="password" placeholder="password"/>
    <input type="password" name="confirm" placeholder="confirm"/>
    <input type="submit" value="Submit"/>
</form>
@if(Session::has('invalid token'))
    <p>{{ Session::get('invalid token') }}</p>
@endif
@if($errors->any())
    <p>error</p>
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif
