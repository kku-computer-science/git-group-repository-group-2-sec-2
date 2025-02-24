@extends('dashboards.users.layouts.user-dash-layout')
<style>
   .custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: trans('message.Choose File');
  display: inline-block;
  background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
  text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}
</style>

@section('content')
<div class="container mt-5">

  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ trans('message.Import Excel, CSV File') }}</h4>
        <form id="import-csv-form" method="POST" action="{{ url('import') }}" accept-charset="utf-8" enctype="multipart/form-data">
          @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="file">
                    </div>
                    @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>              
                 <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3" id="submit">{{ trans('message.Submit') }}</button>
                </div>
            </div>     
        </form>
    </div>
  </div>
</div>
@endsection