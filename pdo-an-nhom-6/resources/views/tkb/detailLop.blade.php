@extends('layouts.vertical', ['title' => "Thời khóa biểu lớp {$ten_lop}"])

@push('css')
    <style>
        .schedule-cell { min-height: 100px; }
        .schedule-item {
            padding: 8px;
            margin-bottom: 8px;
            border-radius: 4px;
            background-color: #e3f2fd;
            border-left: 4px solid #1976d2;
        }
        .morning { background-color: #fff3e0; border-left-color: #f57c00; }
        .afternoon { background-color: #e8f5e9; border-left-color: #388e3c; }
        .evening { background-color: #fce4ec; border-left-color: #c2185b; }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex">
                            <a href="{{ route('schedule.lop', ['ten_lop' => urlencode($ten_lop), 'week' => $prevWeek]) }}"
                               class="btn btn-secondary me-2">
                                <i class="mdi mdi-arrow-left"></i> Tuần trước
                            </a>
                            <a href="{{ route('schedule.lop', ['ten_lop' => urlencode($ten_lop)]) }}"
                               class="btn btn-primary me-2">
                                Tuần hiện tại
                            </a>
                            <a href="{{ route('schedule.lop', ['ten_lop' => urlencode($ten_lop), 'week' => $nextWeek]) }}"
                               class="btn btn-secondary">
                                Tuần sau <i class="mdi mdi-arrow-right"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">
                        Thời khóa biểu lớp {{ $ten_lop }}
                        <small class="text-muted">
                            (Tuần từ {{ \Carbon\Carbon::parse($currentWeek)->format('d/m/Y') }})
                        </small>
                    </h4>
                </div>
            </div>
        </div>

        <!-- Schedule table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if($schedule->isNotEmpty())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 100px">Buổi</th>
                                        @php
                                            $startDate = \Carbon\Carbon::parse($currentWeek);
                                        @endphp
                                        @for($i = 0; $i < 6; $i++)
                                            @php
                                                $currentDate = $startDate->copy()->addDays($i);
                                            @endphp
                                            <th class="text-center">
                                                {{ $currentDate->format('l') }}<br>
                                                {{ $currentDate->format('d/m/Y') }}
                                            </th>
                                        @endfor
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(['Sáng' => ['06:00:00', '11:30:00'],
                                            'Chiều' => ['13:00:00', '17:30:00'],
                                            'Tối' => ['18:00:00', '21:30:00']] as $session => $hours)
                                        <tr>
                                            <td class="align-middle">{{ $session }}</td>
                                            @for($i = 0; $i < 6; $i++)
                                                @php
                                                    $currentDate = $startDate->copy()->addDays($i);
                                                    $sessionSchedules = $schedule->filter(function($item) use ($currentDate, $hours) {
                                                        return $item->ngay_hoc == $currentDate->format('Y-m-d')
                                                            && $item->gio_bat_dau >= $hours[0]
                                                            && $item->gio_bat_dau < $hours[1];
                                                    });
                                                @endphp
                                                <td class="schedule-cell">
                                                    @foreach($sessionSchedules as $item)
                                                        <div class="schedule-item {{ strtolower($session) }}">
                                                            <div class="fw-bold">{{ $item->ten_monhoc }}</div>
                                                            <div>
                                                                <i class="mdi mdi-clock-outline"></i>
                                                                {{ \Carbon\Carbon::parse($item->gio_bat_dau)->format('H:i') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($item->gio_ket_thuc)->format('H:i') }}
                                                            </div>
                                                            <div>
                                                                <i class="mdi mdi-account"></i>
                                                                {{ $item->ten_giaovien }}
                                                            </div>
                                                            <div>
                                                                <i class="mdi mdi-map-marker"></i>
                                                                {{ $item->ten_phonghoc }}
                                                                @if($item->khu_vuc)
                                                                    ({{ $item->khu_vuc }})
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            @include('tkb.partial.empty-schedule')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
