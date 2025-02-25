@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
@section('title','Dashboard')

@section('content')

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{trans('message.patent')}}</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('patents.create') }}"><i class="mdi mdi-plus btn-icon-prepend"></i> {{trans('message.add')}}</a>
            <!-- <div class="table-responsive"> -->
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{trans('message.no_dot')}}</th>
                        <th>{{trans('message.patent_name')}}</th>
                        <th>{{trans('message.patent_type')}}</th>
                        <th>{{trans('message.patent_date')}}</th>
                        <th>{{trans('message.patent_number')}}</th>
                        <th>{{trans('message.patent_author')}}</th>
                        <th width="280px">{{trans('message.action')}}</th>
                    </tr>
                    <thead>
                    <tbody>
                        @foreach ($patents as $i=>$paper)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ Str::limit($paper->ac_name,50) }}</td>
                            <td>
                                @php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                @endphp

                                @if ($locale == 'th')
                                {{ $paper->ac_type }} {{-- แสดงค่าตาม Database ถ้าเป็นภาษาไทย --}}
                                @elseif ($locale == 'zh')
                                @switch($paper->ac_type)
                                @case('สิทธิบัตร')
                                专利
                                @break
                                @case('สิทธิบัตร (การประดิษฐ์)')
                                发明专利
                                @break
                                @case('สิทธิบัตร (การออกแบบผลิตภัณฑ์)')
                                设计专利
                                @break
                                @case('อนุสิทธิบัตร')
                                实用新型
                                @break
                                @case('ลิขสิทธิ์')
                                版权
                                @break
                                @case('ลิขสิทธิ์ (วรรณกรรม)')
                                文学版权
                                @break
                                @case('ลิขสิทธิ์ (ตนตรีกรรม)')
                                音乐版权
                                @break
                                @case('ลิขสิทธิ์ (ภาพยนตร์)')
                                电影版权
                                @break
                                @case('ลิขสิทธิ์ (ศิลปกรรม)')
                                艺术版权
                                @break
                                @case('ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)')
                                广播版权
                                @break
                                @case('ลิขสิทธิ์ (โสตทัศนวัสดุ)')
                                视听资料版权
                                @break
                                @case('ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)')
                                其他文学/科学/艺术版权
                                @break
                                @case('ลิขสิทธิ์ (สิ่งบันทึกเสียง)')
                                录音版权
                                @break
                                @case('ความลับทางการค้า')
                                商业机密
                                @break
                                @case('เครื่องหมายการค้า')
                                商标
                                @break
                                @default
                                {{ $paper->ac_type }}
                                @endswitch
                                @else {{-- ภาษาอังกฤษ --}}
                                @switch($paper->ac_type)
                                @case('สิทธิบัตร')
                                Patent
                                @break
                                @case('สิทธิบัตร (การประดิษฐ์)')
                                Invention Patent
                                @break
                                @case('สิทธิบัตร (การออกแบบผลิตภัณฑ์)')
                                Design Patent
                                @break
                                @case('อนุสิทธิบัตร')
                                Utility Model
                                @break
                                @case('ลิขสิทธิ์')
                                Copyright
                                @break
                                @case('ลิขสิทธิ์ (วรรณกรรม)')
                                Literary Copyright
                                @break
                                @case('ลิขสิทธิ์ (ตนตรีกรรม)')
                                Musical Copyright
                                @break
                                @case('ลิขสิทธิ์ (ภาพยนตร์)')
                                Film Copyright
                                @break
                                @case('ลิขสิทธิ์ (ศิลปกรรม)')
                                Artistic Copyright
                                @break
                                @case('ลิขสิทธิ์ (งานแพร่เสี่ยงแพร่ภาพ)')
                                Broadcast Copyright
                                @break
                                @case('ลิขสิทธิ์ (โสตทัศนวัสดุ)')
                                Audiovisual Copyright
                                @break
                                @case('ลิขสิทธิ์ (งานอื่นใดในแผนกวรรณคดี/วิทยาศาสตร์/ศิลปะ)')
                                Other Literary/Scientific/Artistic Copyright
                                @break
                                @case('ลิขสิทธิ์ (สิ่งบันทึกเสียง)')
                                Sound Recording Copyright
                                @break
                                @case('ความลับทางการค้า')
                                Trade Secret
                                @break
                                @case('เครื่องหมายการค้า')
                                Trademark
                                @break
                                @default
                                {{ $paper->ac_type }}
                                @endswitch
                                @endif
                            </td>

                            <td>{{ $paper->ac_year}}</td>
                            <td>{{ $paper->ac_refnumber,50 }}</td>
                            <td>
                                @foreach($paper->user as $a)
                                @if(app()->getLocale() == 'th')
                                {{ $a->fname_th }} {{ $a->lname_th }}
                                @else
                                {{ $a->fname_en }} {{ $a->lname_en }}
                                @endif
                                @if (!$loop->last),@endif
                                @endforeach
                            </td>

                            <td>
                                <form action="{{ route('patents.destroy',$paper->id) }}" method="POST">

                                    <!-- <a class="btn btn-info" href="{{ route('patents.show',$paper->id) }}">Show</a> -->
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="{{ route('patents.show',$paper->id) }}"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    <!-- <a class="btn btn-primary" href="{{ route('patents.edit',$paper->id) }}">Edit</a> -->
                                    @if(Auth::user()->can('update',$paper))
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('patents.edit',$paper->id) }}"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    @endif
                                    @if(Auth::user()->can('delete',$paper))
                                    @csrf
                                    @method('DELETE')
                                    <li class="list-inline-item">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" data-placement="top" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </li>
                                    @endif
                                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                </form>
                            </td>
                        </tr>
                        @endforeach
                <tbody>
            </table>
            <!-- </div> -->
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" defer></script>
<script>
    $(document).ready(function() {
        var table1 = $('#example1').DataTable({
            responsive: true,
            searching: true,
            lengthChange: true,
            language: {
                search: `{{trans('message.search')}}:`,
                lengthMenu: `{{trans('message.show')}} _MENU_ {{trans('message.entries')}}`,
                info: `{{trans('message.showing')}} _START_ {{trans('message.to')}} _END_ {{trans('message.of')}} _TOTAL_ {{trans('message.entries')}}`,
                paginate: {
                    next: `{{trans('message.next')}}`,
                    previous: `{{trans('message.previous')}}`
                },
                emptyTable: `{{trans('message.empty_table')}}`,
                zeroRecords: `{{trans('message.zero_record')}}`,
                infoEmpty: `{{trans('message.showing')}} 0 {{trans('message.to')}} 0 {{trans('message.of')}} 0 {{trans('message.entries')}}`,
                infoFiltered: `({{trans('message.filtered')}} {{trans('message.from')}} _MAX_ {{trans('message.entries')}})`,
            }
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `{{trans('message.Are_You_Sure')}}`,
                text: `{{trans('message.Delete_Warning')}}`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: {
                    cancel: {
                        text: `{{trans('message.Cancel')}}`,
                        visible: true,
                        className: "btn btn-secondary"
                    },
                    confirm: {
                        text: `{{trans('message.OK')}}`,
                        className: "btn btn-danger"
                    }
                },
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal(`{{trans('message.Delete_Warning')}}`, {
                        icon: "success",
                        buttons: {
                        confirm: {
                            text: `{{trans('message.OK')}}`,
                            className: "btn btn-info"
                        }
                    },
                    }).then(function() {
                        location.reload();
                        form.submit();
                    });
                }
            });
    });
</script>
@stop
