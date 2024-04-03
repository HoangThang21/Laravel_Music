@include('layouts.top')
<div class="chat-content">
    <div class="messages" id="messages">
        @foreach ($chat as $ch)
            @if ($ch->iduser != '')
                @if ($ch->iduser == $ttnguoidung->id)
                    <div class="right message">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                viewBox="0 0 22 22" fill="none">
                                                <path
                                                    d="M4.07692 20.7495C5.77626 20.7495 7.15385 19.3719 7.15385 17.6726C7.15385 15.9733 5.77626 14.5957 4.07692 14.5957C2.37759 14.5957 1 15.9733 1 17.6726C1 19.3719 2.37759 20.7495 4.07692 20.7495Z"
                                                    stroke="url(#paint0_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M17.923 16.9034C19.6223 16.9034 20.9999 15.5258 20.9999 13.8265C20.9999 12.1271 19.6223 10.7495 17.923 10.7495C16.2237 10.7495 14.8461 12.1271 14.8461 13.8265C14.8461 15.5258 16.2237 16.9034 17.923 16.9034Z"
                                                    stroke="url(#paint1_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M21.0001 13.8265V1.76492C20.9994 1.64721 20.9718 1.53123 20.9192 1.4259C20.8667 1.32057 20.7907 1.2287 20.6971 1.15736C20.6034 1.08602 20.4947 1.03713 20.3792 1.01443C20.2637 0.991739 20.1445 0.995853 20.0309 1.02646L7.72316 4.44184C7.56052 4.48563 7.41674 4.5816 7.31391 4.715C7.21108 4.8484 7.15488 5.01187 7.15393 5.1803V17.6726"
                                                    stroke="url(#paint2_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.15393 9.21108L21.0001 5.36493"
                                                    stroke="url(#paint3_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_141_94" x1="0.20658"
                                                        y1="13.6489" x2="9.13768" y2="14.1966"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint1_linear_141_94" x1="14.0526"
                                                        y1="9.80279" x2="22.9837" y2="10.3505"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint2_linear_141_94" x1="5.36874"
                                                        y1="-1.56502" x2="25.4871" y2="-0.540493"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint3_linear_141_94" x1="5.36874"
                                                        y1="4.77321" x2="24.602" y2="9.01904"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <div class="nhac"><a target="_black"
                                                    href="../../music/{{ $nh->nhaclink }}">{{ $nh->tennhac }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="img">
                            <img src="../../images/{{ $ch->hinhuser }}" alt="">
                        </div>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            viewBox="0 0 22 22" fill="none">
                                            <path
                                                d="M4.07692 20.7495C5.77626 20.7495 7.15385 19.3719 7.15385 17.6726C7.15385 15.9733 5.77626 14.5957 4.07692 14.5957C2.37759 14.5957 1 15.9733 1 17.6726C1 19.3719 2.37759 20.7495 4.07692 20.7495Z"
                                                stroke="url(#paint0_linear_141_94)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M17.923 16.9034C19.6223 16.9034 20.9999 15.5258 20.9999 13.8265C20.9999 12.1271 19.6223 10.7495 17.923 10.7495C16.2237 10.7495 14.8461 12.1271 14.8461 13.8265C14.8461 15.5258 16.2237 16.9034 17.923 16.9034Z"
                                                stroke="url(#paint1_linear_141_94)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M21.0001 13.8265V1.76492C20.9994 1.64721 20.9718 1.53123 20.9192 1.4259C20.8667 1.32057 20.7907 1.2287 20.6971 1.15736C20.6034 1.08602 20.4947 1.03713 20.3792 1.01443C20.2637 0.991739 20.1445 0.995853 20.0309 1.02646L7.72316 4.44184C7.56052 4.48563 7.41674 4.5816 7.31391 4.715C7.21108 4.8484 7.15488 5.01187 7.15393 5.1803V17.6726"
                                                stroke="url(#paint2_linear_141_94)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.15393 9.21108L21.0001 5.36493"
                                                stroke="url(#paint3_linear_141_94)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_141_94" x1="0.20658"
                                                    y1="13.6489" x2="9.13768" y2="14.1966"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#B5179E" />
                                                    <stop offset="1" stop-color="#7209B7" />
                                                </linearGradient>
                                                <linearGradient id="paint1_linear_141_94" x1="14.0526"
                                                    y1="9.80279" x2="22.9837" y2="10.3505"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#B5179E" />
                                                    <stop offset="1" stop-color="#7209B7" />
                                                </linearGradient>
                                                <linearGradient id="paint2_linear_141_94" x1="5.36874"
                                                    y1="-1.56502" x2="25.4871" y2="-0.540493"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#B5179E" />
                                                    <stop offset="1" stop-color="#7209B7" />
                                                </linearGradient>
                                                <linearGradient id="paint3_linear_141_94" x1="5.36874"
                                                    y1="4.77321" x2="24.602" y2="9.01904"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#B5179E" />
                                                    <stop offset="1" stop-color="#7209B7" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                @endif
            @endif
            @if ($ch->idusergg != '')
              
                @if ($ch->idusergg == $ttnguoidung->id)
                    <div class="right message">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                viewBox="0 0 22 22" fill="none">
                                                <path
                                                    d="M4.07692 20.7495C5.77626 20.7495 7.15385 19.3719 7.15385 17.6726C7.15385 15.9733 5.77626 14.5957 4.07692 14.5957C2.37759 14.5957 1 15.9733 1 17.6726C1 19.3719 2.37759 20.7495 4.07692 20.7495Z"
                                                    stroke="url(#paint0_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M17.923 16.9034C19.6223 16.9034 20.9999 15.5258 20.9999 13.8265C20.9999 12.1271 19.6223 10.7495 17.923 10.7495C16.2237 10.7495 14.8461 12.1271 14.8461 13.8265C14.8461 15.5258 16.2237 16.9034 17.923 16.9034Z"
                                                    stroke="url(#paint1_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M21.0001 13.8265V1.76492C20.9994 1.64721 20.9718 1.53123 20.9192 1.4259C20.8667 1.32057 20.7907 1.2287 20.6971 1.15736C20.6034 1.08602 20.4947 1.03713 20.3792 1.01443C20.2637 0.991739 20.1445 0.995853 20.0309 1.02646L7.72316 4.44184C7.56052 4.48563 7.41674 4.5816 7.31391 4.715C7.21108 4.8484 7.15488 5.01187 7.15393 5.1803V17.6726"
                                                    stroke="url(#paint2_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.15393 9.21108L21.0001 5.36493"
                                                    stroke="url(#paint3_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_141_94" x1="0.20658"
                                                        y1="13.6489" x2="9.13768" y2="14.1966"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint1_linear_141_94" x1="14.0526"
                                                        y1="9.80279" x2="22.9837" y2="10.3505"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint2_linear_141_94" x1="5.36874"
                                                        y1="-1.56502" x2="25.4871" y2="-0.540493"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint3_linear_141_94" x1="5.36874"
                                                        y1="4.77321" x2="24.602" y2="9.01904"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <div class="nhac"><a target="_black"
                                                    href="../../music/{{ $nh->nhaclink }}">{{ $nh->tennhac }}</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="img">
                            <img src="../../images/{{ $ch->hinhuser }}" alt="">
                        </div>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                viewBox="0 0 22 22" fill="none">
                                                <path
                                                    d="M4.07692 20.7495C5.77626 20.7495 7.15385 19.3719 7.15385 17.6726C7.15385 15.9733 5.77626 14.5957 4.07692 14.5957C2.37759 14.5957 1 15.9733 1 17.6726C1 19.3719 2.37759 20.7495 4.07692 20.7495Z"
                                                    stroke="url(#paint0_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M17.923 16.9034C19.6223 16.9034 20.9999 15.5258 20.9999 13.8265C20.9999 12.1271 19.6223 10.7495 17.923 10.7495C16.2237 10.7495 14.8461 12.1271 14.8461 13.8265C14.8461 15.5258 16.2237 16.9034 17.923 16.9034Z"
                                                    stroke="url(#paint1_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M21.0001 13.8265V1.76492C20.9994 1.64721 20.9718 1.53123 20.9192 1.4259C20.8667 1.32057 20.7907 1.2287 20.6971 1.15736C20.6034 1.08602 20.4947 1.03713 20.3792 1.01443C20.2637 0.991739 20.1445 0.995853 20.0309 1.02646L7.72316 4.44184C7.56052 4.48563 7.41674 4.5816 7.31391 4.715C7.21108 4.8484 7.15488 5.01187 7.15393 5.1803V17.6726"
                                                    stroke="url(#paint2_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.15393 9.21108L21.0001 5.36493"
                                                    stroke="url(#paint3_linear_141_94)" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_141_94" x1="0.20658"
                                                        y1="13.6489" x2="9.13768" y2="14.1966"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint1_linear_141_94" x1="14.0526"
                                                        y1="9.80279" x2="22.9837" y2="10.3505"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint2_linear_141_94" x1="5.36874"
                                                        y1="-1.56502" x2="25.4871" y2="-0.540493"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                    <linearGradient id="paint3_linear_141_94" x1="5.36874"
                                                        y1="4.77321" x2="24.602" y2="9.01904"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#B5179E" />
                                                        <stop offset="1" stop-color="#7209B7" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            
            @endif
        @endforeach
    </div>
    <form method="post" enctype="multipart/form-data" id="formchat" action="/sendchat">
        @csrf
        @if ($namemusic)
            <div class="musicform">
                <input type="hidden" name="linknhac" value="{{ $namemusic->id }}" readonly>
                <a target="_black" href="../../music/{{ $namemusic->nhaclink }}">{{ $namemusic->tennhac }}</a>
                <i class="bi bi-music-note-beamed"></i>
            </div>
        @endif
        <textarea id="message-input" rows="1" name="message-input" placeholder="Nhập nội dung..."></textarea>
        <div id="output"></div>
        <div id="submitchat" class="submitchat"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                height="25" viewBox="0 0 25 25" fill="none">
                <path
                    d="M10.6844 19.3431L14.425 23.0786C14.6572 23.3108 14.9449 23.4798 15.2608 23.5696C15.5766 23.6593 15.9102 23.6669 16.2299 23.5915C16.5495 23.5161 16.8445 23.3602 17.087 23.1388C17.3295 22.9173 17.5113 22.6375 17.6152 22.326L23.7541 3.89228C23.8675 3.55297 23.8841 3.18877 23.802 2.84056C23.7199 2.49234 23.5424 2.17389 23.2895 1.92092C23.0365 1.66795 22.718 1.49047 22.3698 1.4084C22.0216 1.32633 21.6574 1.34291 21.3181 1.45628L2.88439 7.60028C2.57386 7.70463 2.29507 7.88642 2.07434 8.12849C1.85361 8.37055 1.69825 8.66489 1.62292 8.98371C1.54759 9.30252 1.55479 9.63527 1.64384 9.95053C1.73288 10.2658 1.90083 10.5531 2.13182 10.7854L6.83068 15.4894L6.67125 21.4294L10.6844 19.3431Z"
                    stroke="#7A7A7A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M23.204 1.84027L6.83081 15.4894" stroke="#7A7A7A" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg></div>
        <div id="scrollButton"><i class="bi bi-caret-down-fill"></i></div>
    </form>
</div>
@include('layouts.bottom')
