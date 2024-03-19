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
                <a href="#" id="trangchu" class=" active<?php if (strpos($_SERVER['REQUEST_URI'], 'trangchu') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Trang chủ
                </a>
                <a href="#" id="yeuthich" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'yeuthich') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Yêu thích
                </a>
                <a href="#" id="livechat" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'livechat') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Live chat
                    <div class="imgchat">
                        <img src="../../images/webicon.png" alt="">
                        <img src="../../images/img1710036980-6.png" alt="" class="nthimg2">
                        <img src="../../images/img1709375679-100.png" alt="" class="nthimg3">
                    </div>

                </a>
                <a href="#" id="Mchart" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'Mchart') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Mchart
                </a>
                <a href="#" id="ranksong" class="ranksong <?php if (strpos($_SERVER['REQUEST_URI'], 'rank') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Bảng xếp hạng
                </a>
                <a href="#" id="topic" class=" <?php if (strpos($_SERVER['REQUEST_URI'], 'topic') != false) {
                    echo 'active';
                } ?>">
                    <span></span><i class="bi bi-music-note-beamed"></i>Chủ đề & thể loại
                </a>

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

        <div class="song_side" id="song_side">
            @if ($content)
                {!! $content !!}
            @endif

        </div>
        {{-- botom --}}
        <div class="master_play ">
            <div class="wave active2">
                <div class="wave1"></div>
                <div class="wave1"></div>
                <div class="wave1"></div>
            </div>
            <img src="../../images/img1710036980-6.png" alt="" class="IgMuSc" />
            <div class="info_ns">
                <h5 class="NameBai">a<br />

                </h5>
                <div class="subtitle NameNS">b</div>
            </div>
            <div class="icon">
                <i class="bi bi-skip-start-fill" id="back"></i>

                <i class="bi bi-play-fill" id="masterPlay"></i>
                <i class="bi bi-skip-end-fill" id="next"></i>
            </div>
            <span id="currentStart">0:00</span>
            <div class="bar">
                <input type="range" name="range" id="seek" class="range" />
                <div class="bar2" id="bar2"></div>
                <div class="dot" id="dot_music"></div>
            </div>
            <span id="currentEnd">0:00</span>
        </div>
        <div class="thongbao">
            <div class="headerthongbao">
                <div class="tieude"></div>
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
    </header>
    <script type="text/javascript" src="../../inc/js/index.js"></script>
    <script type="text/javascript" src="../../inc/js/redict.js"></script>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

</body>

</html>
