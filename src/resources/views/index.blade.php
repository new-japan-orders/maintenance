@extends('layouts.app')

@section('header')
<div class="page-header clearfix">
    <h1>
        <i class="glyphicon glyphicon-align-justify"></i> Car
        <a class="btn btn-success pull-right" href="{{ route('maintenances.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
    </h1>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-xs btn-primary" href="{{ route('maintenances.create') }}">
            <i class="glyphicon glyphicon-edit"></i>新規作成
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @if($maintenances->count())
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="">開始予定日時</th>
                        <th class="">終了日時</th>
                        <th class="">状態</th>
                        <th class="text-right">操作</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($maintenances as $maintenance)
                        <tr>
                            <td class="text-center"><strong>{{$maintenance->id}}</strong></td>
                            <td>
                                {{ $maintenance->start_at }}
                            </td>
                            <td>
                                {{ $maintenance->finished_at ?? '' }}
                            </td>
                            <td>
                                @if ($maintenance->start_time <= time() && empty($maintenance->finished_at))
                                    メンテナンス中
                                @else
                                    {{ empty($maintenance->finished_at) ? '未' : '済' }}
                                @endif
                            </td>

                            <td class="text-right">
                                @if (empty($maintenance->finished_at))
                                <a class="btn btn-xs btn-primary" href="{{ route('maintenances.finish', $maintenance->id) }}">
                                    <i class="glyphicon glyphicon-eye-open"></i>メンテナンスを終了する
                                </a>
                                <a class="btn btn-xs btn-warning" href="{{ route('maintenances.edit', $maintenance->id) }}">
                                    <i class="glyphicon glyphicon-edit"></i>編集
                                </a>
                                @endif 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center alert alert-info">Empty!</h3>
        @endif

    </div>
</div>

@endsection
