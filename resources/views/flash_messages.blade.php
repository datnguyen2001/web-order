@if(session('success'))
    <div class="alert alert-success alert_message" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert_message" role="alert">
        {{ session('error') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert_message" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert_message" role="alert">
        {{ session('info') }}
    </div>
@endif
