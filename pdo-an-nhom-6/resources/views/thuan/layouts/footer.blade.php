<style>
    .home300 {
        display: flex;
        justify-content: space-between;
        gap: 60px;
        padding: 40px 0;
    }

    /* Left side - home31 */
    .home31 {
        flex: 0 0 25%; /* Takes 25% of the width */
        max-width: 300px;
    }

    .home311 {
        font-size: 24px;
        font-weight: bold;
        background: linear-gradient(to right, #f9a825, #ff8f00);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }

    .home312 {
        color: #666;
        margin-bottom: 20px;
    }

    .home313 {
        display: flex;
        gap: 15px;
    }

    /* Social media icons */
    .home3131 {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    /* Right side - home32 */
    .home32 {
        flex: 0 0 70%; /* Takes 70% of the width */
        display: flex;
        justify-content: flex-end; /* Aligns columns to the right */
        gap: 40px;
    }

    /* Individual columns in home32 */
    .home321 {
        flex: 0 0 auto; /* Don't grow or shrink */
        min-width: 160px; /* Minimum width for each column */
    }

    .home3211 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        position: relative;
    }

    .home3211::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(to right, #f9a825, #ff8f00);
    }

    .home3212 {
        color: #666;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .home3212:hover {
        color: #f9a825;
        padding-left: 5px;
    }

    /* Hover effects */
    .home3131:hover {
        transform: translateY(-3px);
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    /* Responsive design */
    @media (max-width: 992px) {
        .home300 {
            flex-direction: column;
            gap: 40px;
        }

        .home31, .home32 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .home32 {
            justify-content: space-between;
        }
    }

    @media (max-width: 768px) {
        .home32 {
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }

        .home321 {
            flex: 0 0 45%;
            text-align: center;
        }

        .home31 {
            text-align: center;
        }

        .home313 {
            justify-content: center;
        }

        .home3211::after {
            left: 50%;
            transform: translateX(-50%);
        }
    }

    @media (max-width: 480px) {
        .home321 {
            flex: 0 0 100%;
        }
    }
</style>
<div class="home3">
    <div class="home30">
        <div class="home300">
            <!-- Left side -->
            <div class="home31">
                <div class="home311"><h3> ĐỒ ÁN NHÓM 6 </h3></div>
                <div class="home312">Kết nối với chúng tôi</div>
                <div class="home313">
                    <div class="home3131"><img src="{{ Vite::asset('resources/image/thuan/homeLinkedi.png') }}"></div>
                    <div class="home3131"><img src="{{ Vite::asset('resources/image/thuan/homeFacebook.png') }}"></div>
                    <div class="home3131"><img src="{{ Vite::asset('resources/image/thuan/homeYoutube.png') }}"></div>
                </div>
            </div>

            <!-- Right side - 3 columns -->
            <div class="home32">
                <div class="home321">
                    <div class="home3211">Tổ chức</div>
                    <div class="home3212">Về chúng tôi</div>
                    <div class="home3212">Tuyển dụng</div>
                </div>
                <div class="home321">
                    <div class="home3211">Diễn đàn</div>
                    <div class="home3212">Giáo dục</div>
                    <div class="home3212">Quảng cáo</div>
                    <div class="home3212">Đối tac</div>
                    <div class="home3212">Thảo luận</div>
                </div>
                <div class="home321">
                    <div class="home3211">Trung tâm hỗ trợ</div>
                    <div class="home3212">Hỗ trợ khách hàng</div>
                    <div class="home3212">Ứng dụng di động</div>
                </div>
            </div>
        </div>
    </div>
</div>
