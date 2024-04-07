@include('layouts.top')
<div class="Mchart-menu">
    <div class="tieude">#MChart</div>
    <div id="myfirstchart" style="height: 250px;"></div>
    <div class="botom-mchart">
        <div class="bodyhome">
            <div class="table-music">
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
    </div>
</div>
@include('layouts.bottom')