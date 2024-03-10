@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Thêm album</h3>
        <div>
            <div>
                @if ($loi != '')
                    <div class="text-danger p-2">{{ $loi }}</div>
                @endif
            </div>
            <form method="post" action="/Administrator/qlalbum/themalb" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}
                <div class="my-3">
                    <input class="form-control" type="text" name="txttenalbum" placeholder="Tên album" required>
                </div>
                <div class="my-3">
                    <input class="form-control" type="number" name="txtnamphathanh" placeholder="Năm phát hành"
                        required>
                </div>
                <div class="my-3">
                    <label>Chọn nghệ sĩ album</label>
                    <select class="form-control" name="optloains">

                        @foreach ($nghesi as $ns)
                            <option value="{{ $ns->id }}">{{ $ns->tennghesi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-3">
                    <label>Chọn thể loại</label>
                    <select class="form-control" name="optloaitl">
                        @foreach ($theloai as $ns)
                            <option value="{{ $ns->id }}">{{ $ns->tentheloai }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="my-3">
                    {{-- <input type="hidden" name="action" value="xlthem" > --}}
                    <input class="btn btn-primary" type="submit" value="Thêm">
                    <input class="btn btn-warning" type="reset" value="Hủy">
                </div>
            </form>
        </div>


    </div>
@endif
@include('layoutsAdmin.bottom')
