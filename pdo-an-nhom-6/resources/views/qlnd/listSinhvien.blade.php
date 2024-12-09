@extends('layouts.vertical', ['title' => 'Danh sách sinh viên'])

@section('css')
<!-- Add any additional CSS here -->
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

    @include('qlnd.partials.student-list')
</div>
@endsection

@push('scripts')
<!-- Add any additional scripts here -->
@endpush