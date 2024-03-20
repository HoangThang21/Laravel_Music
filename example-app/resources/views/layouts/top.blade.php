<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music - Nghe nhạc mới HOT nhất, tải nhạc MP3 chất lượng cao</title>
    <link rel="shortcut icon" href="../../images/webicon.png" type="image/png">
    <link href="../../inc/css/index.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <div class="menu_side">
            <a href="/trangchu" class="home_rec" id="home_rec">
                <img src="../../images/webicon.png" alt="" sizes="28">
                <p><span style="color: rgb(37, 82, 231)">Mobi</span><span style="color: rgb(204, 51, 51)">Song</span>
                </p>
            </a>

            <div class="playlist">
                <div id="trangchu" class=" active<?php if (strpos($_SERVER['REQUEST_URI'], 'trangchu') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Trang chủ
                </div>
                <div id="yeuthich" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'yeuthich') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Yêu thích
                </div>
                <div id="livechat" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'livechat') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Live chat
                    <div class="imgchat">
                        <img src="../../images/webicon.png" alt="">
                        <img src="../../images/img1710036980-6.png" alt="" class="nthimg2">
                        <img src="../../images/img1709375679-100.png" alt="" class="nthimg3">
                    </div>

                </div>
                <div id="Mchart" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'Mchart') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Mchart
                </div>
                <div id="ranksong" class="ranksong <?php if (strpos($_SERVER['REQUEST_URI'], 'rank') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Bảng xếp hạng
                </div>
                <div id="topic" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'topic') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Chủ đề & thể loại
                </div>

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
            <div class="">
                <a href="/trangchu" target="_blank"> <i class="bi bi-exclamation-circle"></i>Giới thiệu</a>
            </div>
        </div>

        <div class="song_side">
            <nav>
                
                <form action="/search?=" method="post" id="searchForm">
                    @csrf
                    <div class="searchbar">
                        <div class="searchbar-wrapper">
                            <div class="searchbar-center">
                                <div class="searchbar-input-spacer"></div>
                                <input type="text"name='searchbar_input' class="searchbar-input" maxlength="2048">
                            </div>
                            <div class="searchbar-left">
                                <div class="delete-icon-wrapper">
                                    <i class="bi bi-x-lg"></i>
                                </div>|
                                <div class="search-icon-wrapper">
                                    <div class="searchicon" id="searchButton"><i class="bi bi-search"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </nav>
            <div id="song_side">
                @if ($content)
                    {!! $content !!}
                @endif
            </div>


        </div>
