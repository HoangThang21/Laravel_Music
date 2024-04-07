</div>
<div class="rightsong">
    <div class="menu-rightsong">
        <div class="top-menu-rightsong">Top Lượt nghe <i class="bi bi-caret-right-fill"></i></div>
        <div class="menu-scroll-rightsong">
            @foreach ($Nhactopluotnghe as $ntluotnghe)
                <div class="list-menu-rightsong">
                    <div class="left-list-menu-rightsong">
                        <img src="../../images/{{ $ntluotnghe->imagemusic }}" alt="">
                        <div class="name-rightsong">{{ $ntluotnghe->tennhac }}</div>
                    </div>
                    <i class="bi bi-caret-right-fill"></i>
                </div>
            @endforeach

        </div>
    </div>
    <div class="menu-rightsong">
        <div class="top-menu-rightsong">Nhạc Premium <span><i class="bi bi-chevron-compact-right"></i></span></div>
        <div class="menu-scroll-rightsong">
            @foreach ($Nhactopvip as $ntluotnghe)
                <div class="list-menu-rightsong">
                    <div class="left-list-menu-rightsong">
                        <img src="../../images/{{ $ntluotnghe->imagemusic }}" alt="">
                        <div class="name-rightsong">{{ $ntluotnghe->tennhac }}</div>
                        <span>premium</span>
                    </div>
                    <i class="bi bi-caret-right-fill"></i>
                </div>
            @endforeach
        </div>
    </div>

</div>
</div>


</div>

{{-- botom --}}
<div class="master_play ">
    <div class="left-master-play">
        <div class="wave active2">
            <div class="wave1"></div>
            <div class="wave1"></div>
            <div class="wave1"></div>
        </div>
        <img src="../../images/img1710036980-6.png" alt="" class="IgMuSc" />
        <div class="info_ns">
            <h5 class="NameBai">memories
            </h5>
            <div class="subtitle NameNS">maroon 5</div>
        </div>
    </div>
    <div class="mid-master-play">
        <div class="icon">
            <i class="bi bi-skip-backward-fill" id="backward"></i>
            <i class="bi bi-skip-start-fill" id="back"></i>
            <i class="bi bi-play-fill" id="masterPlay"></i>
            <i class="bi bi-skip-end-fill" id="next"></i>
            <i class="bi bi-skip-forward-fill" id="nextforward"></i>
        </div>
        <span id="currentStart">0:00</span>
        <div class="bar">
            <input type="range" name="range" id="seek" class="range" />
            <div class="bar2" id="bar2"></div>
            <div class="dot" id="dot_music"></div>
        </div>
        <span id="currentEnd">0:00</span>

    </div>
    <div class="right-master-play">
        <div class="right-setup">
            <div class="le-right-setup">
                <i class="bi bi-volume-up" id="vol-up"></i>
                <div class="vol">
                    <input type="range" name="range-seek-vol" id="seek-vol" class="range-vol" max="100"
                        min="0" />
                    <div class="bar-vol" id="bar-vol"></div>
                    <div class="dot" id="dot-music"></div>
                </div>
            </div>
            <i class="bi bi-shuffle" id="random"></i>
            <i class="bi bi-arrow-repeat" id="all"></i>
            <div class="menu-list-right-setup">
                <i class="bi bi-music-note-list" id="list-memu" title="Danh sách phát"></i>
                <div class="right-menu-setup">
                    <h3>Danh sách phát</h3>
                    <div class="menu-right-setup-list">
                        <div class="info-media-bottom">
                            <div class="img-media">
                                <img src="../../images/3.png" alt="">
                                <div class="load-nghe-bottom"><i class="bi bi-caret-right-fill"></i></div>
                            </div>
                            <div class="name-media">
                                <div class="name-music-bottom">maroon 5 - memories</div>
                                <a href="" class="name-tacgia">aa</a>
                            </div>
                            <i style="cursor: pointer;" class="bi bi-play-fill"></i>
                            <div class="option">
                                <div class="dot-3"><i class="bi bi-three-dots"></i></div>
                                <div class="menu-right-media bottom-listmmusic">
                                    <div title="Tải nhạc" class="download" data-downloadmusic="holo.mp3"><i
                                            class="bi bi-download"></i>Download
                                    </div>
                                    <div title="Cài nhạc chờ" class="nhaccho" data-cho="8217381" data-gia="3000"><i
                                            class="bi bi-phone-vibrate"></i>Cài nhạc chờ
                                    </div>
                                    <div class="sendchat"><i class="bi bi-chat-dots"></i>Share chat</div>
                                    <div class="Xoa"><i class="bi bi-trash"></i>Xóa</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="thongbao" style="background-color: #1cd912;">
    <div class="headerthongbao">
        <div class="tieude"></div>
        <i class="bi bi-x-lg" onclick="toggleMenu('thongbao')"></i>
    </div>
