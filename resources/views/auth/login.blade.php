Login
@if(Session::has('msg'))
    @switch(Session::get('error'))
        @case('not find')
            <p>You were not found</p>
           @break
        @case('signup')
            <p>You is signup </p>
            @break
       @default
    @endswitch
@endif

<form action="{{route('login')}}" method="POST">
    @csrf
    <input type="text" name="email_phone" placeholder="email or phone"/>
    <br>
    @if($errors->has('email_phone')) {{$errors->first('email_phone')}} @endif
    <input type="password" name="password" placeholder="password" />
    <br>
    @if($errors->has('password')) {{$errors->first('password')}} @endif
    <br>
    <input type="checkbox" name="remember"/>
    <button type="submit">Submit</button>
</form>
<a href="{{route('forget.password')}}">forget password</a>

@auth
    {{Auth::user()->username}}
@endauth

@if(Session::has('password-reset'))
    <p>{{ Session::get('password-reset') }}</p>
@endif



{{--//Tips:--}}
{{--//Session::has vs Session::exists()--}}
{{--// in has session is present and not null but exists is present and can be null--}}
{{--//missing -> The missing method returns true if the item is null or if the item is not present:--}}
{{--//Session::put(key,value) sort data--}}
{{--//push ,push data into array--}}
{{--//if the user.teams key contains an array of team names, you may push a new value onto the array like so:--}}
{{--//$request->session()->push('user.teams', 'developers');--}}
{{--//pull retrieving so delete--}}
{{--//if session is value number for increment or decrement--}}
{{--//$request->session()->increment('count');--}}

{{--//$request->session()->increment('count', $incrementBy = 2);--}}

{{--//$request->session()->decrement('count');--}}

{{--//$request->session()->decrement('count', $decrementBy = 2);--}}
{{--//flash is back()->with()--}}
{{--//forget for delete--}}
{{--//$request->session()->forget(['name', 'status']);--}}
{{--//delete all flush--}}

{{--//regenerate--}}
