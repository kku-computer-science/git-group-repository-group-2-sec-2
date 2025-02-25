@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.journal_detail') }}</h4>
            <p class="card-description">{{ trans('message.journal_detail_info') }}
            <div class="row mt-3">
                <p class="card-text col-sm-3"><b>{{ trans('message.title') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_name }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.abstract') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->abstract }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.keyword') }}</b></p>
                <p class="card-text col-sm-9">
                    {{ $paper->keyword }}
                </p>


                <!-- <p class="card-text col-sm-9">{{ $paper->keyword }}</p> -->
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.journal_type') }}</b></p>
                @php
    $locale = app()->getLocale();
    $paperTypeMap = [];
    if ($locale == 'th') {
        $paperTypeMap = [
            'Journal' => 'วารสาร',
            'Conference Proceeding' => 'บทความการประชุม',
            'Book Series' => 'ชุดหนังสือ',
            'Book' => 'หนังสือ',
        ];
    } elseif ($locale == 'zh') {
        $paperTypeMap = [
            'Journal' => '期刊',
            'Conference Proceeding' => '会议论文集',
            'Book Series' => '丛书',
            'Book' => '书籍',
        ];
    }
@endphp

<p class="card-text col-sm-9">
    {{ isset($paperTypeMap[$paper->paper_type]) ? $paperTypeMap[$paper->paper_type] : $paper->paper_type }}
</p>

            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.document_type') }}</b></p>
                @php
    $locale = app()->getLocale();
    $paperSubtypeMap = [];
    if ($locale == 'th') {
        $paperSubtypeMap = [
            'Article'           => 'บทความ',
            'Conference Paper'  => 'บทความประชุม',
            'Editorial'         => 'บทความบรรณาธิการ',
            'Erratum'           => 'ข้อแก้ไข',
            'Review'            => 'บทความวิจารณ์',
            'Book Chapter'      => 'บทในหนังสือ',
        ];
    } elseif ($locale == 'zh') {
        $paperSubtypeMap = [
            'Article'           => '文章',
            'Conference Paper'  => '会议论文',
            'Editorial'         => '社论',
            'Erratum'           => '勘误',
            'Review'            => '综述',
            'Book Chapter'      => '书章',
        ];
    }
@endphp

<p class="card-text col-sm-9">
    {{ isset($paperSubtypeMap[$paper->paper_subtype]) ? $paperSubtypeMap[$paper->paper_subtype] : $paper->paper_subtype }}
</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.publication') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->publication }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.author') }}</b></p>
                <p class="card-text col-sm-9">

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 1)
                    <b>{{ trans('message.first_author') }} :</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 1)
                    <b>{{ trans('message.first_author') }} :</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 2)
                    <b>{{ trans('message.co_author') }} :</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 2)
                    <b>{{ trans('message.co_author') }} :</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach

                    @foreach($paper->author as $teacher)
                    @if($teacher->pivot->author_type == 3)
                    <b>{{ trans('message.corresponding_author') }} :</b> {{ $teacher->author_fname}} {{ $teacher->author_lname}} <br>
                    @endif
                    @endforeach
                    @foreach($paper->teacher as $teacher)
                    @if($teacher->pivot->author_type == 3)
                    <b>{{ trans('message.corresponding_author') }} :</b> {{ $teacher->fname_en}} {{ $teacher->lname_en}} <br>
                    @endif 
                    @endforeach
                    



                </p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.source_title') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_sourcetitle }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.publication_year') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_yearpub }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.volume') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_volume }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.issue') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_issue}}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.page_number') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_page }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>DOI</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_doi }}</p>
            </div>
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>URL</b></p>
                <a href="{{ $paper->paper_url }}" target="_blank" class="card-text col-sm-9">{{ $paper->paper_url }}</a>
            </div>

            <a class="btn btn-primary mt-5" href="{{ route('papers.index') }}"> {{ trans('message.back') }}</a>
        </div>
    </div>

</div>
@endsection