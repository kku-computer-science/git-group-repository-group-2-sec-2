@extends('dashboards.users.layouts.user-dash-layout')
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap4.min.css">
@section('title','Project')

@section('content')

<div class="container">

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{trans('message.research_project')}}</h4>
            <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('researchProjects.create') }}"><i class="mdi mdi-plus btn-icon-prepend"></i> {{trans('message.add')}}</a>
            <!-- <div class="table-responsive"> -->
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>{{trans('message.no_dot')}}</th>
                        <th>{{trans('message.research_project_year')}}</th>
                        <th>{{trans('message.research_project_name')}}</th>
                        <th>{{trans('message.research_project_head')}}</th>
                        <th>{{trans('message.research_project_member')}}</th>
                        <th width="auto">{{trans('message.action')}}</th>
                    </tr>
                    <thead>
                    <tbody>
                        @foreach ($researchProjects as $i=>$researchProject)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $researchProject->project_year }}</td>
                            {{-- <td>{{ $researchProject->project_name }}</td> --}}
                            <td>{{ Str::limit($researchProject->project_name,70) }}</td>
                            <td>
                                @foreach($researchProject->user as $user)
                                @if ($user->pivot->role == 1)
                                @if (app()->getLocale() == 'th')
                                {{ $user->fname_th }}
                                @else
                                {{ $user->fname_en }}
                                @endif
                                @endif
                                @endforeach
                            </td>

                            <td>
                                @foreach($researchProject->user as $user)
                                @if ($user->pivot->role == 2)
                                @if (app()->getLocale() == 'th')
                                {{ $user->fname_th }}
                                @else
                                {{ $user->fname_en }}
                                @endif
                                @endif
                                @endforeach
                            </td>

                            <td>
                                <form action="{{ route('researchProjects.destroy',$researchProject->id) }}" method="POST">
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip"
                                            data-placement="top" title="view"
                                            href="{{ route('researchProjects.show',$researchProject->id) }}"><i
                                                class="mdi mdi-eye"></i></a>
                                    </li>
                                    <!-- @if(Auth::user()->can('update',$researchProject))
                                <a class="btn btn-primary"
                                    href="{{ route('researchProjects.edit',$researchProject->id) }}">Edit</a>
                                @endif -->

                                    @if(Auth::user()->can('update',$researchProject))
                                    <li class="list-inline-item">
                                        <a class="btn btn-outline-success btn-sm" type="button" data-toggle="tooltip"
                                            data-placement="top" title="Edit"
                                            href="{{ route('researchProjects.edit',$researchProject->id) }}"><i
                                                class="mdi mdi-pencil"></i></a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->can('delete',$researchProject))
                                    @csrf
                                    @method('DELETE')

                                    <li class="list-inline-item">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit"
                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                class="mdi mdi-delete"></i></button>
                                    </li>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                <tbody>

            </table>
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
        var table = $('#example1').DataTable({
            fixedHeader: true,
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
