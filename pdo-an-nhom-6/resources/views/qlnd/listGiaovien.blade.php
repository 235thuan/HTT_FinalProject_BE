@extends('layouts.vertical', ['title' => 'Danh sách giáo viên'])

@section('content')
<div class="container-fluid" id="teacher-lists">
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