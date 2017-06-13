<div class="avatar-acount">
    <div class="changes-avatar">
        {!! Form::open(['route' => 'frontend.user.profile.photo', 'id' => 'photo-form', 'method' => 'POST', 'files' => true]) !!}
            {!! Form::hidden('user_id', Auth::user()->id ) !!}
             {{ csrf_field() }}
            <div class="img-acount">
                @if (Auth::user()->photo != null)
                    <img src="{{ Auth::user()->photo }}" style="width: 200px; height: 200px;" 
                        alt="{{ Auth::user()->name }}">
                @else
                    <img src="{{ asset('frontend/images/default.png') }}" 
                        alt="{{ Auth::user()->name }}">
                @endif
            </div>
            <div class="choses-file up-file">
                <input type="hidden" name="file_name" id="file_name">

                {!! Form::file('image', null, ['id' => 'image']) !!}<br/>
                <button type="submit" class="mc-btn btn-primary hide" id="profile_upload" style="padding: 5px;"><span class="fa fa-arrow-up">&nbsp; Upload</span></button>
            </div>
        {!! Form::close() !!}
    </div>  
</div>

@section('after-scripts')
    <script type="text/javascript">

         $("input[type='file']").change(function(){
               $("#profile_upload").removeClass('hide');
            });
    </script>

@stop

