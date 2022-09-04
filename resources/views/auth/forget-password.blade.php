<form action="{{route('forget.password')}}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="email"/>
    <button type="submit">Submit</button>
</form>
<p>Notice:باگ حساس بودن پیدا کردن ایمیل در دیتا بیس</p>

@if($errors->any())
    <p>error</p>
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif

@if(Session::has('send email'))
    <p>{{ Session::get('send email') }}</p>
@endif

