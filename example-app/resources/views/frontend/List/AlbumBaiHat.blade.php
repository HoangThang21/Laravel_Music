@include('layouts.top')
<div class="albumbaihat">
    <div class="top-album-baihat">
        <div class="left-top-album-baihat">
            <img src="../../images/{{ $Nhacalbumbaihat->imagemusic }}" alt="">
            <div class="left-top-album-baihat-tennhac">{{ $Nhacalbumbaihat->tennhac }}</div>
            <div class="left-top-album-baihat-nghesi">{{ $nghesis->tennghesi }}<i
                    class="bi bi-dot"></i>{{ $albums->namphathanh }}</div>
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
                                            <div class="load-nghe"data-song="{{ $Nhacalbumbaihat->id }}"><i
                                                    class="bi bi-caret-right-fill"></i></div>
                                        </div>
                                        <div class="name-media">
                                            <div class="name-music" data-nhacredict="{{ $Nhacalbumbaihat->id }}">
                                                {{ $Nhacalbumbaihat->tennhac }}
                                            </div>
                                            <div class="nametacgia">
                                                @foreach ($album as $alb)
                                                    @if ($alb->id == $Nhacalbumbaihat->album_idnhac)
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
                                                                                    <i
                                                                                        class="bi bi-person-plus-fill"></i>
                                                                                    @if ($isInterested)
                                                                                        {{ 'Đã quan tâm' }}
                                                                                    @else
                                                                                        {{ 'Quan tâm' }}
                                                                                    @endif
                                                                                </div>
                                                                            @else
                                                                                <div class="topright-tacgia"
                                                                                    data-quantam="{{ $ns->id }}">
                                                                                    <i
                                                                                        class="bi bi-person-plus-fill"></i>
                                                                                    Quan tâm
                                                                                </div>
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
                                        $filePath = public_path('music/' . $Nhacalbumbaihat->nhaclink);
                                        $getID3 = new getID3();
                                        $fileInfo = $getID3->analyze($filePath);
                                        if (isset($fileInfo['playtime_string'])) {
                                            $duration = $fileInfo['playtime_string'];
                                        }
                                    @endphp
                                    <div class="time-curent-media"data-song="{{ $Nhacalbumbaihat->id }}">
                                        <span>{{ $duration }}</span><i
                                            class="loadmusic-dot bi bi-caret-right-fill"></i>
                                    </div>
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
                                                        title="Thêm vào yêu thích"><i class="bi bi-heart-fill"></i>
                                                    </div>
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
                                            <div class="download"
                                                data-downloadmusic="{{ $Nhacalbumbaihat->nhaclink }}">
                                                <i class="bi bi-download"></i>Download
                                            </div>
                                            <div class="nhaccho" data-cho="{{ $Nhacalbumbaihat->maNhac }}"
                                                data-gia="{{ $Nhacalbumbaihat->gia }}"><i
                                                    class="bi bi-phone-vibrate"></i>Cài nhạc chờ
                                            </div>
                                            <div class="sendchat" data-sendchat="{{ $Nhacalbumbaihat->id }}"><i
                                                    class="bi bi-chat-dots"></i>Share chat</div>
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
        <div class="comment">
            <div class="DivCommentWrapper" style="height: 156px">
                <div class="DivCommentHeader">
                    <div class="DivCommentTotal">
                        <div class="BNhLuN">{{ $countComment }} Bình luận</div>
                    </div>
                    <div class="DivDropdown">
                        <div class="SortButtonWithThreeLinesSvg">
                            <div class="SortButtonWithThreeLinesSvgFill">
                                <div class="SortButtonWithThreeLinesSvg"
                                    style="width: 18px; height: 18px; position: relative">
                                    <div class="Vector"
                                        style="width: 18px; height: 12px; left: 0px; top: 3px; position: absolute; ">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="DivNewComment"
                    style="height: 86.33px; left: 22px; top: 58px; position: absolute; flex-direction: column; justify-content: flex-start; align-items: flex-end; gap: 7px; display: inline-flex">
                    <div class="DivNewCommentInput"
                        style="display: flex;justify-content: center;align-items: center;width: 400px; height: 46.33px; position: relative; background: white; border-radius: 5px; border: 1px #DCDCDC solid">
                        <input class="NhPBNhLuNCABN" placeholder="Nhập bình luận của bạn..."
                            style="width: 94%;align-self: stretch; color: #757575; font-size: 14px; font-family: Arial; font-weight: 400; word-wrap: break-word; outline: none; border: none ;padding: 10px">
                        </input>
                    </div>
                    <div class="DivCommentButton"
                        style="align-self: stretch; justify-content: flex-start; align-items: flex-start; gap: 4.46px; display: inline-flex">
                        <div class="DivCmBtn"
                            style="cursor: pointer;padding-left: 20px; padding-right: 20px; padding-top: 6px; padding-bottom: 6px; background: #F6F6F6; border-radius: 5px; justify-content: flex-start; align-items: flex-start; display: flex">
                            <div class="HYB"
                                style="text-align: center; color: #969696; font-size: 14px; font-family: Arial; font-weight: 400; line-height: 21px; word-wrap: break-word">
                                Hủy bỏ</div>
                        </div>
                        <div class="DivSubmitCommentBtn" data-songcomment="{{ $Nhacalbumbaihat->id }}"
                            style="cursor: pointer;padding-left: 20px; padding-right: 20px; padding-top: 6px; padding-bottom: 6px; background: #1A86F1; border-radius: 5px; justify-content: flex-start; align-items: flex-start; display: flex">
                            <div class="BNhLuaN"
                                style="text-align: center; color: white; font-size: 14px; font-family: Arial; font-weight: 400; line-height: 21px; word-wrap: break-word">
                                Bình luận</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="commetus">
                @foreach ($comment as $item)
                    @if (Auth::guard('web')->check())
                        <div class="itemcomment">
                            <div class="itemcomment-img"><img src="../../images/{{ $item->hinh }}" alt="">
                            </div>
                            <div class="itemcomment-info">
                                <div class="itemcomment-ten">{{ $item->ten }} <span>{{ $item->time }}</span>
                                    <span style="cursor: pointer;" class="delete_comment" data-comment="{{ $item->id }}"><i class="bi bi-trash"></i>
                                        Xóa</span>
                                </div>
                                <p class="itemcomment-comment">{{ $item->noidung }} </p>
                            </div>
                        </div>
                    @else
                        @if (Auth::guard('google')->check())
                            <div class="itemcomment">
                                <div class="itemcomment-img"><img src="../../images/{{ $item->hinh }}"
                                        alt=""></div>
                                <div class="itemcomment-info">
                                    <div class="itemcomment-ten">{{ $item->ten }} <span>{{ $item->time }}</span>
                                        <span style="cursor: pointer;" class="delete_comment" data-comment="{{ $item->id }}"><i
                                                class="bi bi-trash"></i> Xóa</span>
                                    </div>
                                    <p class="itemcomment-comment">{{ $item->noidung }} </p>
                                </div>
                            </div>
                        @else
                            <div class="itemcomment">
                                <div class="itemcomment-img"><img src="../../images/{{ $item->hinh }}"
                                        alt=""></div>
                                <div class="itemcomment-info">
                                    <div class="itemcomment-ten">{{ $item->ten }}  <span>{{ $item->time }}</span></div>
                                    <p class="itemcomment-comment">{{ $item->noidung }} </p>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach


            </div>
        </div>
        <div class="lyric">
            <div class="title-bottom-album-baihat">Lời bài hát</div>
            <div class="content-bottom-album-baihat">
                {!! $Nhacalbumbaihat->lyric !!}
            </div>
        </div>

    </div>
</div>
@include('layouts.bottom')
