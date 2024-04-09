@include('layouts.top')
<div class="bodyhome">
    <div class="header-search">
        <div class="left-header-search">
            <div class="noidung">Kết quả tìm kiếm</div>
        </div>
        <div class="right-header-search">
            <div class="all active">Tất cả</div>
            <div class="song">Bài Hát</div>
            <div class="album">Album</div>
            <div class="nghesi">Nghệ sĩ</div>
        </div>
    </div>
    <div class="all-search"style="display:block">
        <div class="table-music">
            <div class="toptable">
                <div class="discover">
                    
                    <p>Bài hát</p>
                    <i class="bi bi-caret-right-fill"></i>
                </div>
                <div class="song-search">Tất cả <i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="menu-media">
                @foreach ($Nhactop10 as $nhactop10)
                    @php
                        $number = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT); // Định dạng số với hai chữ số và thêm số 0 ở đầu nếu cần
                    @endphp
                    <div class="media">
                        <div class="media-left">
                            <span>{{ $number }}</span>
                            <div class="info-media">
                                <div class="img-media">
                                    <img src="../../images/{{ $nhactop10->imagemusic }}" alt="">
                                    <div class="load-nghe"><i class="bi bi-caret-right-fill"></i></div>
                                </div>
                                <div class="name-media">
                                    <div class="name-music" data-nhacredict="{{ $nhactop10->id }}">
                                        {{ $nhactop10->tennhac }}
                                    </div>
                                    <div class="nametacgia">
                                        @foreach ($album as $alb)
                                            @if ($alb->id == $nhactop10->album_idnhac)
                                                @foreach ($nghesi as $ns)
                                                    @if ($ns->id == $alb->nghesi_idalbum)
                                                        <a href="/nghe-si/{{ $ns->id }}"
                                                            class="name-tacgia">{{ $ns->tennghesi }}</a>
                                                        <div class="info-name-tacgia-top">
                                                            <div class="top-info-tacgia">
                                                                <div class="topleft-tacgia">
                                                                    @php
                                                                        $userimg = DB::table('user')
                                                                            ->where('id', $ns->id_nghesi_user)
                                                                            ->pluck('image')
                                                                            ->first();
                                                                    @endphp
                                                                    <img src="../../images/{{ $userimg }}"
                                                                        alt="">
                                                                    <div class="iftacgia">
                                                                        <a href="/nghe-si/{{ $ns->id }}"
                                                                            class="nametacgia-info">{{ $ns->tennghesi }}</a>
                                                                        @php
                                                                            $inputString = $ns->quantam;
                                                                            $parts = explode('-', $inputString);
                                                                            $check = 0;
                                                                        @endphp
                                                                        @foreach ($parts as $index => $part)
                                                                            @if ($part)
                                                                                @php
                                                                                    $check += 1;
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        @if ($check >= 0)
                                                                            <div class="luotquantam-info">
                                                                                {{ $check }}
                                                                                quan tâm</div>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                {{-- -------------------------------- --}}
                                                                @if (Auth::guard('web')->check())
                                                                    @php
                                                                        $isInterested =
                                                                            strpos($ns->quantam, $ttnguoidung->id) !==
                                                                            false;
                                                                    @endphp
                                                                    <div class="topright-tacgia"
                                                                        data-quantam="{{ $ns->id }}"
                                                                        @if ($isInterested) {{ 'style=background:blue;color:#fff' }}
                                                                        @else
                                                                            {{ '' }} @endif>
                                                                        <i class="bi bi-person-plus-fill"></i>
                                                                        @if ($isInterested)
                                                                            {{ 'Đã quan tâm' }}
                                                                        @else
                                                                            {{ 'Quan tâm' }}
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    @if (Auth::guard('google')->check())
                                                                        @php
                                                                            $isInterested =
                                                                                strpos(
                                                                                    $ns->quantam,
                                                                                    $ttnguoidung->id,
                                                                                ) !== false;
                                                                        @endphp
                                                                        <div class="topright-tacgia"
                                                                            data-quantam="{{ $ns->id }}"
                                                                            @if ($isInterested) {{ 'style=background:blue;color:#fff' }}
                                                            @else
                                                                {{ '' }} @endif>
                                                                            <i class="bi bi-person-plus-fill"></i>
                                                                            @if ($isInterested)
                                                                                {{ 'Đã quan tâm' }}
                                                                            @else
                                                                                {{ 'Quan tâm' }}
                                                                            @endif
                                                                        </div>
                                                                    @else
                                                                        <div class="topright-tacgia"
                                                                            data-quantam="{{ $ns->id }}"><i
                                                                                class="bi bi-person-plus-fill"></i>
                                                                            Quan tâm</div>
                                                                    @endif
                                                                @endif

                                                            </div>
                                                            <div class="bottom-info-tacgia">
                                                                <p>Mới</p>
                                                                <div class="bottom-menu">
                                                                    @php
                                                                        $items = DB::table('album')
                                                                            ->where('nghesi_idalbum', $ns->id)
                                                                            ->take(3)
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($items as $item)
                                                                        <div class="list-album-tacgia">
                                                                            <div class="item-album-tacgia">
                                                                                <img src="../../images/{{ $item->hinhalbum }}"
                                                                                    alt="">
                                                                                <a
                                                                                    href="/album-nghesi/{{ $item->id }}">{{ $item->tenalbum }}</a>
                                                                                <p>{{ $item->namphathanh }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media-right">
                            @php
                                $filePath = public_path('music/' . $nhactop10->nhaclink);
                                $getID3 = new getID3();
                                $fileInfo = $getID3->analyze($filePath);
                                if (isset($fileInfo['playtime_string'])) {
                                    $duration = $fileInfo['playtime_string'];
                                }
                            @endphp
                            <div class="time-curent-media"><span>{{ $duration }}</span><i
                                    class="loadmusic-dot bi bi-caret-right-fill"></i></div>
                            @if (Auth::guard('web')->check())
                                @php
                                    $inputString = $ttnguoidung->thuvien;
                                    $parts = explode('-', $inputString);
                                    $check = 0;
                                @endphp
                                @foreach ($parts as $index => $part)
                                    @php
                                        $currentNumber = (int) $part;
                                    @endphp
                                    @if ($currentNumber == $nhactop10->id)
                                        @php

                                            $check = 1;
                                        @endphp
                                        <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                            title="Thêm vào yêu thích"><i class="bi bi-heart-fill"></i></div>
                                    @endif
                                @endforeach
                                @if ($check == 0)
                                    <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                        title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                @endif
                            @else
                                @if (Auth::guard('google')->check())
                                    @php
                                        $inputString = $ttnguoidung->thuvien;
                                        $parts = explode('-', $inputString);
                                        $check = 0;
                                    @endphp
                                    @foreach ($parts as $index => $part)
                                        @php
                                            $currentNumber = (int) $part;
                                        @endphp
                                        @if ($currentNumber == $nhactop10->id)
                                            @php

                                                $check = 1;
                                            @endphp
                                            <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                                title="Thêm vào yêu thích"><i class="bi bi-heart-fill"></i></div>
                                        @endif
                                    @endforeach
                                    @if ($check == 0)
                                        <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                            title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                    @endif
                                @else
                                    <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                        title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                @endif
                            @endif
                            <div class="option">
                                <div class="dot-3"><i class="bi bi-three-dots"></i></div>
                                <div class="menu-right-media ">
                                    <div class="download" data-downloadmusic="{{ $nhactop10->nhaclink }}"><i
                                            class="bi bi-download"></i>Download</div>
                                    <div class="nhaccho" data-cho="{{ $nhactop10->maNhac }}"
                                        data-gia="{{ $nhactop10->gia }}"><i class="bi bi-phone-vibrate"></i>Cài nhạc
                                        chờ
                                    </div>
                                    <div class="sendchat"><i class="bi bi-chat-dots"></i>Share chat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="contener">
            <div class="Top-Contener">
                <h3>Album</h3>
                <div class="album-search">Tất cả <i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="list-menu-contenter">
                @foreach ($Chill as $item)
                    <div class="body-Contener">
                        <div class="item-body-content" data-album="{{ $item->id }}">
                            <img src="../../images/{{ $item->hinhalbum }}" alt="">
                            <div class="hover-item-body-content">
                                <i class="bi bi-caret-right-fill"></i>
                            </div>
                        </div>
                        <div class="title-body-content">{{ $item->tenalbum }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="contener">
            <div class="Top-Contener">
                <h3>Nghệ sĩ </h3>
                <div class="nghesi-search">Tất cả <i class="bi bi-chevron-right"></i></div>
            </div>
            <div class="list-menu-contenter_ns">
                @foreach ($Nghesitop20 as $nstop20)
                    <div class="body-Contener_ns">
                        <img class="img-ns" src="../../images/1.jpg" alt="">
                        <div class="name-ns">{{ $nstop20->tennghesi }}</div>
                        @php
                            $inputString = $nstop20->quantam;
                            $parts = explode('-', $inputString);
                            $check = 0;
                        @endphp
                        @foreach ($parts as $index => $part)
                            @if ($part)
                                @php
                                    $check += 1;
                                @endphp
                            @endif
                        @endforeach
                        @if ($check >= 0)
                            <div class="luotthich">{{ $check }} thích</div>
                        @endif
                        {{-- ---------------------------------------------------- --}}
                        @if (Auth::guard('web')->check())
                            @php
                                $isInterested = strpos($nstop20->quantam, $ttnguoidung->id) !== false;
                            @endphp
                            <div class="quantam" data-quantam="{{ $nstop20->id }}"
                                @if ($isInterested) {{ 'style=background:blue;color:#fff' }}
                                @else
                                    {{ '' }} @endif>
                                <i class="bi bi-person-plus-fill"></i>
                                @if ($isInterested)
                                    {{ 'Đã quan tâm' }}
                                @else
                                    {{ 'Quan tâm' }}
                                @endif
                            </div>
                        @else
                            @if (Auth::guard('google')->check())
                                @php
                                    $isInterested = strpos($nstop20->quantam, $ttnguoidung->id . 'gg') !== false;
                                @endphp
                                <div class="quantam"
                                    data-quantam="{{ $nstop20->id }}"@if ($isInterested) {{ `style="background: blue; color:#fff"` }}
                                    @else
                                        {{ '' }} @endif>
                                    <i class="bi bi-person-plus-fill"></i>
                                    @if ($isInterested)
                                        {{ 'Đã quan tâm' }}
                                    @else
                                        {{ 'Quan tâm' }}
                                    @endif
                                </div>
                            @else
                                <div class="quantam" data-quantam="{{ $nstop20->id }}"><i
                                        class="bi bi-person-plus-fill"></i>
                                    Quan tâm</div>
                            @endif
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="song-search-click" style="display:none">
        <div class="table-music">
            <div class="toptable">
                <div class="discover">
                  
                    <p>Bài hát</p>
                    <i class="bi bi-caret-right-fill"></i>
                </div>
            </div>
            <div class="menu-media">
                @foreach ($nhacsearch as $nhactop10)
                    @php
                        $number = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT); // Định dạng số với hai chữ số và thêm số 0 ở đầu nếu cần
                    @endphp
                    <div class="media">
                        <div class="media-left">
                            <span>{{ $number }}</span>
                            <div class="info-media">
                                <div class="img-media">
                                    <img src="../../images/{{ $nhactop10->imagemusic }}" alt="">
                                    <div class="load-nghe"><i class="bi bi-caret-right-fill"></i></div>
                                </div>
                                <div class="name-media">
                                    <div class="name-music" data-nhacredict="{{ $nhactop10->id }}">
                                        {{ $nhactop10->tennhac }}
                                    </div>
                                    <div class="nametacgia">
                                        @foreach ($album as $alb)
                                            @if ($alb->id == $nhactop10->album_idnhac)
                                                @foreach ($nghesi as $ns)
                                                    @if ($ns->id == $alb->nghesi_idalbum)
                                                        <a href="/nghe-si/{{ $ns->id }}"
                                                            class="name-tacgia">{{ $ns->tennghesi }}</a>
                                                        <div class="info-name-tacgia-top ">
                                                            <div class="top-info-tacgia">
                                                                <div class="topleft-tacgia">
                                                                    @php
                                                                        $userimg = DB::table('user')
                                                                            ->where('id', $ns->id_nghesi_user)
                                                                            ->pluck('image')
                                                                            ->first();
                                                                    @endphp
                                                                    <img src="../../images/{{ $userimg }}"
                                                                        alt="">
                                                                    <div class="iftacgia">
                                                                        <a href="/nghe-si/{{ $ns->id }}"
                                                                            class="nametacgia-info">{{ $ns->tennghesi }}</a>
                                                                        @php
                                                                            $inputString = $ns->quantam;
                                                                            $parts = explode('-', $inputString);
                                                                            $check = 0;
                                                                        @endphp
                                                                        @foreach ($parts as $index => $part)
                                                                            @if ($part)
                                                                                @php
                                                                                    $check += 1;
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        @if ($check >= 0)
                                                                            <div class="luotquantam-info">
                                                                                {{ $check }}
                                                                                quan tâm</div>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                {{-- -------------------------------- --}}
                                                                @if (Auth::guard('web')->check())
                                                                    @php
                                                                        $isInterested =
                                                                            strpos($ns->quantam, $ttnguoidung->id) !==
                                                                            false;
                                                                    @endphp
                                                                    <div class="topright-tacgia"
                                                                        data-quantam="{{ $ns->id }}"
                                                                        @if ($isInterested) {{ 'style=background:blue;color:#fff' }}
                                                                        @else
                                                                            {{ '' }} @endif>
                                                                        <i class="bi bi-person-plus-fill"></i>
                                                                        @if ($isInterested)
                                                                            {{ 'Đã quan tâm' }}
                                                                        @else
                                                                            {{ 'Quan tâm' }}
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    @if (Auth::guard('google')->check())
                                                                        @php
                                                                            $isInterested =
                                                                                strpos(
                                                                                    $ns->quantam,
                                                                                    $ttnguoidung->id,
                                                                                ) !== false;
                                                                        @endphp
                                                                        <div class="topright-tacgia"
                                                                            data-quantam="{{ $ns->id }}"
                                                                            @if ($isInterested) {{ 'style=background:blue;color:#fff' }}
                                                            @else
                                                                {{ '' }} @endif>
                                                                            <i class="bi bi-person-plus-fill"></i>
                                                                            @if ($isInterested)
                                                                                {{ 'Đã quan tâm' }}
                                                                            @else
                                                                                {{ 'Quan tâm' }}
                                                                            @endif
                                                                        </div>
                                                                    @else
                                                                        <div class="topright-tacgia"
                                                                            data-quantam="{{ $ns->id }}"><i
                                                                                class="bi bi-person-plus-fill"></i>
                                                                            Quan tâm</div>
                                                                    @endif
                                                                @endif

                                                            </div>
                                                            <div class="bottom-info-tacgia">
                                                                <p>Mới</p>
                                                                <div class="bottom-menu">
                                                                    @php
                                                                        $items = DB::table('album')
                                                                            ->where('nghesi_idalbum', $ns->id)
                                                                            ->take(3)
                                                                            ->get();
                                                                    @endphp
                                                                    @foreach ($items as $item)
                                                                        <div class="list-album-tacgia">
                                                                            <div class="item-album-tacgia">
                                                                                <img src="../../images/{{ $item->hinhalbum }}"
                                                                                    alt="">
                                                                                <a
                                                                                    href="/album-nghesi/{{ $item->id }}">{{ $item->tenalbum }}</a>
                                                                                <p>{{ $item->namphathanh }}</p>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media-right">
                            @php
                                $filePath = public_path('music/' . $nhactop10->nhaclink);
                                $getID3 = new getID3();
                                $fileInfo = $getID3->analyze($filePath);
                                if (isset($fileInfo['playtime_string'])) {
                                    $duration = $fileInfo['playtime_string'];
                                }
                            @endphp
                            <div class="time-curent-media"><span>{{ $duration }}</span><i
                                    class="loadmusic-dot bi bi-caret-right-fill"></i></div>
                            @if (Auth::guard('web')->check())
                                @php
                                    $inputString = $ttnguoidung->thuvien;
                                    $parts = explode('-', $inputString);
                                    $check = 0;
                                @endphp
                                @foreach ($parts as $index => $part)
                                    @php
                                        $currentNumber = (int) $part;
                                    @endphp
                                    @if ($currentNumber == $nhactop10->id)
                                        @php

                                            $check = 1;
                                        @endphp
                                        <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                            title="Thêm vào yêu thích"><i class="bi bi-heart-fill"></i></div>
                                    @endif
                                @endforeach
                                @if ($check == 0)
                                    <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                        title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                @endif
                            @else
                                @if (Auth::guard('google')->check())
                                    @php
                                        $inputString = $ttnguoidung->thuvien;
                                        $parts = explode('-', $inputString);
                                        $check = 0;
                                    @endphp
                                    @foreach ($parts as $index => $part)
                                        @php
                                            $currentNumber = (int) $part;
                                        @endphp
                                        @if ($currentNumber == $nhactop10->id)
                                            @php

                                                $check = 1;
                                            @endphp
                                            <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                                title="Thêm vào yêu thích"><i class="bi bi-heart-fill"></i></div>
                                        @endif
                                    @endforeach
                                    @if ($check == 0)
                                        <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                            title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                    @endif
                                @else
                                    <div class="yeuthich-music"data-yeutich="{{ $nhactop10->id }}"
                                        title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                @endif
                            @endif
                            <div class="option">
                                <div class="dot-3"><i class="bi bi-three-dots"></i></div>
                                <div class="menu-right-media ">
                                    <div class="download" data-downloadmusic="{{ $nhactop10->nhaclink }}"><i
                                            class="bi bi-download"></i>Download</div>
                                    <div class="nhaccho" data-cho="{{ $nhactop10->maNhac }}"
                                        data-gia="{{ $nhactop10->gia }}"><i class="bi bi-phone-vibrate"></i>Cài nhạc
                                        chờ
                                    </div>
                                    <div class="sendchat"><i class="bi bi-chat-dots"></i>Share chat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="album-search-click"style="display:none">
        <div class="contener">
            <div class="Top-Contener">
                <h3>Album</h3>
            </div>
            <div class="list-menu-contenter-search">
                @foreach ($albumsearch as $item)
                    <div class="body-Contener">
                        <div class="item-body-content" data-album="{{ $item->id }}">
                            <img src="../../images/{{ $item->hinhalbum }}" alt="">
                            <div class="hover-item-body-content">
                                <i class="bi bi-caret-right-fill"></i>
                            </div>
                        </div>
                        <div class="title-body-content">{{ $item->tenalbum }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="nghesi-search-click"style="display:none">
        <div class="contener">
            <div class="Top-Contener">
                <h3>Nghệ sĩ </h3>
            </div>
            <div class="list-menu-contenter-search">
                @foreach ($nghesisearch as $nstop20)
                    <div class="body-Contener-search ">
                        <img class="img-ns" src="../../images/1.jpg" alt="">
                        <div class="name-ns">{{ $nstop20->tennghesi }}</div>
                        @php
                            $inputString = $nstop20->quantam;
                            $parts = explode('-', $inputString);
                            $check = 0;
                        @endphp
                        @foreach ($parts as $index => $part)
                            @if ($part)
                                @php
                                    $check += 1;
                                @endphp
                            @endif
                        @endforeach
                        @if ($check >= 0)
                            <div class="luotthich">{{ $check }} thích</div>
                        @endif
                        {{-- ---------------------------------------------------- --}}
                        @if (Auth::guard('web')->check())
                            @php
                                $isInterested = strpos($nstop20->quantam, $ttnguoidung->id) !== false;
                            @endphp
                            <div class="quantam" data-quantam="{{ $nstop20->id }}"
                                @if ($isInterested) {{ 'style=background:blue;color:#fff' }}
                                @else
                                    {{ '' }} @endif>
                                <i class="bi bi-person-plus-fill"></i>
                                @if ($isInterested)
                                    {{ 'Đã quan tâm' }}
                                @else
                                    {{ 'Quan tâm' }}
                                @endif
                            </div>
                        @else
                            @if (Auth::guard('google')->check())
                                @php
                                    $isInterested = strpos($nstop20->quantam, $ttnguoidung->id . 'gg') !== false;
                                @endphp
                                <div class="quantam"
                                    data-quantam="{{ $nstop20->id }}"@if ($isInterested) {{ `style="background: blue; color:#fff"` }}
                                    @else
                                        {{ '' }} @endif>
                                    <i class="bi bi-person-plus-fill"></i>
                                    @if ($isInterested)
                                        {{ 'Đã quan tâm' }}
                                    @else
                                        {{ 'Quan tâm' }}
                                    @endif
                                </div>
                            @else
                                <div class="quantam" data-quantam="{{ $nstop20->id }}"><i
                                        class="bi bi-person-plus-fill"></i>
                                    Quan tâm</div>
                            @endif
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('layouts.bottom')
