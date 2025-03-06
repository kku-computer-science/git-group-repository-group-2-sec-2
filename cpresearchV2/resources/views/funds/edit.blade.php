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
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{trans('message.edit_fund')}}</h4>
                <p class="card-description">{{trans('message.edit_fund_details')}}</p>
                <form class="forms-sample" action="{{ route('funds.update',$fund->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <p class="col-sm-3 "><b>{{ trans('message.Research Fund Type') }}</b></p>
                        <!-- <label for="exampleInputfund_type" class="col-sm-2 ">ประเภททุนวิจัย</label> -->
                        <div class="col-sm-4">
                            <select name="fund_type" class="custom-select my-select" id="fund_type" onchange='toggleDropdown(this);' required>
                                <option value="ทุนภายใน" {{ $fund->fund_type == 'ทุนภายใน' ? 'selected' : '' }}>{{ trans('message.Internal Fund') }}</option>
                                <option value="ทุนภายนอก" {{ $fund->fund_type == 'ทุนภายนอก' ? 'selected' : '' }}>{{ trans('message.External Fund') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="fund_code">
                        <div class="form-group row">
                            <p class="col-sm-3"><b>{{ trans('message.Funding Level') }}</b></p>
                            <div class="col-sm-4">
                                <select name="fund_level" class="custom-select my-select">
                                    <option value="" {{ $fund->fund_level == '' ? 'selected' : '' }}>{{ trans('message.Not Specified') }}</option>
                                    <option value="สูง" {{ $fund->fund_level == 'สูง' ? 'selected' : '' }}>{{ trans('message.High') }}</option>
                                    <option value="กลาง" {{ $fund->fund_level == 'กลาง' ? 'selected' : '' }}>{{ trans('message.Medium') }}</option>
                                    <option value="ล่าง" {{ $fund->fund_level == 'ล่าง' ? 'selected' : '' }}>{{ trans('message.Low') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <p class="col-sm-3 "><b>{{ trans('message.Fund Name') }}</b></p>
                        <div class="col-sm-8">
                            <input type="text" name="fund_name" value="{{ $fund->fund_name }}" class="form-control" placeholder="{{ trans('message.Fund Name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <p class="col-sm-3 "><b>{{ trans('message.Supporting Agency / Research Project') }}</b></p>
                        <div class="col-sm-8">
                            <input type="text" name="support_resource" value="{{ $fund->support_resource }}" class="form-control" placeholder="{{ trans('message.Support Resource') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5">{{trans('message.submit_button')}}</button>
                    <a class="btn btn-light mt-5" href="{{ route('funds.index')}}">{{trans('message.cancel_button')}}</a>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    const ac = document.getElementById("fund_code");
    const ab = document.getElementById("fund_type").value;
    //console.log(ab);
    if (ab === "ทุนภายนอก") {
        ac.style.display = "none";
    }

    //ac.style.display = "none";

    function toggleDropdown(selObj) {
        ac.style.display = selObj.value === "ทุนภายใน" ? "block" : "none";
    }
</script>
@endsection