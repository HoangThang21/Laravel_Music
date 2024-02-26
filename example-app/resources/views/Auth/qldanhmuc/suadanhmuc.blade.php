@include('layoutsAdmin.top')
		@if (Auth::guard('api')->check())
        <div>
            <h3>Sửa danh mục</h3>
            <div>
              <form method="post" action="/Administrator/suamdm" enctype="multipart/form-data" >
                @csrf
                {{-- @method('POST') --}}
                <input type="hidden" name="iddanhmuc" value="{{ $danhmuc->id }}">
                <div class="my-3">
                  <input class="form-control"  type="text" name="txttendanhmuc" placeholder="Tên danh mục" value="{{ $danhmuc->tendanhmuc }}" required></div>
                <div class="my-3">        
                <input class="form-control" type="file" name="txthinh"  >
                </div>
               
                
                <div class="my-3">
                {{-- <input type="hidden" name="action" value="xlthem" > --}}
                <input class="btn btn-primary"  type="submit" value="Sửa">
                <input class="btn btn-warning"  type="reset" value="Hủy"></div>
              </form>          
            </div>
                  
          
          </div>
		@endif
@include('layoutsAdmin.bottom')