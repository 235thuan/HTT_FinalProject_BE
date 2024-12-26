@extends('layouts.vertical', ['title' => 'Thống kê doanh thu học phí'])

@section('content')
    <div class="container-fluid">
        <!-- Tiêu đề -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Thống kê doanh thu học phí</h4>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng quan -->
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase mt-0">Tổng học phí đã thu</h6>
                                <h3 class="my-2">{{ number_format($totalPaid, 0, ',', '.') }}đ</h3>
                            </div>
                            <div class="avatar-sm">
                            <span class="avatar-title bg-soft-primary rounded">
                                <i class="mdi mdi-cash-multiple text-primary font-20"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase mt-0">Số lớp đã nộp</h6>
                                <h3 class="my-2">{{ $totalClasses }}</h3>
                            </div>
                            <div class="avatar-sm">
                            <span class="avatar-title bg-soft-success rounded">
                                <i class="mdi mdi-school text-success font-20"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách theo lớp -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Lớp</th>
                                    <th>Số sinh viên đã nộp</th>
                                    <th>Tổng học phí đã thu</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($classSummary as $class)
                                    <tr>
                                        <td>{{ $class->lop }}</td>
                                        <td>{{ $class->total_students }}</td>
                                        <td>{{ number_format($class->total_paid, 0, ',', '.') }}đ</td>
                                        <td>
                                            <a href="{{ route('hocphi.sales.detail', $class->lop) }}"
                                               class="btn btn-info btn-sm">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
