@if(Session::has('success'))
    <div class="alert alert-success text-center">
        {{Session::get("success")}}.
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning text-center">
        {{Session::get("warning")}}.
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger text-center">
        {{Session::get("error")}}.
    </div>
@endif
