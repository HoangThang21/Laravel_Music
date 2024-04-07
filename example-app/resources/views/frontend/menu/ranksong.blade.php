@include('layouts.top')
<div class="bodyhome">
    <div class="table-music">
        <div class="toptable">
            <div class="discover">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <path
                        d="M7.85716 13H6.14287C5.1961 13 4.42859 13.7675 4.42859 14.7143V21.5714C4.42859 22.5182 5.1961 23.2857 6.14287 23.2857H7.85716C8.80393 23.2857 9.57145 22.5182 9.57145 21.5714V14.7143C9.57145 13.7675 8.80393 13 7.85716 13Z"
                        stroke="url(#paint0_linear_1_328)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M18.1429 13H16.4286C15.4818 13 14.7143 13.7675 14.7143 14.7143V21.5714C14.7143 22.5182 15.4818 23.2857 16.4286 23.2857H18.1429C19.0896 23.2857 19.8572 22.5182 19.8572 21.5714V14.7143C19.8572 13.7675 19.0896 13 18.1429 13Z"
                        stroke="url(#paint1_linear_1_328)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M1 16.4286V12.1429C1 9.18759 2.17398 6.35336 4.26367 4.26367C6.35336 2.17398 9.18759 1 12.1429 1C15.0981 1 17.9324 2.17398 20.022 4.26367C22.1117 6.35336 23.2857 9.18759 23.2857 12.1429V16.4286"
                        stroke="url(#paint2_linear_1_328)" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <defs>
                        <linearGradient id="paint0_linear_1_328" x1="3.76552" y1="11.4176" x2="11.2504"
                            y2="11.6471" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#B5179E" />
                            <stop offset="1" stop-color="#7209B7" />
                        </linearGradient>
                        <linearGradient id="paint1_linear_1_328" x1="14.0512" y1="11.4176" x2="21.5361"
                            y2="11.6471" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#B5179E" />
                            <stop offset="1" stop-color="#7209B7" />
                        </linearGradient>
                        <linearGradient id="paint2_linear_1_328" x1="-1.87331" y1="-1.37363" x2="30.3389"
                            y2="1.47955" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#B5179E" />
                            <stop offset="1" stop-color="#7209B7" />
                        </linearGradient>
                    </defs>
                </svg>
                <p>Nhạc mới</p>
                <i class="bi bi-caret-right-fill"></i>
            </div>
            <a href="">Tất cả <i class="bi bi-chevron-right"></i></a>
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
                                <div class="name-music"  data-nhacredict="{{ $nhactop10->id }}">{{ $nhactop10->tennhac }}
                                </div>
                                <div class="nametacgia">
                                    @foreach ($album as $alb)
                                        @if ($alb->id == $nhactop10->album_idnhac)
                                            @foreach ($nghesi as $ns)
                                                @if ($ns->id == $alb->nghesi_idalbum)
                                                    <a href="/nghe-si/{{ $ns->id }}"
                                                        class="name-tacgia">{{ $ns->tennghesi }}</a>
                                                    <div class="info-name-tacgia">
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
                                                                    <a href=""
                                                                        class="nametacgia-info">{{ $ns->tennghesi }}</a>
                                                                    <div class="luotquantam-info">{{ $ns->quantam }}
                                                                        quan tâm</div>
                                                                </div>
                                                            </div>
                                                            <div class="topright-tacgia"
                                                                data-quantamns="{{ $ns->id }}">Quan tâm +</div>
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
                                                                                href="/album/{{ $item->id }}">{{ $item->tenalbum }}</a>
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
                        <div class="yeuthich-music" title="Thêm vào yêu thích"><i class="bi bi-heart"></i></div>
                        <div class="option">
                            <div class="dot-3"><i class="bi bi-three-dots"></i></div>
                            <div class="menu-right-media ">
                                <div class="download" data-downloadmusic="{{ $nhactop10->nhaclink }}"><i
                                        class="bi bi-download"></i>Download</div>
                                <div class="nhaccho" data-cho="{{ $nhactop10->maNhac }}"
                                    data-gia="{{ $nhactop10->gia }}"><i class="bi bi-phone-vibrate"></i>Cài nhạc chờ
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
@include('layouts.bottom')
