@extends('thuan.layouts.app')


@section('css')

    <link rel="stylesheet" href="{{ asset('css/vuong/main.css') }}">


    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet"

    />

@endsection
<style>
    .main-content {
        display: grid;
        grid-template-columns: 6fr 4fr; /* 60% - 40% split */
        gap: 20px;
        padding: 20px;
    }

    /* Column A Styles */
    .columnA {
        display: flex;
        gap: 20px;
        flex-direction: column;
    }

    .filter-bar {
        width: 100%;
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .filter-bar h3 {
        color: #333;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .search-suggestions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-suggestions img {
        width: 100%;
        height: 80px;
        object-fit: contain;
        border-radius: 8px;
        transition: transform 0.3s;
    }

    .search-suggestions img:hover {
        transform: scale(1.05);
    }

    .categories {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }

    .categories button {
        padding: 8px 15px;
        border: none;
        border-radius: 20px;
        background: #f0f2f5;
        color: #333;
        cursor: pointer;
        transition: all 0.3s;
    }

    .categories button:hover {
        background: #1a73e8;
        color: white;
    }

    .history {
        list-style: none;
        padding: 0;
    }

    .history li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        cursor: pointer;
    }

    .history img {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: contain;
    }

    /* Content Section */
    .content {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    /* Column B Styles */
    .columnB {
        /*background: white;*/
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .filter-more {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Card Styles */
    .card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        width: 100%;
        height: 150px;
        object-fit: contain;
    }

    .card-description {
        padding: 15px;
    }

    .card-description h4 {
        margin: 0 0 8px 0;
        color: #333;
    }

    .card-description p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }

    .price-likes {
        display: flex;
        justify-content: space-between;
        padding: 10px 15px;
        border-top: 1px solid #eee;
    }

    .more {
        position: absolute;
        right: 10px;
        top: 10px;
        color: white;
        cursor: pointer;
    }

    .heart {
        color: #ff4d4d;
    }

    .price {
        color: #28a745;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .main-content {
            grid-template-columns: 1fr;
        }

        .columnB {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .columnA {
            flex-direction: column;
        }

        .filter-bar {
            width: 100%;
        }
    }
</style>
<style>
    .main-content {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Two equal columns */
        gap: 20px;
        padding: 20px;

    }

    /* Column A */
    .columnA {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Filter Bar */
    .filter-bar {
        background-color: #e7f1ff;
        padding: 20px;
        border-radius: 8px;
        height: fit-content;
    }

    .search-suggestions {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 images per row */
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-suggestions img {
        width: 100%;
        height: 80px;
        object-fit: contain;
        border-radius: 8px;
    }

    .categories {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 15px 0;
    }

    .categories button {
        padding: 8px 16px;
        border: none;
        background-color: #fff;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
    }

    .history {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .history li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }

    .history img {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        object-fit: contain;
    }

    /*!* Content Section *!*/
    .content {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 cards per row */
        gap: 20px;
    }

    .card {
        background-color: #e7f1ff;
        border-radius: 10px;
        padding: 15px;
        position: relative;
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: contain;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    /* Column B */
    .columnB {
        height: fit-content;

    }

    .filter-more {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .filter-more .row {
        margin-bottom: 20px;
    }

    .card-more {
        background-color: #e7f1ff;
        border-radius: 10px;
        overflow: hidden;
    }

    /* Rest of your existing card styles... */

    @media (max-width: 1200px) {
        .content {
            grid-template-columns: repeat(1, 1fr); /* 1 card per row on smaller screens */
        }
    }

    @media (max-width: 768px) {
        .main-content {
            grid-template-columns: 1fr; /* Stack columns on mobile */
        }

        .search-suggestions {
            grid-template-columns: repeat(2, 1fr); /* 2 images per row on mobile */
        }
    }
</style>
<style>
    .categories .category-btn {
        margin: 0.5rem 0.5rem 0 0;
        padding: 0.5rem 1rem;
        border: none;
        background-color: #fff;
        color: #000;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .categories .category-btn:hover,
    .categories .category-btn.active {
        background-color: #1a73e8;
        color: white;
    }
</style>
<style>
    .featured-row, .expandable-content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .card-more {
        text-decoration: none;
        color: inherit;
        transition: transform 0.3s ease;
    }

    .card-more:hover {
        transform: translateY(-5px);
    }
</style>
<style>
    .expandable-content {
        background-color: whitesmoke;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .expand-button {
        cursor: pointer;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .expand-icon {
        transition: transform 0.3s ease;
    }

    .expand-icon.rotated {
        transform: rotate(180deg);
    }
</style>
<style>
    .expandable-content {
        background-color: whitesmoke;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .expandable-content .row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .card-more {
        width: 100%;
        height: 100%;
    }
</style>

@section('content')
    <div style="display: flex">
        <main class="main-content row "
              style="padding:0px; ">
            <div class=" row" style="padding:0px">
                <div class="columnA " style="width:700px">
                    <aside class="filter-bar ">

                        <h3>Gợi ý tìm kiếm</h3>
                        <div class="search-suggestions ">
                            @forelse ($randomSubjects as $subject)
                                <a href="{{ route('client.lophoc', ['id_monhoc' => $subject->id_monhoc]) }}"
                                   class="subject-link">
                                    <img src="{{ $subject->image_url }}"
                                         alt="{{ $subject->ten_monhoc }}"
                                         onerror="this.src='/storage/thuan/default.png'"
                                    />
                                </a>
                            @empty
                                {{-- Fallback if no subjects found --}}
                                @for ($i = 0; $i < 4; $i++)
                                    <img src="/images/vuong/education.jpg" alt="Default subject image"/>
                                @endfor
                            @endforelse
                        </div>

                        <h3>Chuyên ngành</h3>
                        <div class="categories">
                            @forelse ($chuyenNganhs as $chuyenNganh)
                                <button
                                    data-id="{{ $chuyenNganh->id_chuyennganh }}"
                                    class="category-btn"
                                >
                                    {{ $chuyenNganh->ten_chuyennganh }}
                                </button>
                            @empty
                                <button>Không có dữ liệu</button>
                            @endforelse
                        </div>


                        <h3>Lịch sử tìm kiếm</h3>
                        <ul class="history">
                            <li>
                                <img src="/images/vuong/education.jpg" alt="Lecture Notes"/>
                                <span>Ghi chú</span>
                            </li>
                            <li>
                                <img src="/images/vuong/education.jpg" alt="Online Quizzes"/>
                                <span>Trắc nghiệm trực tuyến</span>
                            </li>
                            <li>
                                <img src="/images/vuong/education.jpg" alt="Research Papers"/>
                                <span>Tài liệu nghiên cứu</span>
                            </li>
                        </ul>
                    </aside>
                    <section class="content " style="max-height: 700px;gap: 55px">

                        <div class="card" style="max-width: 305px">
                            <i class="fa-solid fa-ellipsis more"></i>
                            <img src="/images/vuong/education.jpg" alt="Ghi chú"/>
                            <div class="card-description">
                                <h4>Ghi Chú</h4>
                                <p>Khám phá thế giới cổ đại.</p>
                            </div>

                        </div>

                        <div class="card" style="max-width: 300px">
                            <i class="fa-solid fa-ellipsis more"></i>
                            <img src="/images/vuong/education.jpg" alt="Ghi chú"/>
                            <div class="card-description">
                                <h4>Ghi Chú</h4>
                                <p>Tìm hiểu về khoa học tự nhiên.</p>
                            </div>

                        </div>

                        <!-- Trắc nghiệm cards -->
                        <div class="card" style="max-width: 300px">
                            <i class="fa-solid fa-ellipsis more"></i>
                            <img src="/images/vuong/education.jpg" alt="Trắc nghiệm"/>
                            <div class="card-description">
                                <h4>Trắc Nghiệm</h4>
                                <p>Kiểm tra kiến thức lịch sử.</p>
                            </div>

                        </div>

                        <div class="card" style="max-width: 300px">
                            <i class="fa-solid fa-ellipsis more"></i>
                            <img src="/images/vuong/education.jpg" alt="Trắc nghiệm"/>
                            <div class="card-description">
                                <h4>Trắc Nghiệm</h4>
                                <p>Bài tập khoa học tự nhiên.</p>
                            </div>

                        </div>


                    </section>
                </div>

                <div class="columnB  " style="width: 500px">
                    <aside class="filter-more " style="margin-top:0px">
                        <!-- First Row: Show first 2 random monhoc -->
                        <div id="default-views" class="row featured-row"
                             style="background-color: whitesmoke; border-radius: 10px; padding: 20px;">
                            @foreach($randomMonhoc->take(2) as $monhoc)
                                <a href="{{ route('client.lophoc', ['id_monhoc' => $monhoc->id_monhoc]) }}"
                                   class="card card-more">
                                    <i class="fa-solid fa-ellipsis more"></i>
                                    <img src="{{ $monhoc->image_url }}"
                                         alt="{{ $monhoc->ten_monhoc }}"
                                         onerror="this.src='/storage/thuan/default.png'"
                                    />
                                    <div class="card-description">
                                        <h4>{{ $monhoc->ten_monhoc }}</h4>
                                    </div>

                                </a>
                            @endforeach


                        </div>
                        <div id="filtered-views" style="display: none;">
                            <div class="row featured-row"
                                 style="background-color: whitesmoke; border-radius: 10px; padding: 20px;">
                                @foreach($featuredMonhoc as $monhoc)
                                    <a href="{{ route('client.lophoc', ['id_monhoc' => $monhoc->id_monhoc]) }}"
                                       class="card card-more">
                                        <i class="fa-solid fa-ellipsis more"></i>
                                        <img src="{{ $monhoc->image_url }}"
                                             alt="{{ $monhoc->ten_monhoc }}"
                                             onerror="this.src='/storage/thuan/default.png'"
                                        />
                                        <div class="card-description">
                                            <h4>{{ $monhoc->ten_monhoc }}</h4>
                                        </div>

                                    </a>
                                @endforeach


                            </div>
                            <div
                                style="background-color: whitesmoke;width: 100%; border-radius: 10px;align-items: center;align-content: center;justify-items: center;justify-content: center">
                                <div class="expand-button" style="margin-top:0px" onclick="toggleExpand()">
                                    <i class="fas fa-chevron-down expand-icon"></i>
                                    <span>Xem thêm</span>
                                </div>
                            </div>
                        </div>


                        <!-- Second Row: Show remaining 2 random monhoc -->
                        <div id="expandable-contents" class="expandable-content" style="display: none;">

                            @foreach($remainingMonhoc as $monhoc)
                                <a href="{{ route('client.lophoc', ['id_monhoc' => $monhoc->id_monhoc]) }}"
                                   class="card card-more">
                                    <i class="fa-solid fa-ellipsis more"></i>
                                    <img src="{{ $monhoc->image_url }}"
                                         alt="{{ $monhoc->ten_monhoc }}"
                                         onerror="this.src='/storage/thuan/default.png'"
                                    />
                                    <div class="card-description">
                                        <h4>{{ $monhoc->ten_monhoc }}</h4>
                                    </div>

                                </a>
                            @endforeach


                        </div>
                    </aside>
                </div>
            </div>


        </main>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/vuong/script.js') }}"></script>
    <script>
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const chuyenNganhId = this.dataset.id;

                try {

                    const response = await fetch(`/client/monhoc-by-chuyennganh/${chuyenNganhId}`);
                    const data = await response.json();

                    if (data.status) {
                        // First, explicitly hide default view
                        const defaultView = document.getElementById('default-views');
                        defaultView.style.display = 'none';

                        // Then, explicitly show filtered view
                        const filteredView = document.getElementById('filtered-views');
                        filteredView.style.display = 'block';

                        // Reset expandable content to hidden state
                        const expandableContent = document.getElementById('expandable-contents');
                        expandableContent.style.display = 'none';

                        // Update filtered content
                        document.getElementById('filtered-content').innerHTML = data.featured.map(monhoc => `
                    <a href="/client/lophoc/${monhoc.id_monhoc}" class="card card-more">
                        <i class="fa-solid fa-ellipsis more"></i>
                        <img src="${monhoc.image_url}"
                             alt="${monhoc.ten_monhoc}"
                             onerror="this.src='/storage/thuan/default.png'"
                        />
                        <div class="card-description">
                            <h4>${monhoc.ten_monhoc}</h4>
                        </div>

                    </a>
                `).join('');

                        // Update remaining content
                        document.getElementById('remaining-content').innerHTML = data.remaining.map(monhoc => `
                    <a href="/client/lophoc/${monhoc.id_monhoc}" class="card card-more">
                        <i class="fa-solid fa-ellipsis more"></i>
                        <img src="${monhoc.image_url}"
                             alt="${monhoc.ten_monhoc}"
                             onerror="this.src='/storage/thuan/default.png'"
                        />
                        <div class="card-description">
                            <h4>${monhoc.ten_monhoc}</h4>
                        </div>

                    </a>
                `).join('');

                        // Log to verify
                        console.log('Views updated:', {
                            defaultDisplay: defaultView.style.display,
                            filteredDisplay: filteredView.style.display
                        });
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        function updateMonHocDisplay(monhocList) {
            // Update first row with top 2 monhoc
            const firstRow = document.querySelector('.featured-row');
            firstRow.innerHTML = monhocList.slice(0, 2).map(monhoc => `
        <a href="/client/lophoc?id_monhoc=${monhoc.id_monhoc}" class="card card-more">
            <i class="fa-solid fa-ellipsis more"></i>
            <img src="${monhoc.image_url}"
                 alt="${monhoc.ten_monhoc}"
                 onerror="this.src='/storage/thuan/default.png'"
            />
            <div class="card-description">
                <h4>${monhoc.ten_monhoc}</h4>
                <p>${'No description'}</p>
            </div>

        </a>
    `).join('');

            // Update expandable content with remaining monhoc
            const expandableContent = document.querySelector('.expandable-content');
            expandableContent.innerHTML = monhocList.slice(2).map(monhoc => `
        <a href="/client/lophoc?id_monhoc=${monhoc.id_monhoc}" class="card card-more">
            <i class="fa-solid fa-ellipsis more"></i>
            <img src="${monhoc.image_url}"
                 alt="${monhoc.ten_monhoc}"
                 onerror="this.src='/storage/thuan/default.png'"
            />
            <div class="card-description">
                <h4>${monhoc.ten_monhoc}</h4>
                <p>${'No description'}</p>
            </div>

        </a>
    `).join('');
        }

        function toggleExpand() {
            const expandableContent = document.getElementById('expandable-contents');
            const expandIcon = document.querySelector('.expand-icon');
            const expandText = expandIcon.nextElementSibling;

            if (expandableContent.style.display === 'none') {
                expandableContent.style.display = 'grid';
                expandIcon.classList.add('rotated');
                expandText.textContent = 'Thu gọn';
            } else {
                expandableContent.style.display = 'none';
                expandIcon.classList.remove('rotated');
                expandText.textContent = 'Xem thêm';
            }
        }
    </script>
@endsection
