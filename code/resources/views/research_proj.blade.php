@extends('layouts.layout')
@section('content')

<div class="container refund">
    <p>{{trans('message.research_proj_head')}}</p>

    @php
        $locale = app()->getLocale();

        $proj_type_en = [
            'ทุนภายใน' => 'Internal Funding',
            'ทุนภายนอก' => 'External Funding',
        ];
        $proj_type_th = [
            'ทุนภายใน' => 'ทุนภายใน',
            'ทุนภายนอก' => 'ทุนภายนอก',
        ];
        $proj_type_zh = [
            'ทุนภายใน' => '内部资金',
            'ทุนภายนอก' => '外部资金',
        ];

        $res_agency_en = [
            'สาขาวิชาวิทยาการคอมพิวเตอร์' => 'Department of Computer Science',
        ];
        $res_agency_th = [
            'สาขาวิชาวิทยาการคอมพิวเตอร์' => 'สาขาวิชาวิทยาการคอมพิวเตอร์',
        ];
        $res_agency_zh = [
            'สาขาวิชาวิทยาการคอมพิวเตอร์' => '计算机科学系',
        ];

        $fund_agency_en = [
            'มหาวิทยาลัยขอนแก่น' => 'Khon Kaen University',
            'OU, BOKU, JU, ITC, AIT, YNNU, FNU' => 'OU, BOKU, JU, ITC, AIT, YNNU, FNU',
            'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ' => 'National Science Technology and Innovation Policy Office',
            'สำนักงานคณะกรรมการวิจัยแห่งชาติ' => 'National Research Council of Thailand',
            'กระทรวงวิทยาศาสตร์และเทคโนโลยี' => 'Ministry of Science and Technology',
            'คณะวิทยาศาสตร์ มข.' => 'Faculty of Science, KKU',
            'วิทยาลัยการคอมพิวเตอร์' => 'College of Local Administration',
            'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ' => 'Geo-Informatics and Space Technology Development Agency (Public Organization)',
            'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม' => 'Office of the Permanent Secretary, Ministry of Higher Education, Science, Research and Innovation',

        ];
        $fund_agency_th = [
            'มหาวิทยาลัยขอนแก่น' => 'มหาวิทยาลัยขอนแก่น',
            'OU, BOKU, JU, ITC, AIT, YNNU, FNU' => 'OU, BOKU, JU, ITC, AIT, YNNU, FNU',
            'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ' => 'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ',
            'สำนักงานคณะกรรมการวิจัยแห่งชาติ' => 'สำนักงานคณะกรรมการวิจัยแห่งชาติ',
            'กระทรวงวิทยาศาสตร์และเทคโนโลยี' => 'กระทรวงวิทยาศาสตร์และเทคโนโลยี',
            'คณะวิทยาศาสตร์ มข.' => 'คณะวิทยาศาสตร์ มข.',
            'วิทยาลัยการคอมพิวเตอร์' => 'วิทยาลัยการคอมพิวเตอร์',
            'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ' => 'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ',
            'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม' => 'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม',

        ];
        $fund_agency_zh = [
            'มหาวิทยาลัยขอนแก่น' => '孔敬大学',
            'OU, BOKU, JU, ITC, AIT, YNNU, FNU' => 'OU, BOKU, JU, ITC, AIT, YNNU, FNU',
            'สำนักงานคณะกรรมการนโยบายวิทยาศาสตร์ เทคโนโลยีและนวัตกรรมแห่งชาติ' => '国家科技创新政策办公室',
            'สำนักงานคณะกรรมการวิจัยแห่งชาติ' => '泰国国家研究委员会',
            'กระทรวงวิทยาศาสตร์และเทคโนโลยี' => '泰国科学技术部',
            'คณะวิทยาศาสตร์ มข.' => '科学学院，KKU',
            'วิทยาลัยการคอมพิวเตอร์' => '地方管理学院',
            'ศูนย์ภูมิสารสนเทศเพื่อการพัฒนาภาคตะวันออกเฉียงเหนือ' => '地理信息与空间技术发展局（公共机构）',
            'สำนักงานปลัดกระทรวงอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม' => '高等教育，科学，研究和创新部常任秘书办公室',
        ];

        if ($locale === 'zh') {
            $proj_type_map = $proj_type_zh;
            $res_agency_map = $res_agency_zh;
            $fund_agency_map = $fund_agency_zh;
            $currencyText = '铢';
        } elseif ($locale === 'en') {
            $proj_type_map = $proj_type_en;
            $res_agency_map = $res_agency_en;
            $fund_agency_map = $fund_agency_en;
            $currencyText = 'Baht';
        } else {
            $proj_type_map = $proj_type_th;
            $res_agency_map = $res_agency_th;
            $fund_agency_map = $fund_agency_th;
            $currencyText = 'บาท';
        }
        

    @endphp

    <div class="table-refund table-responsive">
        <table id="example1" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th style="font-weight: bold;">{{trans('message.No.')}}</th>
                    <th class="col-md-1" style="font-weight: bold;">{{trans('message.year')}}</th>
                    <th class="col-md-4" style="font-weight: bold;">{{trans('message.proj_name')}}</th>
                    <!-- <th>ระยะเวลาโครงการ</th>
                    <th>ผู้รับผิดชอบโครงการ</th>
                    <th>ประเภททุนวิจัย</th>
                    <th>หน่วยงานที่สนันสนุนทุน</th>
                    <th>งบประมาณที่ได้รับจัดสรร</th> -->
                    <th class="col-md-4" style="font-weight: bold;">{{trans('message.desc')}}</th>
                    <th class="col-md-2" style="font-weight: bold;">{{trans('message.proj_lead')}}</th>
                    <!-- <th class="col-md-5">หน่วยงานที่รับผิดชอบ</th> -->
                    <th class="col-md-1" style="font-weight: bold;">{{trans('message.status')}}</th>
                </tr>
            </thead>


            <tbody>
                @foreach($resp as $i => $re)
                                @php
                                    $locale = app()->getLocale();
                                    $project_start = \Carbon\Carbon::parse($re->project_start);
                                    $project_end = \Carbon\Carbon::parse($re->project_end);

                                    if ($locale === 'th') {
                                        $formatted_start = $project_start->thaidate('j F Y');
                                        $formatted_end = $project_end->thaidate('j F Y');
                                    } else if ($locale === 'en') {
                                        $formatted_start = $project_start->format('j F Y');
                                        $formatted_end = $project_end->format('j F Y');
                                    } else {
                                        $formatter = new \IntlDateFormatter('zh_CN', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE, 'Asia/Shanghai', \IntlDateFormatter::GREGORIAN, 'yyyy年M月d日');
                                        $formatted_start = $formatter->format($project_start);
                                        $formatted_end = $formatter->format($project_end);
                                    }
                                @endphp
                                <tr>
                                    <td style="vertical-align: top;text-align: left;">{{$i + 1}}</td>
                                    <td style="vertical-align: top; text-align: left;">
                                        @if($locale === 'th')
                                            {{ $re->project_year + 543 }}
                                        @else
                                            {{ $re->project_year }}
                                        @endif
                                    </td>
                                    <td style="vertical-align: top;text-align: left;">
                                        {{$re->project_name}}

                                    </td>
                                    <td>
                                        <div style="padding-bottom: 10px">

                                            @if ($re->project_start != null)
                                                <span style="font-weight: bold;">
                                                    {{trans('message.proj_duration')}}
                                                </span>

                                                <span style="padding-left: 10px;">
                                                    {{ $formatted_start }} {{ trans('message.to') }} {{ $formatted_end }}
                                                </span>
                                            @else
                                                <span style="font-weight: bold;">
                                                    {{trans('message.proj_duration')}}
                                                </span>
                                                <span>

                                                </span>
                                            @endif
                                        </div>


                                        <!-- @if ($re->project_start != null)
                                                                                                                                        <td>{{\Carbon\Carbon::parse($re->project_start)->thaidate('j F Y') }}<br>ถึง {{\Carbon\Carbon::parse($re->project_end)->thaidate('j F Y') }}</td>
                                                                                                                                        @else
                                                                                                                                        <td></td>
                                                                                                                                        @endif -->

                                        <!-- <td>@foreach($re->user as $user)
                                                                                                                                            {{$user->position }}{{$user->fname_th}} {{$user->lname_th}}<br>
                                                                                                                                            @endforeach
                                                                                                                                        </td> -->
                                        <!-- <td>
                                                                                                                                            @if(is_null($re->fund))
                                                                                                                                            @else
                                                                                                                                            {{$re->fund->fund_type}}
                                                                                                                                            @endif
                                                                                                                                        </td> -->
                                        <!-- <td>@if(is_null($re->fund))
                                                                                                                                            @else
                                                                                                                                            {{$re->fund->support_resource}}
                                                                                                                                            @endif
                                                                                                                                        </td> -->
                                        <!-- <td>{{$re->budget}}</td> -->
                                        <div style="padding-bottom: 10px;">
                                            <span style="font-weight: bold;">{{trans('message.proj_type')}}</span>
                                            <span style="padding-left: 10px;"> @if(is_null($re->fund))
                                            @else
                                                {{$proj_type_map[$re->fund->fund_type] ?? $re->fund->fund_type}}
                                            @endif
                                            </span>
                                        </div>
                                        <div style="padding-bottom: 10px;">
                                            <span style="font-weight: bold;">{{trans('message.funding_agency')}}</span>
                                            <span style="padding-left: 10px;"> @if(is_null($re->fund))
                                            @else
                                                {{$fund_agency_map[$re->fund->support_resource] ?? $re->fund->support_resource}}
                                            @endif
                                            </span>
                                        </div>
                                        <div style="padding-bottom: 10px;">
                                            <span style="font-weight: bold;">{{trans('message.res_agency')}}</span>
                                            <span style="padding-left: 10px;">
                                                {{$res_agency_map[$re->responsible_department] ?? $re->responsible_department}}
                                            </span>
                                        </div>
                                        <div style="padding-bottom: 10px;">

                                            <span style="font-weight: bold;">{{trans('message.allocated_budget')}}</span>
                                            <span style="padding-left: 10px;"> {{number_format($re->budget)}} {{ $currencyText }}</span>
                                        </div>
                                    </td>

                                    <td style="vertical-align: top;text-align: left;">
                                        <div style="padding-bottom: 10px;">
                                            <span>
                                                @foreach($re->user as $user)
                                                @php
                                                // แปลง Ph.D. เป็น 博士 ถ้าเป็นภาษาจีน
                                                $doctoral_degree = $user->doctoral_degree == 'Ph.D.' ? ($locale == 'zh' ? '博士' : 'Ph.D.') : '';
                                                $positionMap = [];
                                                if ($locale === 'zh') {
                                                    $positionMap = [
                                                        'Assoc. Prof. Dr.' => '副教授 博士',
                                                        'Prof. Dr.'        => '教授 博士',
                                                        'Asst. Prof. Dr.'  => '助理教授 博士',
                                                        'Asst. Prof.'      => '助理教授',

                                                    ];
                                                }
                                                @endphp
                                                
                                                    @if($locale === 'th')
                                                        @if($user->position_en !== 'Lecturer')
                                                            {{$user->position_th}} {{$user->fname_th}} {{$user->lname_th}}<br>
                                                        @else
                                                            {{$user->position_th}} {{$user->fname_th}} {{$user->lname_th}}<br>
                                                        @endif
                                                    @elseif($locale === 'en')
                                                        @if($user->position_en !== 'Lecturer')
                                                            {{$user->position_en}} {{$user->fname_en}} {{$user->lname_en}}<br>
                                                        @else
                                                            {{$user->fname_en}} {{$user->lname_en}}, {{$doctoral_degree}} <br>
                                                        @endif
                                                    @else
                                                        @if($user->position_en !== 'Lecturer')
                                                            {{$positionMap[$user->position_en]}} {{$user->fname_en}} {{$user->lname_en}}<br>
                                                        @else
                                                            {{$user->fname_en}} {{$user->lname_en}}, {{$doctoral_degree}}<br>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </td>
                                    @if($re->status == 1)
                                        <td style="vertical-align: top;text-align: left;">
                                            <h6><label class="badge badge-success">{{trans('message.proj_req')}}</label></h6>
                                        </td>
                                    @elseif($re->status == 2)
                                        <td style="vertical-align: top;text-align: left;">
                                            <h6><label class="badge bg-warning text-dark">{{trans('message.proj_op')}}</label></h6>
                                        </td>
                                    @else
                                        <td style="vertical-align: top;text-align: left;">
                                            <h6><label class="badge bg-dark">{{trans('message.proj_closed')}}</label>
                                                <h6>
                                        </td>
                                    @endif
                                    <!-- <td></td>
                                                                                                                                        <td></td> -->
                                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    $(document).ready(function () {

        var MultiLang = {
            "sProcessing": "{{ trans('message.Processing...') }}",
            "sLengthMenu": "{{ trans('message.Showing') }} _MENU_ {{ trans('message.entries') }}",
            "sZeroRecords": "{{ trans('message.No data available in table') }}",
            "sInfo": "{{ trans('message.Showing') }} _START_ {{ trans('message.to') }} _END_ {{ trans('message.of') }} _TOTAL_ {{ trans('message.entries') }}",
            "sInfoEmpty": "{{ trans('message.Showing') }} 0 {{ trans('message.to') }} 0 {{ trans('message.of') }} 0 {{ trans('message.entries') }}",
            "sInfoFiltered": "({{ trans('message.filtered from') }} _MAX_ {{ trans('message.entries') }})",
            "sSearch": "{{ trans('message.Search') }}:",
            "oPaginate": {
                "sFirst": "{{ trans('message.First Page') }}",
                "sPrevious": "{{ trans('message.Previous Page') }}",
                "sNext": "{{ trans('message.Next Page') }}",
                "sLast": "{{ trans('message.Last Page') }}"
            }
        };

        var table1 = $('#example1').DataTable({ responsive: true, language: MultiLang });

    });

</script>
@stop