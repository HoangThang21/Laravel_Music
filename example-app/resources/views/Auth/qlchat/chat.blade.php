@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div class="chat-content">
        <div class="messages" id="messages">
            @foreach ($chat as $ch)
                @if ($ch->iduser == $ttnguoidung->id)
                    <div class="right message">

                        <div class="listdot">
                            <div class="menudot">
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                            <div class="item-list-dot">
                                <a href="/Administrator/xoachat&{{ $ch->id }}"><i
                                        class="bi bi-trash-fill"></i>Xóa</a>
                            </div>
                        </div>
                        <div class="bodymessage">
                            <div class="topmessage">
                                <div class="timeup">{{ $ch->time }}</div>
                                <div class="namemessage">{{ $ch->tenuser }}</div>
                            </div>
                            <div class="middlemessage">
                                <div class="noidung">{!! $ch->noidung !!}</div>
                            </div>
                            @if ($ch->idnhac)
                                @foreach ($nhac as $nh)
                                    @if ($ch->idnhac == $nh->id)
                                        <div class="bottomessage">
                                            <i class="bi bi-music-note-beamed"></i>
                                            <div class="nhac"><a target="_black"
                                                    href="../../music/{{ $nh->nhaclink }}">{{ $nh->tennhac }}</a></div>

                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                        <div class="img">
                            <img src="../../images/{{ $ch->hinhuser }}" alt="">
                        </div>
                        {{-- ------------------------------------------------------------------------ --}}
                    @else
                        <div class="left message">
                            <div class="img">
                                <img src="../../images/{{ $ch->hinhuser }}" alt="">
                            </div>
                            <div class="bodymessage">
                                <div class="topmessage">
                                    <div class="namemessage">{{ $ch->tenuser }}</div>
                                    <div class="timeup">{{ $ch->time }}</div>
                                </div>
                                <div class="middlemessage">
                                    <div class="noidung">{!! $ch->noidung !!}</div>
                                </div>
                                @if ($ch->idnhac)
                                    @foreach ($nhac as $nh)
                                        @if ($ch->idnhac == $nh->id)
                                            <div class="bottomessage">
                                                <div class="nhac"><a target="_black"
                                                        href="../../music/{{ $nh->nhaclink }}">{{ $nh->tennhac }}</a>
                                                </div>
                                                <i class="bi bi-music-note-beamed"></i>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                            <div class="listdot">
                                <div class="menudot">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </div>
                                <div class="item-list-dot">
                                    <a href="/Administrator/xoachat&{{ $ch->id }}"><i
                                            class="bi bi-trash-fill"></i>Xóa</a>
                                    <a href="/Administrator/xoachat&{{ $ch->id }}"><i
                                            class="bi bi-trash-fill"></i>Ban</a>
                                </div>
                            </div>
                            
                @endif
        </div>
@endforeach
<button id="scrollButton" style="display: none;"><i class="bi bi-caret-down-fill"></i></button>
</div>
<form method="post" enctype="multipart/form-data" id="formchat" action="/Administrator/broadcast">
    @csrf
    @if ($namemusic)
        <div class="musicform">
            <input type="hidden" name="linknhac" value="{{ $namemusic->id }}" readonly>
            <a target="_black" href="../../music/{{ $namemusic->nhaclink }}">{{ $namemusic->tennhac }}</a>
            <i class="bi bi-music-note-beamed"></i>
        </div>
    @endif
    <textarea id="message-input" name="message-input" placeholder="Nhập nội dung..."></textarea>
    <div id="output"></div>
    <button id="submitchat" type="submit"><i class="bi bi-cursor-fill"></i> Gửi</button>
</form>
</div>
@endif
@include('layoutsAdmin.bottom')
