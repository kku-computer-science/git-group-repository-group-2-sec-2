@extends('layouts.layout')
<style>
    .name {
        font-size: 20px;
    }
</style>
@section('content')
<div class="container card-4 mt-5">
    <div class="card">
        @foreach ($resgd as $rg)
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <img src="{{ asset('img/'.$rg->group_image) }}" alt="...">
                    <h1 class="card-text-1"> {{ trans('message.laboratory_supervisor') }} </h1>
                    <h2 class="card-text-2">
                        @foreach ($rg->user as $r)
                        @if($r->hasRole('teacher'))
                            @if(app()->getLocale() == 'zh')
                                @php
                                    $positionMap = [
                                        'Assoc. Prof. Dr.' => '副教授 博士',
                                        'Prof. Dr.'        => '教授 博士',
                                        'Asst. Prof. Dr.'  => '助理教授 博士',
                                        'Asst. Prof.'      => '助理教授',
                                        'Lecturer'         => '讲师',
                                    ];
                                @endphp
                                {{ isset($positionMap[$r->position_en]) ? $positionMap[$r->position_en] : $r->position_en }}
                                {{ $r->fname_en }} {{ $r->lname_en }}
                                <br>
                            @elseif(app()->getLocale() == 'en' and $r->academic_ranks_en == 'Lecturer' and $r->doctoral_degree == 'Ph.D.')
                                {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}, Ph.D.
                                <br>
                            @elseif(app()->getLocale() == 'en' and $r->academic_ranks_en == 'Lecturer')
                                {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}
                                <br>
                            @elseif(app()->getLocale() == 'en' and $r->doctoral_degree == 'Ph.D.')
                                {{ str_replace('Dr.', ' ', $r->{'position_'.app()->getLocale()}) }} {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}, Ph.D.
                                <br>
                            @else                            
                                {{ $r->{'position_'.app()->getLocale()} }} {{ $r->{'fname_'.app()->getLocale()} }} {{ $r->{'lname_'.app()->getLocale()} }}
                                <br>
                            @endif
                        @endif
                        @endforeach
                    </h2>
                    <h1 class="card-text-1"> {{ trans('message.student') }}</h1>
                    <h2 class="card-text-2">
                        @foreach ($rg->user as $user)
                        @if($user->hasRole('student'))
                            {{ $user->{'position_'.app()->getLocale()} }} {{ $user->{'fname_'.app()->getLocale()} }} {{ $user->{'lname_'.app()->getLocale()} }}
                            <br>
                        @endif
                        @endforeach
                    </h2>
                </div>
            </div>
            <div class="col-md-8">
    <div class="card-body">
        <h5 class="card-title">
            {{ app()->getLocale() == 'zh' ? $rg->group_name_en : $rg->{'group_name_'.app()->getLocale()} }}
        </h5>

        @php 
        $locale = app()->getLocale();
        @endphp

        <h3 class="card-text" id="group_detail_text">
            @if ($locale == 'zh')
                {{ $rg->{'group_detail_th'} ?? '' }}
            @elseif ($locale == 'en')
                {{ $rg->group_detail_en ?? '' }}
            @else
                {{ $rg->{'group_detail_'.$locale} ?? '' }}
            @endif
        </h3>

        @if ($locale == 'zh')
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            translateAbstract('zh-CN');
        });
        </script>
        @endif

    </div>
</div>

</div>

            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Script แปลเฉพาะ group_detail -->
<script>
function translateAbstract(lang) {
    let text = document.getElementById('group_detail_text').innerText;
    let url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${lang}&dt=t&q=` + encodeURIComponent(text);

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let translatedText = data[0].map(item => item[0]).join('');
            document.getElementById('group_detail_text').innerText = translatedText;
        })
        .catch(error => console.error('Error:', error));
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
$(document).ready(function() {
    $(".moreBox").slice(0, 1).show();
    if ($(".blogBox:hidden").length != 0) {
        $("#loadMore").show();
    }
    $("#loadMore").on('click', function(e) {
        e.preventDefault();
        $(".moreBox:hidden").slice(0, 1).slideDown();
        if ($(".moreBox:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
    });
});
</script>

@stop
