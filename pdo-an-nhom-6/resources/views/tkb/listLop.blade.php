@extends('layouts.vertical', ['title' => 'Thời khóa biểu theo chuyên ngành'])

@section('content')
    <div class="container-fluid">
        <!-- ... other content ... -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($lops as $lop)
                                <div class="col-md-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ route('schedule.lop', ['ten_lop' => urlencode($lop->ten_lop)]) }}"
                                               class="text-reset text-decoration-none">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="mt-0 mb-1">{{ $lop->ten_lop }}</h5>
                                                        <p class="mb-0 text-muted">
                                                            <small>{{ $lop->si_so ?? 0 }} sinh viên</small>
                                                        </p>
                                                    </div>
                                                    <div class="avatar-sm">
                                                        <span class="avatar-title bg-soft-primary rounded">
                                                            <i class="mdi mdi-calendar-clock text-primary font-20"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
