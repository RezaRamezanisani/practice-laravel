Signup
<form action="{{route('signup')}}" method="POST">
    @csrf
    <input type="text" name="username" value="{{old('username')}}" placeholder="username"/>
    <input type="text" name="email_phone" value="{{old('email_phone')}}" placeholder="email or phone"/>
    <input type="password" name="password" value="{{old('password')}}" placeholder="password" />
    <input type="password" name="password_confirm" value="{{old('confirmed_password')}}" placeholder="confirmed password" />
    <button type="submit">Submit</button>
    <a href="{{route('auth.google')}}">Login with GOOGLE</a>
</form>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif

