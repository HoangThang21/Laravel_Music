@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Sửa tài khoản người dùng</h3>
        <div>
            <form method="post" action="/Administrator/suanguoidungbt" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}
                <input type="hidden" name="idnguoidung" value="{{ $user->id }}" readonly>
                <input type="hidden" name="idnguoidungselect" value="{{ $userbt ? $userbt : $usergg }}" readonly>
                <div class="my-3"><input class="form-control" type="text" name="txtmatkhau" placeholder="Mật khẩu">
                </div>
                <div class="my-3">
                    <label>Chọn Vip</label>
                    <select class="form-control" name="optloaindvip">
                        <option value="0"@if ($user->vip == '0') {{ 'selected' }} @endif>Không có Vip
                        </option>
                        <option value="1"@if ($user->vip == '1') {{ 'selected' }} @endif>Có Vip
                        </option>
                    </select>
                </div>


                <div class="my-3">
                    <label>Chọn quyền</label>
                    <select class="form-control" name="optloaind">
                        <option value="3"@if ($user->quyen == '3') {{ 'selected' }} @endif>Khách hàng
                        </option>
                        <option value="4"@if ($user->quyen == '4') {{ 'selected' }} @endif>Nhà sáng tác
                        </option>
                        <option value="2">Nhân viên
                        </option>
                    </select>
                </div>
                <div class="my-3">
                    {{-- <input type="hidden" name="action" value="xlthem" > --}}
                    <input class="btn btn-primary" type="submit" value="Sửa">
                    <input class="btn btn-warning" type="reset" value="Hủy">
                </div>
            </form>
        </div>


    </div>
@endif
@include('layoutsAdmin.bottom')
