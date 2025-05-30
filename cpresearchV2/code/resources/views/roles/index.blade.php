@extends('dashboards.users.layouts.user-dash-layout')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
        <div class="card" style="padding: 16px;">
            <div class="card-body">
                <h4 class="card-title">{{trans('message.roles')}}</h4>
                @can('role-create')
                <a class="btn btn-primary btn-menu btn-icon-text btn-sm mb-3" href="{{ route('roles.create') }}"><i class="mdi mdi-plus btn-icon-prepend"></i>{{trans('message.add')}}</a>
                @endcan

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>{{trans('message.no_dot')}}</th>
                            <th>{{trans('message.role_name')}}</th>
                            <th width="280px">{{trans('message.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data as $key => $role)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                @php
                                $locale = app()->getLocale(); // ดึงภาษาปัจจุบัน
                                $roleTranslations = [
                                'admin' => ['en' => 'Admin', 'th' => 'ผู้ดูแลระบบ', 'zh' => '管理员'],
                                'teacher' => ['en' => 'Teacher', 'th' => 'อาจารย์', 'zh' => '教师'],
                                'student' => ['en' => 'Student', 'th' => 'นักศึกษา', 'zh' => '学生'],
                                'staff' => ['en' => 'Staff', 'th' => 'เจ้าหน้าที่', 'zh' => '职员'],
                                'head project' => ['en' => 'Head Project', 'th' => 'หัวหน้าโครงการ', 'zh' => '项目负责人'],
                                'project leader' => ['en' => 'Project Leader', 'th' => 'หัวหน้าโครงการ', 'zh' => '项目负责人'],
                                'System Administrator' => ['en' => 'System Administrator', 'th' => 'ผู้ดูแลระบบระบบ', 'zh' => '系统管理员'],
                                'Public Relations Officer' => ['en' => 'Public Relations Officer', 'th' => 'เจ้าหน้าที่ประชาสัมพันธ์', 'zh' => '公关人员'],
                                'Educator' => ['en' => 'Educator', 'th' => 'นักการศึกษา', 'zh' => '教育者'],
                                'Undergrad Student' => ['en' => 'Undergrad Student', 'th' => 'นักศึกษาปริญญาตรี', 'zh' => '本科生'],
                                'Master Student' => ['en' => 'Master Student', 'th' => 'นักศึกษาปริญญาโท', 'zh' => '研究生'],
                                'Doctoral Student' => ['en' => 'Doctoral Student', 'th' => 'นักศึกษาปริญญาเอก', 'zh' => '博士生'],
                                ];
                                @endphp

                                @if ($locale == 'en')
                                {{ $roleTranslations[$role->name][$locale] }}
                                @elseif (isset($roleTranslations[$role->name][$locale]))
                                {{ $roleTranslations[$role->name][$locale] }}
                                @else
                                {{ $role->name }}
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                    <a class="btn btn-outline-primary btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="view" href="{{ route('roles.show',$role->id) }}"><i class="mdi mdi-eye"></i></a>
                                    @can('role-edit')
                                    <a class="btn btn-outline-success btn-sm " type="button" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('roles.edit',$role->id) }}"><i class="mdi mdi-pencil"></i></a>
                                    @endcan


                                    @can('role-delete')

                                    @csrf
                                    @method('DELETE')

                                    <li class="list-inline-item">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-outline-danger btn-sm show_confirm" type="submit" data-toggle="tooltip" title="Delete"><i class="mdi mdi-delete"></i></button>
                                    </li>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->render() }}
            </div>
        </div>
    </div>
</div>
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
@endsection