</div>
<div class="loi <?php if ($loi != '') {
    echo 'active';
} else {
    if ($loingoai != '') {
        echo 'active';
    } else {
        echo '';
    }
} ?> " style="display:
    <?php if ($loi != '') {
        echo 'flex';
    } else {
        if ($loingoai != '') {
            echo 'flex';
        } else {
            echo 'none';
        }
    } ?>
    ">
    <div class="headerthongbao">
        <div class="tieude">
            <?php if ($loi != '') {
                echo $loi;
            } else {
                echo $loi;
            } ?>
            <?php if ($loingoai != '') {
                echo $loingoai;
            } else {
                echo $loingoai;
            } ?>
        </div>

        <i class="bi bi-x-lg" onclick="toggleMenu('loi')"></i>
    </div>
</div>
<div class="form-login-regis">
    <form class="form_container_register" id="form_container_register" action="/register" method="post">
        @csrf
        @method('post')
        <div class="x-tat" onclick="toggleMenuFlex('form_container_register')"><i class="bi bi-x"></i></div>
        <div class="logo_container"><img src="../../images/logo_funring.png" alt=""></div>
        <div class="title_container">
            <p class="title">Đăng ký</p>
            <span class="subtitle">Chào mừng bạn đến với Funring, đăng nhập để trải nghiệm tốt</span>
        </div>
        <div class="input_container">
            <label class="input_label">Họ tên</label>
            <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" class="icon">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2ZM9 7C9 5.34315 10.3431 4 12 4C13.6569 4 15 5.34315 15 7C15 8.65685 13.6569 10 12 10C10.3431 10 9 8.65685 9 7Z"
                    fill="#2D3648" />
                <path
                    d="M8 14C6.67392 14 5.40215 14.5268 4.46447 15.4645C3.52678 16.4021 3 17.6739 3 19V21C3 21.5523 3.44772 22 4 22C4.55228 22 5 21.5523 5 21V19C5 18.2043 5.31607 17.4413 5.87868 16.8787C6.44129 16.3161 7.20435 16 8 16H16C16.7956 16 17.5587 16.3161 18.1213 16.8787C18.6839 17.4413 19 18.2044 19 19V21C19 21.5523 19.4477 22 20 22C20.5523 22 21 21.5523 21 21V19C21 17.6739 20.4732 16.4021 19.5355 15.4645C18.5979 14.5268 17.3261 14 16 14H8Z"
                    fill="#2D3648" />
            </svg>
            <input placeholder="Họ tên" title="Họ tên" name="input_name" type="text" class="input_field">
        </div>

        <div class="input_container">
            <label class="input_label">Email hoặc Số điện thoại</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24"
                xmlns="http://www.w3.org/2000/svg" class="icon">
                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                    d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5"></path>
                <path stroke-linejoin="round" stroke-width="1.5" stroke="#141B34"
                    d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z">
                </path>
            </svg>
            <input placeholder="Email hoặc Số điện thoại" title="Email hoặc Số điện thoại" name="input_email_sdt"
                type="text" class="input_field" autocomplete="off">
        </div>
        <div class="input_container">
            <label class="input_label">Mật khẩu</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24"
                xmlns="http://www.w3.org/2000/svg" class="icon">
                <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                    d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22">
                </path>
                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                    d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
                <path fill="#141B34"
                    d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z">
                </path>
            </svg>
            <input placeholder="Mật khẩu" title="Nhập mật khẩu" name="input_password" type="password"
                class="input_field" autocomplete="new-password">
        </div>
        <div class="input_container">
            <label class="input_label">Xác nhận mật khẩu</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24"
                xmlns="http://www.w3.org/2000/svg" class="icon">
                <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                    d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22">
                </path>
                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                    d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
                <path fill="#141B34"
                    d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z">
                </path>
            </svg>
            <input placeholder="Xác nhận Mật khẩu" title="Nhập mật khẩu để xác nhận" name="input_password_xac_nhan"
                type="password" class="input_field" autocomplete="new-password">
        </div>
        <div class="input_container">
            <label class="input_label">Khi bạn đăng ký bạn đã đồng ý mọi giao dịch mua bán theo
                <a href="">điều kiện sử dụng và chính sách của MobiSong</a></label>
        </div>
        <button title="Đăng ký" type="submit" class="regis-in_btn">
            <span>Đăng ký</span>
        </button>
    </form>
    <div class="login-form" style="display:
    <?php if ($loi != '') {
        echo 'flex';
    } else {
        if ($login == 1) {
            echo 'flex';
        } else {
            echo 'none';
        }
    } ?>">
        <form class="form_container"action="/login" method="post">
            @csrf
            <div class="x-tat" onclick="toggleMenuFlex('login-form')"><i class="bi bi-x"></i></div>
            <div class="logo_container"><img src="../../images/logo_funring.png" alt=""></div>
            <div class="title_container">
                <p class="title">Đăng nhập</p>
                <span class="subtitle">Chào mừng bạn đến với Funring, đăng nhập để trải nghiệm tốt</span>
            </div>
            <div class="input_container">
                <label class="input_label">Email hoặc Số điện thoại</label>
                <svg fill="none" viewBox="0 0 24 24" height="24" width="24"
                    xmlns="http://www.w3.org/2000/svg" class="icon">
                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                        d="M7 8.5L9.94202 10.2394C11.6572 11.2535 12.3428 11.2535 14.058 10.2394L17 8.5"></path>
                    <path stroke-linejoin="round" stroke-width="1.5" stroke="#141B34"
                        d="M2.01577 13.4756C2.08114 16.5412 2.11383 18.0739 3.24496 19.2094C4.37608 20.3448 5.95033 20.3843 9.09883 20.4634C11.0393 20.5122 12.9607 20.5122 14.9012 20.4634C18.0497 20.3843 19.6239 20.3448 20.7551 19.2094C21.8862 18.0739 21.9189 16.5412 21.9842 13.4756C22.0053 12.4899 22.0053 11.5101 21.9842 10.5244C21.9189 7.45886 21.8862 5.92609 20.7551 4.79066C19.6239 3.65523 18.0497 3.61568 14.9012 3.53657C12.9607 3.48781 11.0393 3.48781 9.09882 3.53656C5.95033 3.61566 4.37608 3.65521 3.24495 4.79065C2.11382 5.92608 2.08114 7.45885 2.01576 10.5244C1.99474 11.5101 1.99475 12.4899 2.01577 13.4756Z">
                    </path>
                </svg>
                <input placeholder="Nhập Email hoặc Số điện thoại" title="Nhập Email hoặc Số điện thoại"
                    name="input-name" type="text" class="input_field" autocomplete="off">
            </div>
            <div class="input_container">
                <label class="input_label">Mật khẩu</label>
                <svg fill="none" viewBox="0 0 24 24" height="24" width="24"
                    xmlns="http://www.w3.org/2000/svg" class="icon">
                    <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                        d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22">
                    </path>
                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34"
                        d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
                    <path fill="#141B34"
                        d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82ZM20.6242 15.6956L21.4196 16.4767L22.5804 15.2945L21.785 14.5134L20.6242 15.6956ZM15.4211 18.82L17.8078 16.4767L16.647 15.2944L14.2603 17.6377L15.4211 18.82ZM17.8078 16.4767L18.6032 15.6956L17.4424 14.5134L16.647 15.2945L17.8078 16.4767ZM16.647 16.4767L18.2379 18.0387L19.3987 16.8565L17.8078 15.2945L16.647 16.4767ZM21.785 14.5134C21.4266 14.1616 21.0998 13.8383 20.7993 13.6131C20.4791 13.3732 20.096 13.1716 19.6137 13.1716V14.8284C19.6145 14.8284 19.619 14.8273 19.6395 14.8357C19.6663 14.8466 19.7183 14.8735 19.806 14.9391C19.9969 15.0822 20.2326 15.3112 20.6242 15.6956L21.785 14.5134ZM18.6032 15.6956C18.9948 15.3112 19.2305 15.0822 19.4215 14.9391C19.5091 14.8735 19.5611 14.8466 19.5879 14.8357C19.6084 14.8273 19.6129 14.8284 19.6137 14.8284V13.1716C19.1314 13.1716 18.7483 13.3732 18.4281 13.6131C18.1276 13.8383 17.8008 14.1616 17.4424 14.5134L18.6032 15.6956Z">
                    </path>
                </svg>
                <input placeholder="Mật khẩu" title="Mật khẩu" name="input-password" type="password"
                    class="input_field" autocomplete="current-password">
            </div>
            <div class="input_container in_con_ifo">
                <a href="#">Quên mật khẩu?</a>
                <p class="create-account">Tạo tài khoản</p>
            </div>
            <button type="submit" title="Sign In" class="sign-in_btn">
                <span>Đăng nhập</span>
            </button>

            <div class="separator">
                <hr class="line">
                <span>Hoặc</span>
                <hr class="line">
            </div>

        </form>
        <button title="Sign In" type="submit" class="sign-in_ggl">
            <a href="/logingg"><img src="../../images/google.png" alt="">Đăng nhập với Google</a>
        </button>
    </div>
</div>

</header>
<script type="text/javascript" src="../../inc/js/index.js"></script>
<script>
    var csrfToken = ` {{ csrf_token() }}`;
    var activemenu = '{{ $activerity }}';
    var rank = {!! $rank !!};
    var rightsong_var = {{ $rightsong }};
</script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script type="text/javascript" src="../../inc/js/redict.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

</body>

</html>
