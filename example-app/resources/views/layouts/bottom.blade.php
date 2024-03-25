</div>
<div class="rightsong">
    right
</div>
</div>


</div>

{{-- botom --}}
<div class="master_play ">
    <div class="left-master-play">
        <div class="wave active2">
            <div class="wave1"></div>
            <div class="wave1"></div>
            <div class="wave1"></div>
        </div>
        <img src="../../images/img1710036980-6.png" alt="" class="IgMuSc" />
        <div class="info_ns">
            <h5 class="NameBai">memories
            </h5>
            <div class="subtitle NameNS">maroon 5</div>
        </div>
    </div>
    <div class="mid-master-play">
        <div class="icon">
            <i class="bi bi-skip-backward-fill" id="backward"></i>
            <i class="bi bi-skip-start-fill" id="back"></i>
            <i class="bi bi-play-fill" id="masterPlay"></i>
            <i class="bi bi-skip-end-fill" id="next"></i>
            <i class="bi bi-skip-forward-fill" id="nextforward"></i>
        </div>
        <span id="currentStart">0:00</span>
        <div class="bar">
            <input type="range" name="range" id="seek" class="range" />
            <div class="bar2" id="bar2"></div>
            <div class="dot" id="dot_music"></div>
        </div>
        <span id="currentEnd">0:00</span>

    </div>
    <div class="right-master-play">
        <div class="right-setup">
            <div class="le-right-setup">
                <i class="bi bi-volume-up" id="vol-up"></i>
                <div class="vol">
                    <input type="range" name="range-seek-vol" id="seek-vol" class="range-vol" max="100"
                        min="0" />
                    <div class="bar-vol" id="bar-vol"></div>
                    <div class="dot" id="dot-music"></div>
                </div>
            </div>
            <i class="bi bi-shuffle" id="random"></i>
            <i class="bi bi-arrow-repeat" id="all"></i>
            <div class="menu-list-right-setup">
                <i class="bi bi-music-note-list" id="list-memu" title="Danh sách phát"></i>
                <div class="right-menu-setup">
                    <h3>Danh sách phát</h3>
                    <div class="menu-right-setup-list">
                        <div class="info-media-bottom">
                            <div class="img-media">
                                <img src="../../images/3.png" alt="">
                                <div class="load-nghe-bottom"><i class="bi bi-caret-right-fill"></i></div>
                            </div>
                            <div class="name-media">
                                <div class="name-music-bottom">maroon 5 - memories</div>
                                <a href="" class="name-tacgia">aa</a>
                            </div>
                            <i class="bi bi-play-fill"></i>
                            <div class="option">
                                <div class="dot-3"><i class="bi bi-three-dots"></i></div>
                                <div class="menu-right-media bottom-listmmusic">
                                    <div class="download" data-downloadmusic="holo.mp3"><i
                                            class="bi bi-download"></i>Download
                                    </div>
                                    <div class="nhaccho" data-cho="8217381" data-gia="3000"><i
                                            class="bi bi-phone-vibrate"></i>Cài nhạc chờ
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
<div class="thongbao" style="background-color: #1cd912;">
    <div class="headerthongbao">
        <div class="tieude"></div>
        <i class="bi bi-x-lg" onclick="toggleMenu('thongbao')"></i>
    </div>
</div>
</header>
<script type="text/javascript" src="../../inc/js/index.js"></script>

{{-- @if (Auth::guard('api')->check())
        <script>
            const user = '{{ $infouser->id }}';
        </script>
    @endif --}}
<script>
    var csrfToken = ` {{ csrf_token() }}`;
    var activemenu = '{{ $activerity }}';
</script>
<script type="text/javascript" src="../../inc/js/redict.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

</body>

</html>
