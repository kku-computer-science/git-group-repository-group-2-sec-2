@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<style>
    .my-select {
        background-color: #fff;
        color: #212529;
        border: #000 0.2 solid;
        border-radius: 10px;
        padding: 4px 10px;
        width: 100%;
        font-size: 14px;
    }
</style>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>{{ trans('message.Whoops!') }}</strong> {{ trans('message.There were some problems with your input.') }}.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- <a class="btn btn-primary" href="{{ route('funds.index') }}"> Back </a> -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ trans('message.Add Research Fund') }}</h4>
                <p class="card-description">{{ trans('message.Fill in the form below to add a new research fund') }}</p>
                <form class="forms-sample" action="{{ route('funds.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputfund_type" class="col-sm-2 ">{{ trans('message.Research Fund Type') }}</label>
                        <div class="col-sm-4">
                            <select name="fund_type" class="custom-select my-select" id="fund_type" onchange='toggleDropdown(this);' required oninvalid="this.setCustomValidity('{{trans('message.Please specify the type of fund')}}')" oninput="setCustomValidity('')">
                                <option value="" disabled selected>{{ trans('message.Please specify the type of fund') }}</option>
                                <option value="ทุนภายใน">{{ trans('message.Internal Fund') }}</option>
                                <option value="ทุนภายนอก">{{ trans('message.External Fund') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="fund_code">
                        <div class="form-group row">
                            <label for="exampleInputfund_level" class="col-sm-2 ">{{ trans('message.Funding Level') }}</label>
                            <div class="col-sm-4">
                                <select name="fund_level" class="custom-select my-select" required oninvalid="this.setCustomValidity('{{trans('message.Please specify the level of fund')}}')" oninput="setCustomValidity('')">
                                    <option value="" disabled selected>{{ trans('message.Please specify the level of fund') }}</option>
                                    <option value="">{{ trans('message.Not Specified') }}</option>
                                    <option value="สูง">{{ trans('message.High') }}</option>
                                    <option value="กลาง">{{ trans('message.Medium') }}</option>
                                    <option value="ล่าง">{{ trans('message.Low') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputfund_name" class="col-sm-2 ">{{ trans('message.Fund Name') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="fund_name" class="form-control" placeholder="{{ trans('message.Fund Name') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="exampleInputsupport_resource" class="col-sm-2 ">{{ trans('message.Supporting Agency / Research Project') }}</label>
                        <div class="col-sm-8">
                            <input type="text" name="support_resource" class="form-control" placeholder="{{ trans('message.Support Resource') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">{{ trans('message.Submit') }}</button>
                    <a class="btn btn-light" href="{{ route('funds.index')}}">{{ trans('message.Cancel') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const ac = document.getElementById("fund_code");
    //ac.style.display = "none";

    function toggleDropdown(selObj) {
        ac.style.display = selObj.value === "ทุนภายใน" ? "block" : "none";
    }
</script>
@endsection