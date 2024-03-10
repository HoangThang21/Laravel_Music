@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Thêm nghệ sĩ</h3>
        <div>
            <form method="post" action="/Administrator/qlnghesi/themns" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}
                <div class="my-3">
                    @if ($loi != '')
                        <div class="text-danger p-2">{{ $loi }}</div>
                    @endif
                </div>
                <div class="my-3">
                    <input class="form-control" type="text" name="txtnghesi" placeholder="Tên nghệ sĩ" required>
                </div>
                <div class="my-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="txtmota" id="" cols="30" rows="10" class="w-100"></textarea>
                </div>


                <div class="my-3">
                    <label>Chọn Email để xác nhận làm nghệ sĩ</label>
                    <input class="m-3" type="text" id="your-input" placeholder="Nhập Email">
                    <select class="form-control mt-3 " name="optloains" id="suggestions">
                    </select>
                </div>
                <div class="my-3">
                    {{-- <input type="hidden" name="action" value="xlthem" > --}}
                    <input class="btn btn-primary" type="submit" value="Thêm">
                    <input class="btn btn-warning" type="reset" value="Hủy">
                    <a href="/Administrator/qlnghesi" class="btn btn-warning">Không thêm</a>
                </div>
            </form>
        </div>


    </div>
@endif
@include('layoutsAdmin.bottom')
