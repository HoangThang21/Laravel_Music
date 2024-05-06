@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Album</h3>
        <div class="infofilter">
            <div><a class="btn btn-primary" href="/Administrator/qlalbum/themalbum"><span
                        class="glyphicon glyphicon-plus"><i class="bi bi-plus-circle"></i></span> Thêm album</a></div>
            <form action="/Administrator/qlalbum/searchal?=" method="post" id="searchForm">
                @csrf
                <div class="searchbar">
                    <div class="searchbar-wrapper">


                        <div class="searchbar-center">
                            <div class="searchbar-input-spacer"></div>

                            <input type="text"name='searchbar_input' class="searchbar-input" maxlength="2048"
                                @if ($searchbarinput) value="{{ $searchbarinput }}"
                                    @else
                                    placeholder="Tìm kiếm tên album, năm phát hành, nghệ sĩ, thể loại" @endif>

                        </div>
                        <div class="searchbar-left">
                            <div class="delete-icon-wrapper">
                                <i class="bi bi-x-lg"></i>
                            </div>|
                            <div class="search-icon-wrapper">

                                <div class="searchicon" id="searchButton"><i class="bi bi-search"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>

        <!-- Danh sách người dùng -->
        <table class="table table-hover">
            <tr>
                <th>STT</th>
                <th>Hình</th>
                <th>Tên album</th>
                <th>Năm phát hành</th>
                <th>Nghệ sĩ </th>
                <th>Thể loại</th>
                <th>Chức năng</th>

            </tr>
            @foreach ($album as $nd)
                <tr>
                    <td>@php
                        $number = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT); // Định dạng số với hai chữ số và thêm số 0 ở đầu nếu cần
                    @endphp {{ $number }}</td>
                    <td><img src="../../images/{{ $nd['hinhalbum'] }}" width="80" class="img-thumbnail"></td>
                    <td>{{ $nd['tenalbum'] }}</td>
                    <td>{{ $nd['namphathanh'] }}</td>
                    <?php foreach ($nghesi as $ns): 
                        if($nd['nghesi_idalbum']==$ns['id']){
                      ?>
                    <td>{{ $ns['tennghesi'] }}</td>
                    <?php } endforeach; ?>
                    <?php foreach ($theloai as $tl): 
                        if($nd['theloai_idalbum']==$tl['id']){
                      ?>
                    <td>{{ $tl['tentheloai'] }}</td>
                    <?php } endforeach; ?>

                    <td><a href="/Administrator/qlalbum/xoaalbum&{{ $nd['id'] }}-alb" class="btn btn-outline-danger delete-link mb-2"> <i class="bi bi-trash3"></i> Xóa</a>
                        <span> | </span>
                        <a href="/Administrator/qlalbum/suaalbum&{{ $nd['id'] }}-alb" class="btn btn-outline-warning mb-2"><i class="bi bi-arrow-repeat"></i>Sửa</a>
                        <span> | </span>
                        <a href="/Administrator/qlalbum/xemalbum&{{ $nd['id'] }}-alb" class="btn btn-outline-info"><i class="bi bi-eye-fill"></i>Xem</a>
                    </td>

                </tr>
            @endforeach
        </table>

    </div>
@endif
@include('layoutsAdmin.bottom')
