@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>

        <div class="infoxemalbum">
            <div class="imgxemalbum"><img src="../../images/{{ $user['image'] }}" alt=""></div>
            <div class="infotext">
                <div class="namexemalbum">Tên nghệ sĩ: {{ $user['name'] }} ( {{ $nghesi->tennghesi }} )</div>
                <div class="emailnsxemalbum">Email: {{ $user['email'] }}</div>
            </div>
        </div>
        <div class="goiyalbum">
            <div class="textalbum">Album:</div>
            <div class="albumgoiy">
                @foreach ($albumgoiy as $albgoiy)
                    <a href="/Administrator/qlalbum/xemalbum&{{ $albgoiy['id'] }}-alb">{{ $albgoiy['tenalbum'] }}</a>
                @endforeach
            </div>
        </div>

        <div class="tenalbum" style="color: #a5a5a5">Album: {{ $album->tenalbum }}</div>

        <table class="table table-hover">
            <tr>
                <th>Nhạc</th>
                <th>Tên nhạc</th>
                <th>Hình</th>
                <th>Lượt nghe</th>
                <th>Lượt Download</th>
                <th>Chức năng</th>


            </tr>
            @foreach ($nhac as $nd)
                <tr>

                    <td><audio controls controlsList="nofullscreen nodownload noremoteplayback" id="msa">
                            <source src="../../music/{{ $nd['nhaclink'] }}" type="audio/mp3">
                        </audio></td>
                    <td class="tennhac">{{ $nd['tennhac'] }}</td>
                    <td><img src="../../images/{{ $nd['imagemusic'] }}" width="80" class="img-thumbnail"></td>
                    <td>{{ number_format($nd['luotnghe']) }}</td>
                    <td>{{ number_format($nd['luotdownload']) }}</td>
                    <td > <a href="/Administrator/qlnhac/xemcomment&{{ $nd['id'] }}-comment"
                            class="btn btn-outline-info mb-2"><i class="bi bi-eye-fill"></i>Xem bình luận</a>
                            @if ($nd->xetduyet == 0)
                            <div class=""></div>
                        @else
                            
                            <a href="/Administrator/loadchat&{{ $nd['id'] }}-albd"
                                class="btn btn-outline-info">Send chat</a>
                        @endif
                        </td>
                   
                    {{-- <td>
                    <input type="range" name="inputrangemusic" id="inputrangemusic" max="100" min="0" value="0">

                </td> --}}

                    {{-- @if ($album['id'] == $nd['album_idnhac'])
                    <td>{{ $album['tenalbum'] }}</td>
                @endif --}}
                </tr>
            @endforeach

        </table>


    </div>
@endif
@include('layoutsAdmin.bottom')
