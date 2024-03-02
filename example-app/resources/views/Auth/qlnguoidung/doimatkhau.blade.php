@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Đổi mật khẩu người dùng</h3>
        <div>
            <form method="post" action="/Administrator/doimatkhaund" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}
                <input type="hidden" name ='iduser'value="{{ $ttnguoidung->id }}">
                <div class="my-3">
                    <input class="form-control" type="password" name="txtpascu" placeholder="Mật khẩu cũ" required>
                </div>
                <div class="my-3"><input class="form-control " type="password" name="txtmatkhaumoi"
                        placeholder="Mật khẩu mới" required></div>
                <div class="my-3"><input class="form-control " type="password" name="txtmatkhaumoixn"
                        placeholder="Xác nhận mật khẩu mới" required></div>
                <div class="my-3">
                    @if ($loi != null)
                        <span class="text-danger">{{ $loi }}<br></span>
                    @endif
                    {{-- <input type="hidden" name="action" value="xlthem" > --}}
                    <input class="btn btn-primary" type="submit" value="Đổi">
                    <input class="btn btn-warning" type="reset" value="Hủy">
                </div>
            </form>
        </div>


    </div>
@endif
@include('layoutsAdmin.bottom')
