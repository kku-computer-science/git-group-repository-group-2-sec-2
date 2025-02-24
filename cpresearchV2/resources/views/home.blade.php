@extends('layouts.layout')

@section('content')
<style>
    .count {
        background-color: #f5f5f5;
        padding: 20px 0;
        border-radius: 5px;
    }

    .count-title {
        font-size: 40px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .count-text {
        font-size: 15px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .fa-2x {
        margin: 0 auto;
        float: none;
        display: table;
        color: #4ad1e5;
    }

    /* ซ่อน Google Toolbar ที่อยู่ด้านบน */
    .goog-te-banner-frame.skiptranslate {
        display: none !important;
    }

    body {
        top: 0px !important;
    }

    /* ซ่อน Google Translate Dropdown */
    .goog-te-gadget {
        font-size: 0px;
    }

</style>

<div class="container home">
    <div class="container d-sm-flex justify-content-center mt-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('img/Banner1.png')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('img/Banner2.png')}}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Google Translate Widget -->
    <!-- <div id="google_translate_element"></div> -->

    <!-- ปุ่มเปลี่ยนภาษาเป็นภาษาจีน -->
    <!-- <div class="mt-3 text-center">
        <button class="btn btn-primary" onclick="changeLanguage('zh-CN')">切换到中文</button>
    </div> -->

    <div class="container mixpaper pb-10 mt-3">
        <h3>{{ trans('message.publications') }}</h3>
        @foreach($papers as $n => $pe)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{$n}}" aria-expanded="true" aria-controls="collapseOne">
                        @if (!$loop->last)
                        {{$n}}
                        @else
                        {{trans('message.before')}} {{$n}}
                        @endif
                    </button>
                </h2>
                <div id="collapse{{$n}}" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @foreach($pe as $n => $p)
                        <div class="row mt-2 mb-3 border-bottom">
                            <div id="number" class="col-sm-1">
                                <h6>[{{$n+1}}]</h6>
                            </div>
                            <div id="paper2" class="col-sm-11">
                                <p class="hidden">
                                    <b>{{$p['paper_name']}}</b> (
                                    <link>{{$p['author']}}</link>), {{$p['paper_sourcetitle']}}, {{$p['paper_volume']}},
                                    {{$p['paper_yearpub']}}.
                                    <a href="{{$p['paper_url']}} " target="_blank">[url]</a>
                                    <a href="https://doi.org/{{$p['paper_doi']}}" target="_blank">[doi]</a>
                                    <button style="padding: 0;" class="btn btn-link open_modal"
                                        value="{{$p['id']}}">[อ้างอิง]</button>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        @endforeach
    </div>
</div>

<!-- JavaScript เปิดใช้งาน Google Translate -->
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en', // กำหนดให้เว็บเริ่มต้นเป็นภาษาอังกฤษ
            includedLanguages: 'zh-CN', // กำหนดให้รองรับเฉพาะภาษาจีน (Simplified Chinese)
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }

    function changeLanguage(lang) {
    var checkWidget = setInterval(function () {
        var select = document.querySelector(".goog-te-combo");
        // console.log(document.body.innerHTML);
        if (select) {
            clearInterval(checkWidget); // หยุดการตรวจสอบเมื่อโหลดเสร็จ
            select.value = lang;
            select.dispatchEvent(new Event("change"));
            console.log("✅ เปลี่ยนภาษาเป็น " + lang);
        } else {
            console.warn("⏳ กำลังรอ Google Translate Widget...");
        }
    }, 10000); // ตรวจสอบทุกๆ 0.5 วินาที
}


</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

@endsection
