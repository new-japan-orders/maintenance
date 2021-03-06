@extends('layouts.app')

@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Edit #{{$maintenance->id}} </h1>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('maintenances.update', ['id' => $maintenance->id]) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="form-group row">
                    <label for="start_at" class="col-md-4 col-form-label text-md-right">開始日時</label>

                    <div class="col-md-8">
                        {{Form::selectRange('start_at[year]', 1970, 2018, $start_at['year'], ['class' => 'field'])}}年
                        {{Form::selectRange('start_at[month]', 01, 12, $start_at['month'], ['class' => 'field'])}}月
                        {{Form::selectRange('start_at[day]', 00, 31, $start_at['day'], ['class' => 'field'])}}日
                        {{Form::selectRange('start_at[hour]', 00, 23, $start_at['hour'], ['class' => 'field'])}}時
                        {{Form::selectRange('start_at[min]', 00, 59, ltrim($start_at['min'], "0"), ['class' => 'field'])}}分
                    </div>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-link pull-right" href="{{ route('maintenances.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
