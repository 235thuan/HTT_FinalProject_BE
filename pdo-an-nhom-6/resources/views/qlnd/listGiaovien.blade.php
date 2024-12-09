@extends('layouts.vertical', ['title' => 'Danh sách giáo viên'])

@section('content')
<div class="container-fluid" id="teacher-lists">
<div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Danh sách giáo viên</h4>
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @include('qlnd.partials.teacher-list')
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Handle pagination clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        $.get(url, function(data) {
            $('#teacher-lists').html(data.html);
        });
    });
});
</script>
@endsection