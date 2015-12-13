{{dd(isset($errors))}}
@if(session($errors)) 
    @foreach(Session::get('$errors')->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
        <!-- when it has error, reload the page will auto open the modal -->
        <script>
            modal_autoopen("{{$id}}");
        </script>
    @endforeach
@endif