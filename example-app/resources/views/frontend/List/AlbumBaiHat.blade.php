@include('layouts.top')
<div class="albumbaihat">
    <div class="top-album-baihat">
        <div class="left-top-album-baihat">
            <img src="../../images/{{ $Nhacalbumbaihat->imagemusic }}" alt="">
            <div class="left-top-album-baihat-tennhac">{{ $Nhacalbumbaihat->tennhac }}</div>
            <div class="left-top-album-baihat-nghesi">{{ $nghesis->tennghesi }}<i class="bi bi-dot"></i>{{ $albums->namphathanh }}</div>
            @php
                        $inputString = $nghesis->quantam;
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
                    <div class="left-top-album-baihat-yeuthich">{{ $check }} yêu thích</div>
                    @endif
           
        </div>
        <div class="right-top-album-baihat">
            <div class="botom-mchart">
                <div class="bodyhome">
                    <div class="table-music">
                        <div class="menu-media">
                                <div class="media">
                                    <div class="media-left">
                                       
                                        <div class="info-media">
                                            <div class="img-media">
                                                <img src="../../images/{{ $Nhacalbumbaihat->imagemusic }}" alt="">
                                                <div class="load-nghe"data-song="{{ $Nhacalbumbaihat->id }}"><i class="bi bi-caret-right-fill"></i></div>
                                            </div>
                                            <div class="name-media">
                                                <div class="name-music" data-nhacredict="{{ $Nhacalbumbaihat->id }}">
                                                    {{ $Nhacalbumbaihat->tennhac }}
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media-right">
                                        @php
                                            $filePath = public_path('music/' . $Nhacalbumbaihat->nhaclink);
                                            $getID3 = new getID3();
                                            $fileInfo = $getID3->analyze($filePath);
                                            if (isset($fileInfo['playtime_string'])) {
                                                $duration = $fileInfo['playtime_string'];
                                            }
                                        @endphp
                                        <div class="time-curent-media"data-song="{{ $Nhacalbumbaihat->id }}"><span>{{ $duration }}</span><i
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
                                                    @if ($currentNumber == $Nhacalbumbaihat->id)
                                                        @php
                    
                                                            $check = 1;
                                                        @endphp
                                                        <div class="yeuthich-music "data-yeutich="{{ $Nhacalbumbaihat->id }}"
                                                            title="Thêm vào yêu thích"><i class="bi bi-heart-fill"></i></div>
                                                    @endif
                                                @endforeach
                                                @if ($check == 0)
                                                    <div class="yeuthich-music "data-yeutich="{{ $Nhacalbumbaihat->id }}"
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
                                                        @if ($currentNumber == $Nhacalbumbaihat->id)
                                                            @php
                    
                                                                $check = 1;
                                                            @endphp
                                                            <div class="yeuthich-music "data-yeutich="{{ $Nhacalbumbaihat->id }}"
                                                                title="Thêm vào yêu thích"><i class="bi bi-heart-fill"></i></div>
                                                        @endif
                                                    @endforeach
                                                    @if ($check == 0)
                                                        <div class="yeuthich-music "data-yeutich="{{ $Nhacalbumbaihat->id }}"
                                                            title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                                    @endif
                                                @else
                                                    <div class="yeuthich-music "data-yeutich="{{ $Nhacalbumbaihat->id }}"
                                                        title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                                                @endif
                                            @endif
                                        <div class="option">
                                            <div class="dot-3"><i class="bi bi-three-dots"></i></div>
                                            <div class="menu-right-media ">
                                                <div class="download" data-downloadmusic="{{ $Nhacalbumbaihat->nhaclink }}">
                                                    <i class="bi bi-download"></i>Download
                                                </div>
                                                <div class="nhaccho" data-cho="{{ $Nhacalbumbaihat->maNhac }}"
                                                    data-gia="{{ $Nhacalbumbaihat->gia }}"><i
                                                        class="bi bi-phone-vibrate"></i>Cài nhạc chờ
                                                </div>
                                                <div class="sendchat" data-sendchat="{{ $Nhacalbumbaihat->id }}"><i class="bi bi-chat-dots"></i>Share chat</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-album-baihat">
        <div class="title-bottom-album-baihat">Lời bài hát</div>
        <div class="content-bottom-album-baihat">
            {!! $Nhacalbumbaihat->lyric !!}
     </div>
    </div>
</div>
@include('layouts.bottom')
