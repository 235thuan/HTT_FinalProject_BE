@extends('thuan.layouts.app')


@section('css')


    <link rel="stylesheet" href="{{ asset('css/vuong/main.css') }}">


<link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet"

/>

@endsection
<style>

</style>
@section('content')
    <main class="main-content">
        <aside class="filter-bar">
            <h3>Gợi ý tìm kiếm</h3>
            <div class="search-suggestions">
                <img src="/images/vuong/education.jpg" alt="Suggestion 1"/>
                <img src="/images/vuong/education.jpg" alt="Suggestion 2"/>
                <img src="/images/vuong/education.jpg" alt="Suggestion 3"/>
                <img src="/images/vuong/education.jpg" alt="Suggestion 4"/>
            </div>
            <h3>Chuyên ngành</h3>
            <div class="categories">
                <button>CNTT</button>
                <button>ĐTVT</button>
                <button>TCKT</button>
                <button>KT</button>
                <button>NN</button>
            </div>
            <h3>Lịch sử tìm kiếm</h3>
            <ul class="history">
                <li>
                    <img src="/images/vuong/education.jpg" alt="Lecture Notes"/>
                    <span>Lecture notes</span>
                </li>
                <li>
                    <img src="/images/vuong/education.jpg" alt="Online Quizzes"/>
                    <span>Online quizzes</span>
                </li>
                <li>
                    <img src="/images/vuong/education.jpg" alt="Research Papers"/>
                    <span>Research papers</span>
                </li>
            </ul>

            <div class="filter-more">
                <div class="card card-more">
                    <i class="fa-solid fa-ellipsis more"></i>
                    <img src="/images/vuong/education.jpg" alt="History Lessons"/>
                    <div class="card-description">
                        <h4>History Lessons</h4>
                        <p>Explore ancient civilizations.</p>
                    </div>
                    <div class="price-likes">
                        <i class="fa-solid fa-dollar-sign price"> Free</i>
                        <i class="fas fa-heart heart"> 24</i>
                    </div>
                </div>
                <div class="card card-more">
                    <i class="fa-solid fa-ellipsis more"></i>
                    <img src="/images/vuong/education.jpg" alt="History Lessons"/>
                    <div class="card-description">
                        <h4>History Lessons</h4>
                        <p>Explore ancient civilizations.</p>
                    </div>
                    <div class="price-likes">
                        <i class="fa-solid fa-dollar-sign price"> Free</i>
                        <i class="fas fa-heart heart"> 24</i>
                    </div>
                </div>
            </div>
        </aside>

        <section class="content">
            <div class="card">
                <i class="fa-solid fa-ellipsis more"></i>
                <img src="/images/vuong/education.jpg" alt="History Lessons"/>
                <div class="card-description">
                    <h4>History Lessons</h4>
                    <p>Explore ancient civilizations.</p>
                </div>
                <div class="price-likes">
                    <i class="fa-solid fa-dollar-sign price"> Free</i>
                    <i class="fas fa-heart heart"> 24</i>
                </div>
            </div>
            <div class="card">
                <i class="fa-solid fa-ellipsis more"></i>
                <img src="/images/vuong/education.jpg" alt="Science Lessons"/>
                <div class="card-description">
                    <h4>Science Lessons</h4>
                    <p>Discover the wonders of science.</p>
                </div>
                <div class="price-likes">
                    <i class="fa-solid fa-dollar-sign price"> 10</i>
                    <i class="fas fa-heart heart"> 15</i>
                </div>
            </div>
            <div class="card">
                <i class="fa-solid fa-ellipsis more"></i>
                <img src="/images/vuong/education.jpg" alt="Science Lessons"/>
                <div class="card-description">
                    <h4>Science Lessons</h4>
                    <p>Discover the wonders of science.</p>
                </div>
                <div class="price-likes">
                    <i class="fa-solid fa-dollar-sign price"> 10</i>
                    <i class="fas fa-heart heart"> 15</i>
                </div>
            </div>
            <div class="card">
                <i class="fa-solid fa-ellipsis more"></i>
                <img src="/images/vuong/education.jpg" alt="Science Lessons"/>
                <div class="card-description">
                    <h4>Science Lessons</h4>
                    <p>Discover the wonders of science.</p>
                </div>
                <div class="price-likes">
                    <i class="fa-solid fa-dollar-sign price"> 10</i>
                    <i class="fas fa-heart heart"> 15</i>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script src="{{ asset('js/vuong/script.js') }}"></script>
@endsection
