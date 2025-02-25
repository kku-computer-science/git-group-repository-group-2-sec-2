@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('message.journal_detail') }}</title>

    <!-- Google Translate Widget -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'th,zh-CN',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- ซ่อน Google Translate Widget UI -->
    <style>
        #google_translate_element {
            display: none;
        }
        .goog-te-banner-frame {
            display: none !important;
        }
        .goog-te-gadget {
            display: none !important;
        }
        body {
            top: 0 !important;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- ซ่อน Google Translate Widget -->
<div id="google_translate_element"></div>

<div class="container">
    <div class="card" style="padding: 16px;">
        <div class="card-body">
            <h4 class="card-title">{{ trans('message.journal_detail') }}</h4>
            <p class="card-description">{{ trans('message.journal_detail_info') }}</p>

            <div class="row mt-3">
                <p class="card-text col-sm-3"><b>{{ trans('message.title') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_name }}</p>
            </div>

            <!-- บทคัดย่อ -->
            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.abstract') }}</b></p>
                <p class="card-text col-sm-9" id="abstract_text">
                    {{ $paper->abstract }}
                </p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.keyword') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->keyword }}</p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.publication') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->publication }}</p>
            </div>

            <div class="row mt-2">
                <p class="card-text col-sm-3"><b>{{ trans('message.source_title') }}</b></p>
                <p class="card-text col-sm-9">{{ $paper->paper_sourcetitle }}</p>
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

<!-- Script แปลเฉพาะบทคัดย่อ -->
<script>
function translateAbstract(lang) {
    let text = document.getElementById('abstract_text').innerText;
    let url = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${lang}&dt=t&q=` + encodeURIComponent(text);

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let translatedText = data[0].map(item => item[0]).join('');
            document.getElementById('abstract_text').innerText = translatedText;
        })
        .catch(error => console.error('Error:', error));
}
</script>

<!-- Script เรียกแปลอัตโนมัติตามภาษา -->
@php 
$locale = app()->getLocale();
@endphp

<script>
document.addEventListener("DOMContentLoaded", function() {
    @if ($locale == 'th')
        translateAbstract('th');
    @elseif ($locale == 'zh')
        translateAbstract('zh-CN');
    @endif
});
</script>

<!-- Script แปลทั้งหน้า -->
<script>
function translatePage(lang) {
    let googleFrame = document.querySelector(".goog-te-menu-frame");
    if (!googleFrame) {
        alert("Google Translate is not loaded yet. Please wait.");
        return;
    }

    let translateButton = googleFrame.contentWindow.document.querySelector(`a[lang='${lang}']`);
    if (translateButton) {
        translateButton.click();
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
