@include('layouts.top')
		@if (Auth::guard('web')->check())
        <div>
            <h3>Thêm nghệ sĩ</h3>
            <div>
              <form method="post" action="/Administrator/themns" enctype="multipart/form-data" >
                @csrf
                {{-- @method('POST') --}}
                <div class="my-3">
                  <input class="form-control"  type="text" name="txtnghesi" placeholder="Tên nghệ sĩ" required></div>
                <div class="my-3">
                {{-- <input type="hidden" name="action" value="xlthem" > --}}
                <input class="btn btn-primary"  type="submit" value="Thêm">
                <input class="btn btn-warning"  type="reset" value="Hủy"></div>
              </form>          
            </div>
                  
          
          </div>
		@endif
@include('layouts.bottom')