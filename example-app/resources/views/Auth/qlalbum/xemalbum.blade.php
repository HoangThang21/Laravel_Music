@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <table class="table table-hover">
            <tr>
                <th>Tên nhạc</th>
                <th>Nhạc</th>
                <th>Hình</th>
                <th>Tên album</th>
                <th>Chức năng</th>

            </tr>
            <?php foreach ($nhac as $nd): ?>
            <tr>
                <td>{{ $nd['tennhac'] }}</td>
                <td><audio controls controlsList="nofullscreen nodownload noremoteplayback" id="msa">
                        <source src="../../music/{{ $nd['nhaclink'] }}" type="audio/mp3">
                    </audio></td>
                {{-- <td><img src="../../images/{{ $nd['imagemusic'] }}" width="80" class="img-thumbnail"></td> --}}
                <td>
                    <input type="range" name="inputrangemusic" id="inputrangemusic" max="100" min="0" value="0">

                </td>

                @if ($album['id'] == $nd['album_idnhac'])
                    <td>{{ $album['tenalbum'] }}</td>
                @endif



                <td><a href="/Administrator/qlnhac/xoanhac&{{ $nd['id'] }}-music" class="text-danger">Xóa</a>
                    <span> | </span>
                    <a href="/Administrator/qlnhac/suanhac&{{ $nd['id'] }}-music" class="text-warning">Sửa</a>
                </td>
            </tr>


            <?php endforeach; ?>
        </table>


    </div>
@endif
@include('layoutsAdmin.bottom')
