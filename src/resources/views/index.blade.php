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
            @if($maintenances->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="">開始日時</th>
                            <th class="">終了日時</th>
                            <th class="">自動終了</th>
                            <th class="text-right">OPTIONS</th>
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
                                    {{ $maintenance->finish_at }}
                                </td>
                                <td>
                                    {{ empty($maintenance->finished_at) ? '手動' : '自動' }}
                                </td>

                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="">
                                        <i class="glyphicon glyphicon-eye-open"></i> View
                                    </a>
                                    
                                    <a class="btn btn-xs btn-warning" href="{{ route('maintenances.edit', $maintenance->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i> Edit
                                    </a>
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
