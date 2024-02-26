@include('layoutsAdmin.top')
		@if (Auth::guard('api')->check())
        <div>
            <h3>Thêm tài danh mục</h3>
            <div>
              <form method="post" action="/Administrator/themdm" enctype="multipart/form-data" >
                @csrf
                {{-- @method('POST') --}}
                <div class="my-3">
                  <input class="form-control"  type="text" name="txttendanhmuc" placeholder="Tên danh mục" required></div>
                <div class="my-3">        
                <input class="form-control" type="file" name="txthinh"  required>
                </div>
               
                
                <div class="my-3">
                {{-- <input type="hidden" name="action" value="xlthem" > --}}
                <input class="btn btn-primary"  type="submit" value="Thêm">
                <input class="btn btn-warning"  type="reset" value="Hủy"></div>
              </form>          
            </div>
                  
          
          </div>
		@endif
@include('layoutsAdmin.bottom')