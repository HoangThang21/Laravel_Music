<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music - Nghe nhạc mới HOT nhất, tải nhạc MP3 chất lượng cao</title>
    <link rel="shortcut icon" href="../../images/webicon.png" type="image/png">
    <link href="../../inc/css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <div class="menu_side">
            <a href="/trangchu" class="home_rec">
                <img src="../../images/webicon.png" alt="" sizes="28">
                <p>Music Diablu</p>
            </a>
            <div class="playlist">
                <h4 class="<?php if (strpos($_SERVER['REQUEST_URI'], 'trangchu') != false) {
                    echo 'active';
                } ?>">
                    <a href="/trangchu"><span></span><i class="bi bi-music-note-beamed"></i>Trang chủ</a>
                </h4>
                <h4 class="<?php if (strpos($_SERVER['REQUEST_URI'], 'thuvien') != false) {
                    echo 'active';
                } ?>">
                    <a href="/thuvien"><span></span><i class="bi bi-music-note-beamed"></i>Yêu thích</a>
                </h4>
                <h4 class="<?php if (strpos($_SERVER['REQUEST_URI'], 'thuvien') != false) {
                    echo 'active';
                } ?>">
                    <a href="/thuvien"><span></span><i class="bi bi-music-note-beamed"></i>Live chat 
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                    </a>
                </h4>
                <h4 class="<?php if (strpos($_SERVER['REQUEST_URI'], 'thuvien') != false) {
                    echo 'active';
                } ?>">
                    <a href="/thuvien"><span></span><i class="bi bi-music-note-beamed"></i>Mchart</a>
                </h4>
                <h4 class="<?php if (strpos($_SERVER['REQUEST_URI'], 'thuvien') != false) {
                    echo 'active';
                } ?>">
                    <a href="/thuvien"><span></span><i class="bi bi-music-note-beamed"></i>Bảng xếp hạng</a>
                </h4>
                <h4 class="<?php if (strpos($_SERVER['REQUEST_URI'], 'thuvien') != false) {
                    echo 'active';
                } ?>">
                    <a href="/thuvien"><span></span><i class="bi bi-music-note-beamed"></i>Chủ đề & thể loại</a>
                </h4>
                
            </div>
            <div class="menu_song">
                nhac
                {{-- @foreach ($nhac as $index => $n)
                    @foreach ($album as $alb)
                        @foreach ($nghesi as $ns)
                            @if ($n->album_idnhac == $alb->id && $alb->nghesi_idalbum == $ns->id)
                                <li class="songItem">
                                    <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <img src="../../images/{{ $n->imagemusic }}" alt="" />
                                    <h5>
                                        {{ $n->tennhac }}
                                        <div class="subtitle">{{ $ns->tennghesi }}</div>
                                    </h5>
                                    <i class="bi playListPlay bi-play-circle-fill" id="{{ $n->nhaclink }}"
                                        title="{{ $n->id }}"></i>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach --}}
            </div>
        </div>

        <div class="song_side">
            {{-- <nav>
                <form id="searchForm" class="searchForm" action="/trangchu/search" method="get">
                    <div class="search">
                        <i class="bi bi-search "></i>
                        <input type="text" name="searchvv"placeholder="Nhập nhạc cần tìm" class="searchInput" />
                    </div>
                </form>


                <div class="user">
                    @if (Auth::guard('web')->check())
                        <img class="img_user" src="../../images/{{ $infouser->image }}" alt="">

                        <div class="dropdow">
                            <div class="info_user">
                                <img src="../../images/{{ $infouser->image }}" alt="">
                                <p>{{ $infouser->name }}</p>
                            </div>
                            <li><a href="/trangchu/profile">Thông tin tài khoản</a></li>
                            <li><a href="/trangchu/doimatkhau">Đổi mật khẩu</a></li>
                            <li><a href="/logout">Thoát</a></li>
                        </div>
                    @else
                        <img class="img_user" src="../../images/userlogout.png" alt="">
                        <div class="dropdo_login">
                            <li><a href="/login"><i class="align-middle me-1" data-feather="log-in"></i>Đăng nhập</a>
                            </li>
                        </div>
                    @endif


                </div>
            </nav> --}}

            <div class="content">
                {{-- content --}}
a

            </div>

        </div>
        {{-- botom --}}
        <div class="master_play">
           
        </div>
    </header>
    <script type="text/javascript" src="../../inc/js/index.js"></script>
    {{-- @if (Auth::guard('api')->check())
        <script>
            const user = '{{ $infouser->id }}';
        </script>
    @endif
    <script>
        var csrfToken = ` {{ csrf_token() }}`;
        var baidau = '{{ $baidau->nhaclink }}';
        var idbaidau = '{{ $baidau->id }}';
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

</html>
