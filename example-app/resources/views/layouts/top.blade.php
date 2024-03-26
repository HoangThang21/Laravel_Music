<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music - Nghe nhạc chờ mới HOT nhất, tải nhạc MP3 chất lượng cao</title>
    <link rel="shortcut icon" href="../../images/logomobifone.png" type="image/png">
    <link href="../../inc/css/index.css" rel="stylesheet">
    <link href="../../inc/css/home.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <div class="menu_side">
            <a href="/trangchu" class="home_rec" id="home_rec">
                <img src="../../images/logomobifone.png" alt="" sizes="28">
                <p><span style="color: rgb(37, 82, 231)">Mobi</span><span style="color: rgb(204, 51, 51)">Song</span>
                </p>
            </a>
            <div class="menu">
                <p>Menu</p>
            </div>

            <div class="playlist">
                <a class="itemmenu" href="/trangchu" id="trangchu">
                    <span></span><i class="bi bi-music-note-beamed"></i>Trang chủ
                </a>
                <a class="itemmenu" href="/yeuthich" id="yeuthich">
                    <span></span><i class="bi bi-music-note-beamed"></i>Yêu thích
                </a>
                <a class="itemmenu" href="/livechat" id="livechat">
                    <span></span><i class="bi bi-music-note-beamed"></i>Live chat
                    <div class="imgchat">
                        <img src="../../images/webicon.png" alt="">
                        <img src="../../images/img1710036980-6.png" alt="" class="nthimg2">
                        <img src="../../images/img1709375679-100.png" alt="" class="nthimg3">
                    </div>

                </a>
                <a class="itemmenu" href="/Mchart" id="Mchart">
                    <span></span><i class="bi bi-music-note-beamed"></i>Mchart
                </a>
                <a class="itemmenu" href="/ranksong" id="ranksong">
                    <span></span><i class="bi bi-music-note-beamed"></i>Bảng xếp hạng
                </a>
                <a class="itemmenu" href="/topic" id="topic">
                    <span></span><i class="bi bi-music-note-beamed"></i>Chủ đề & thể loại
                </a>

            </div>
            <div class="menu_song">
                nhac

            </div>
            <div class="giothieu">
                <a href="/trangchu" target="_blank"> <i class="bi bi-exclamation-circle"></i>Giới thiệu</a>
            </div>
            {{-- <div class="version">
                version 1.0.0
            </div> --}}
        </div>

        <div class="song_side">
            <nav>

                <form action="/search?=" method="post" id="searchForm">
                    @csrf
                    <div class="searchbar">
                        <div class="searchbar-wrapper">
                            <div class="search-icon-wrapper">
                                <div class="searchicon" id="searchButton"><i class="bi bi-search"></i></div>
                            </div>
                            <div class="searchbar-center">
                                <div class="searchbar-input-spacer"></div>
                                <input type="text"name='searchbar_input' class="searchbar-input" maxlength="2048"
                                    placeholder="Tìm kiếm nhạc, nghệ sĩ">
                            </div>
                            <div class="searchbar-left">
                                <div class="delete-icon-wrapper">
                                    <i class="bi bi-x-lg"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="infouser">
                    <div class="end">
                        <div class="matshead">
                            @if (Auth::guard('web')->check())
                                <div class="infotopuser" onclick="toggleMenu('toggle_infouser')">
                                    <img src="../../images/{{ $ttnguoidung->image }}" alt="">
                                    <div class="nametexttop">
                                        <div class="nametop">
                                            {{ $ttnguoidung->name }}
                                        </div>
                                        <div class="online">
                                            online
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="login" onclick="toggleMenuFlex('form_container')"><i
                                        class="bi bi-person-circle"></i>Đăng nhập</div>
                            @endif

                            <div class="thongbaotop">
                                <i class="bi bi-bell"></i>
                            </div>
                        </div>
                        @if (Auth::guard('web')->check())
                            <div class="toggle_infouser">
                                <div class="infouser-header">
                                    <img src="../../images/{{ $ttnguoidung->image }}" alt="">
                                    <div class="nametext">
                                        <div class="name">
                                            {{ $ttnguoidung->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="menu-qcao">
                                    <div class="qcao1">
                                        <div class="name-qcao">MobiSong <span>Vip</span></div>
                                        <div class="title-qcao">Chỉ với 3.000 đ/tuần</div>
                                        <div class="subtitle-qcao">Nghe nhạc với chất lượng cao nhất, Toàn bộ đặc quyền
                                            Vip với kho nhạc</div>
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                    <div class="qcao2">
                                        <div class="name-qcao">MobiSong <span>Vip</span></div>
                                        <div class="title-qcao">Chỉ với 10.000 đ/tháng</div>
                                        <div class="subtitle-qcao">Nghe nhạc với chất lượng cao nhất, Toàn bộ đặc quyền
                                            Vip với kho nhạc</div>
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                                <div class="menu-toggle_infouser">
                                    <a href="/logout"><i class="bi bi-box-arrow-right"></i>Đăng xuất</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </nav>
            <div class="contentsong">

                <div id="song_side">
