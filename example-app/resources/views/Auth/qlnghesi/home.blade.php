@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Nghệ sĩ</h3>
        <div><a class="btn btn-primary" href="/Administrator/qlnghesi/themnghesi"><span
                    class="glyphicon glyphicon-plus"></span> Thêm nghệ sĩ</a></div>

        <br>

        <!-- Danh sách người dùng -->
        <table class="table table-hover">
            <tr>
                <th>Hình</th>
                <th>Tên nghệ sĩ</th>
                <th>Email</th>
                <th>Chức năng</th>
                <th></th>
            </tr>
            @foreach ($user as $us)
                @if ($us['quyen'] == 4)
                    <?php foreach ($nghesi as $nd): ?>
                    @if ($nd['id_nghesi_user'] == $us['id'])
                        <tr>
                            <td><img width="50" height="50" src="../../images/{{ $us['image'] }}" alt="">
                            </td>
                            <td>{{ $nd['tennghesi'] }}</td>
                            <td>{{ $nd['email'] }}</td>
                            <td><a href="/Administrator/qlnghesi/xoanghesi&{{ $nd['id'] }}-ns"
                                    class="text-danger">Xóa</a>
                                <span> | </span>
                                <a href="/Administrator/qlnghesi/suanghesi&{{ $nd['id'] }}-ns"
                                    class="text-warning">Sửa</a>
                            </td>

                        </tr>
                    @endif


                    <?php endforeach; ?>
                @endif
            @endforeach
            @foreach ($userapi as $us)
                @if ($us['quyen'] == 4)
                    <?php foreach ($nghesi as $nd): ?>
                    @if ($nd['idnghesi_userapi'] == $us['id'])
                        <tr>
                            <td><img width="50" height="50" src="../../images/{{ $us['image'] }}" alt="">
                            </td>
                            <td>{{ $nd['tennghesi'] }}</td>
                            <td>{{ $us['email'] }}</td>
                            <td><a href="/Administrator/qlnghesi/xoanghesi&{{ $nd['id'] }}-ns"
                                    class="text-danger">Xóa</a>
                                <span> | </span>
                                <a href="/Administrator/qlnghesi/suanghesi&{{ $nd['id'] }}-ns"
                                    class="text-warning">Sửa</a>
                            </td>

                        </tr>
                    @endif


                    <?php endforeach; ?>
                @endif
            @endforeach

        </table>

    </div>
@endif
@include('layoutsAdmin.bottom')
