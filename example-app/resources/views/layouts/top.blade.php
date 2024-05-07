<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music - Nghe nhạc chờ mới HOT nhất, tải nhạc MP3 chất lượng cao</title>
    <link rel="shortcut icon" href="../../images/logo_funring.png" type="image/png">
    <link href="../../inc/css/index.css" rel="stylesheet">
    <link href="../../inc/css/home.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <div class="menu_side">
            <a href="/trangchu" class="home_rec" id="home_rec">
                <img src="../../images/logo_funring.png" alt="" sizes="28">
                {{-- <p><span>Mobi</span></p> --}}
                {{-- <p><span style="color: rgb(37, 82, 231)">Mobi</span><span style="color: rgb(204, 51, 51)">Song</span>
                </p> --}}
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
                    <span></span><i class="bi bi-music-note-beamed"></i>Nhạc mới
                </a>
                <a class="itemmenu" href="/topic" id="topic">
                    <span></span><i class="bi bi-music-note-beamed"></i>Chủ đề & thể loại
                </a>

            </div>

            <div class="giothieu">
                <a href="/gioithieu" target="_blank"> <i class="bi bi-exclamation-circle"></i>Giới thiệu</a>
            </div>
            {{-- <div class="version">
                version 1.0.0
            </div> --}}
        </div>

        <div class="song_side">
            <nav>
                <div class="redict">
                    <div id="backBtn"><i class="bi bi-chevron-left"></i></div>
                    <div id="nextBtn"><i class="bi bi-chevron-right"></i></div>
                </div>
                <div id="Noidung"></div>
                <form action="/search" method="post" id="searchForm">
                    @csrf
                    <div class="searchbar">
                        <div class="searchbar-wrapper">
                            <div class="search-icon-wrapper">
                                <div class="searchicon" id="searchButton"><i class="bi bi-search"></i></div>
                            </div>
                            <div class="searchbar-center">
                                <div class="searchbar-input-spacer"></div>
                                <input type="text"name='searchbar_input' class="searchbar-input" maxlength="2048"
                                    placeholder="Tìm kiếm nhạc, nghệ sĩ" value="<?php
                                    if ($valuesreach != '') {
                                        echo $valuesreach;
                                    } else {
                                        echo '';
                                    }
                                    ?>">
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

                                            @if (Auth::guard('web')->user()->vip == 1)
                                                👑
                                            @endif

                                        </div>
                                        <div class="online">
                                            online
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if (Auth::guard('google')->check())
                                    <div class="infotopuser" onclick="toggleMenu('toggle_infouser')">
                                        <img src="../../images/{{ $ttnguoidung->image }}" alt="">
                                        <div class="nametexttop">
                                            <div class="nametop">
                                                {{ $ttnguoidung->name }}


                                                @if (Auth::guard('google')->user()->vip == 1)
                                                    👑
                                                @endif

                                            </div>
                                            <div class="online">
                                                online
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="login" onclick="toggleMenuFlex('login-form')"><i
                                            class="bi bi-person-circle"></i>Đăng nhập</div>
                                @endif
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
                                            @if (Auth::guard('web')->check())
                                                @if (Auth::guard('web')->user()->vip == 1)
                                                    👑
                                                @endif
                                            @endif


                                        </div>
                                    </div>
                                </div>
                                <div class="menu-qcao">
                                    <div class="qcao1">
                                        <div class="name-qcao">MobiSong <span>Vip</span></div>
                                        <div class="title-qcao">Chỉ với 3.000 đ/tuần</div>
                                        <div class="subtitle-qcao">Nghe nhạc với chất lượng cao nhất, Toàn bộ đặc quyền
                                            Vip với kho nhạc</div>
                                        <a href="/gioithieu" target="_blank">Xem chi tiết</a>
                                        <form action="{{ route('stripe') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="price" value="20000">
                                            <input type="hidden" name="product_name" value="Tuần">
                                            <input type="hidden" name="email"
                                                value="{{ Auth::guard('web')->user()->email }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="musicvip" style="cursor: pointer">Nạp vip
                                                👑</button>
                                        </form>

                                    </div>
                                    <div class="qcao2">
                                        <div class="name-qcao">MobiSong <span>Vip</span></div>
                                        <div class="title-qcao">Chỉ với 10.000 đ/tháng</div>
                                        <div class="subtitle-qcao">Nghe nhạc với chất lượng cao nhất, Toàn bộ đặc quyền
                                            Vip với kho nhạc</div>
                                        <a href="/gioithieu" target="_blank">Xem chi tiết</a>
                                        <form action="{{ route('stripe') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="price" value="60000">
                                            <input type="hidden" name="email"
                                                value="{{ Auth::guard('web')->user()->email }}">
                                            <input type="hidden" name="product_name" value="Tháng">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="musicvip" style="cursor: pointer">Nạp vip
                                                👑</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="menu-toggle_infouser">
                                    <a href="/thongtin-user"><i class="bi bi-file-earmark-person"></i>Thông tin</a>
                                    {{-- @if ($ttnguoidung->quyen == 4)
                                        <a href="/infonghesi"><i class="bi bi-file-earmark-music-fill"></i>Nghệ sĩ</a>
                                    @endif --}}

                                    <a href="/logout"><i class="bi bi-box-arrow-right"></i>Đăng xuất</a>
                                </div>
                            </div>
                        @endif
                        @if (Auth::guard('google')->check())
                            <div class="toggle_infouser">
                                <div class="infouser-header">
                                    <img src="../../images/{{ $ttnguoidung->image }}" alt="">
                                    <div class="nametext">
                                        <div class="name">
                                            {{ $ttnguoidung->name }}
                                            
                                                @if (Auth::guard('google')->user()->vip == 1)
                                                    👑
                                                @endif
                                        
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
                                        <form action="{{ route('stripe') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="price" value="20000">
                                            <input type="hidden" name="product_name" value="Tuần">
                                            <input type="hidden" name="email"
                                                value="{{ Auth::guard('google')->user()->email }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="musicvip" style="cursor: pointer">Nạp vip
                                                👑</button>
                                        </form>
                                    </div>
                                    <div class="qcao2">
                                        <div class="name-qcao">MobiSong <span>Vip</span></div>
                                        <div class="title-qcao">Chỉ với 10.000 đ/tháng</div>
                                        <div class="subtitle-qcao">Nghe nhạc với chất lượng cao nhất, Toàn bộ đặc quyền
                                            Vip với kho nhạc</div>
                                        <a href="/gioithieu">Xem chi tiết</a>

                                        <form action="{{ route('stripe') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="price" value="60000">
                                            <input type="hidden" name="email"
                                                value="{{ Auth::guard('google')->user()->email }}">
                                            <input type="hidden" name="product_name" value="Tháng">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="musicvip" style="cursor: pointer">Nạp vip
                                                👑</button>
                                        </form>


                                    </div>
                                </div>
                                <div class="menu-toggle_infouser">
                                    <a href="/thongtin-user"><i class="bi bi-file-earmark-person"></i>Thông tin</a>
                                    <a href="/logout"><i class="bi bi-box-arrow-right"></i>Đăng xuất</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </nav>
            <div class="contentsong">

                <div id="song_side">
