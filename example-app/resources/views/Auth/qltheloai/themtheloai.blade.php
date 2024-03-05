@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Thêm thể loại</h3>
        <div>
            <form method="post" action="/Administrator/themtl" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}
                <div class="my-3">
                    @if ($loi != '')
                        <div class="text-danger p-2">{{ $loi }}</div>
                    @endif
                </div>
                <div class="my-3">
                    <input class="form-control" type="text" name="txttheloai" placeholder="Tên thể loại" required>
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
