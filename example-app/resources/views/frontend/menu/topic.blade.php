@include('layouts.top')
<div class="menu-topic">
    <div class="item-list-topic">
        <div class="header-topic">Nhạc Việt Nam</div>
        <div class="body-topic-item" style="height: 180px;">
            @foreach ($theloai as $item)
                <div class="item" data-tl="{{ $item->id }}">{{ $item->tentheloai }}</div>
            @endforeach


        </div>
        <div class="bottom-topic">
            <div class="item-xthem">
                Xem thêm </div>
            <i class="bi bi-caret-down-fill"></i>
        </div>

    </div>

    <br>
    <br>
    <br>

</div>
@include('layouts.bottom')
