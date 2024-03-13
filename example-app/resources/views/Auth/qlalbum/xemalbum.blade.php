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

        @foreach ($album as $alb)
        @endforeach
        <table class="table table-hover">
            <tr>
                <th>Tên nhạc</th>
                <th>Nhạc</th>
                <th>Hình</th>



            </tr>
            @foreach ($nhac as $nd)
                <tr>
                    <td>{{ $nd['tennhac'] }}</td>
                    <td><audio controls controlsList="nofullscreen nodownload noremoteplayback" id="msa">
                            <source src="../../music/{{ $nd['nhaclink'] }}" type="audio/mp3">
                        </audio></td>
                    <td><img src="../../images/{{ $nd['imagemusic'] }}" width="80" class="img-thumbnail"></td>
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
