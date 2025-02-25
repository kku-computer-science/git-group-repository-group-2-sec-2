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
            <h4 class="card-title">{{trans('message.published_research')}}</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('papers.create') }}"><i class="mdi mdi-plus btn-icon-prepend"></i> {{trans('message.add')}}</a>
            @if(Auth::user()->hasRole('teacher'))
            <!-- <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('callscopus',Auth::user()->id) }}"><i class="mdi mdi-refresh btn-icon-prepend"></i> Call Paper</a> -->
            <a class="btn btn-primary btn-icon-text btn-sm mb-3" href="{{ route('callpaper', Crypt::encrypt(Auth::user()->id)) }}">
                <i class="mdi mdi-refresh btn-icon-prepend icon-sm"></i> {{trans('message.published_research_call_paper')}}
            </a>

            @endif
            <!-- <div class="table-responsive"> -->
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{trans('message.no_dot')}}</th>
                        <th>{{trans('message.published_research_name')}}</th>
                        <th>{{trans('message.published_research_type')}}</th>
                        <th>{{trans('message.published_research_year')}}</th>
                        <!-- <th>ผู้เขียน</th>   -->
                        <!-- <th>Source Title</th> -->
                        <th width="280px">{{trans('message.action')}}</th>
                    </tr>
                    <thead>
                    <tbody>
                        @foreach ($papers->sortByDesc('paper_yearpub') as $i=>$paper)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ Str::limit($paper->paper_name,50) }}</td>
                            <td>
                                @php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                @endphp

                                @if ($locale == 'th')
                                @switch($paper->paper_type)
                                @case('Journal')
                                วารสาร
                                @break
                                @case('Conference Proceeding')
                                เอกสารการประชุม
                                @break
                                @case('Book Series')
                                หนังสือชุด
                                @break
                                @case('Book')
                                หนังสือ
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @elseif ($locale == 'zh')
                                @switch($paper->paper_type)
                                @case('Journal')
                                期刊
                                @break
                                @case('Conference Proceeding')
                                会议论文
                                @break
                                @case('Book Series')
                                丛书
                                @break
                                @case('Book')
                                书籍
                                @break
                                @default
                                {{ $paper->paper_type }}
                                @endswitch
                                @else
                                {{ $paper->paper_type }}
                                @endif
                            </td>

                            <td>{{ $paper->paper_yearpub }}</td>
                            <!-- <td>@foreach($paper->teacher->take(1) as $teacher)
                                    {{ $teacher->fname_en }} {{ $teacher->lname_en }},
                                    @endforeach
                                    @foreach($paper->author->take(1) as $teacher)
                                    {{ $teacher->author_fname }} {{ $teacher->author_lname }}
                                    @if (!$loop->last),@endif

                                    @endforeach

                                </td> -->
                            <!-- <td>{{ Str::limit($paper->paper_sourcetitle,50) }}</td> -->

                            <td>
                                <form action="{{ route('papers.destroy',$paper->id) }}" method="POST">

                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="{{ route('papers.show',$paper->id) }}"><i class="mdi mdi-eye"></i></a>
                                    </li>
                                    @if(Auth::user()->can('update',$paper))
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('papers.edit',Crypt::encrypt($paper->id)) }}"><i class="mdi mdi-pencil"></i></a>
                                    </li>
                                    @endif
                                    <!-- @csrf
                                        @method('DELETE')
                                        <li class="list-inline-item">
                                         <button class="btn btn-outline-danger btn-sm show_confirm" type="submit"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                 class="mdi mdi-delete"></i></button>
                                        </li> -->
                                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                </form>
                            </td>
                        </tr>
                        @endforeach
                <tbody>
            </table>
            <br>

            <!-- </div> -->
            <br>

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
                title: `Are you sure?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Delete Successfully", {
                        icon: "success",
                    }).then(function() {
                        location.reload();
                        form.submit();
                    });
                }
            });
    });
</script>
@stop
