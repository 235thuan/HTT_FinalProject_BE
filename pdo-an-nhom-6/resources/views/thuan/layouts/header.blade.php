<div class="home1">
    <div class="home11">
        <div class="home111">
            <a href="{{ route('home') }}">
                <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="44">
                    </span>
            </a>

        </div>

    </div>
    <div class="home12">
        <div class="home121">
            <input class="home1211" type="text" placeholder="Tìm kiếm...">
        </div>
    </div>
    <div class="home13">
        <div class="home131">
            <div class="home1311">Khoa</div>
            <div class="home1311">Chuyên ngành</div>
            <div class="home1311">Lớp học</div>
            <div class="home1311">Môn học</div>
        </div>
        <div class="home132">
            <div class="home1321">
                <img src="{{ Vite::asset('resources/image/thuan/homeIcon1.png') }}"></img>
            </div>
            <div class="home1321">
                <img src="{{ Vite::asset('resources/image/thuan/homeIcon2.png') }}"></img>
            </div>
            <div class="home1321">
                <img src="{{ Vite::asset('resources/image/thuan/homeIcon3.png') }}"></img>
            </div>
        </div>
        <div class="home133">
            @include('thuan.layouts.home-dropdown')
        </div>
    </div>
</div>
