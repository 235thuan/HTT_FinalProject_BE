@extends('layouts.vertical', ['title' => 'Danh sách sinh viên'])

@section('css')
<style>
.highlight-row {
    animation: highlight 3s;
}
@keyframes highlight {
    0% { background-color: #fff3cd; }
    100% { background-color: transparent; }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Danh sách sinh viên</h4>
            </div>
        </div>
    </div>

    <div id="student-lists">
        @include('qlnd.partials.student-list')
    </div>
</div>

@if(isset($findStudent))
<script>
$(document).ready(function() {
    var studentRow = $(`tr[data-student-id="{{ $findStudent }}"]`);
    if (studentRow.length) {
        // Calculate if the student is in viewport
        var rowTop = studentRow.offset().top;
        var windowTop = $(window).scrollTop();
        var windowBottom = windowTop + $(window).height();
        
        // Only scroll if the student is not already visible
        if (rowTop < windowTop || rowTop > windowBottom) {
            $('html, body').animate({
                scrollTop: rowTop - 100
            }, 500);
        }
        
        studentRow.addClass('highlight-row');
        setTimeout(() => studentRow.removeClass('highlight-row'), 3000);
    }
});
</script>
@endif
@endsection