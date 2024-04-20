@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Thể loại</h3>
        <div><a class="btn btn-primary" href="/Administrator/qltheloai/themtheloai"><span
                    class="glyphicon glyphicon-plus"><i class="bi bi-plus-circle"></i></span> Thêm thể loại</a></div>

        <br>

        <!-- Danh sách người dùng -->
        <table class="table table-hover">
            <tr>
                <th>STT</th>
                <th>Tên thể loại</th>
                <th>Chức năng</th>
                <th></th>
            </tr>
            @foreach ($theloai as $nd)
            <tr>
                <td>@php
                    $number = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT); // Định dạng số với hai chữ số và thêm số 0 ở đầu nếu cần
                @endphp {{ $number }}</td>
                <td>{{ $nd['tentheloai'] }}</td>
                <td><a href="/Administrator/qltheloai/xoatheloai&{{ $nd['id'] }}-tl"
                        class="btn btn-outline-danger delete-link" >Xóa</a>
                    <span> | </span>
                    <a href="/Administrator/qltheloai/suatheloai&{{ $nd['id'] }}-tl" class="btn btn-outline-warning ">Sửa</a>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
@endif
@include('layoutsAdmin.bottom')
