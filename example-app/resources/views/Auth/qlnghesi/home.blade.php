@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Nghệ sĩ</h3>
        <div class="infofilter">

            <div><a class="btn btn-primary" href="/Administrator/qlnghesi/themnghesi"><span
                        class="glyphicon glyphicon-plus"><i class="bi bi-plus-circle"></i></span> Thêm nghệ sĩ</a></div>
            <div class="fillter">


                <form action="/Administrator/qlnghesi/searchns?=" method="post" id="searchForm">
                    @csrf
                    <div class="searchbar">
                        <div class="searchbar-wrapper">


                            <div class="searchbar-center">
                                <div class="searchbar-input-spacer"></div>

                                <input type="text"name='searchbar_input' class="searchbar-input" maxlength="2048"
                                    @if ($searchbarinput) value="{{ $searchbarinput }}"
                                @else
                                placeholder="Tìm kiếm tên nghệ sĩ hoặc email" @endif>

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
        </div>

        <br>

        <!-- Danh sách người dùng -->
        <table class="table table-hover">
            <tr>

                <th>Hình</th>
                <th>Tên nghệ sĩ</th>
                <th>Email</th>
                <th>Mô tả</th>
                <th>Chức năng</th>
            </tr>
            <?php foreach ($nghesi as $nd): ?>
            @foreach ($user as $us)
                @if ($us['quyen'] == 4)
                    @if ($nd['id_nghesi_user'] == $us['id'])
                        <tr>
                            <td><img width="50" height="50" src="../../images/{{ $us['image'] }}"
                                    alt="">
                            </td>
                            <td>{{ $nd['tennghesi'] }}</td>
                            <td>{{ $us['email'] }}</td>
                            <td class="motanghesi">
                                <textarea draggable="false" name="" id="" readonly> {{ $nd['mota'] }}</textarea>
                            </td>
                            <td><a href="/Administrator/qlnghesi/xoanghesi&{{ $nd['id'] }}-ns"
                                    class="btn btn-outline-danger delete-link"> <i class="bi bi-trash3"></i> Xóa</a>
                                <span> | </span>
                                <a href="/Administrator/qlnghesi/suanghesi&{{ $nd['id'] }}-ns"
                                    class="btn btn-outline-warning"><i class="bi bi-arrow-repeat"></i>Sửa</a>
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
            <?php endforeach; ?>
        </table>
    </div>
@endif
@include('layoutsAdmin.bottom')
