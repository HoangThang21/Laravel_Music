@include('layoutsAdmin.top')
		@if (Auth::guard('api')->check())
        <div>
            <h3>Thêm tài khoản người dùng</h3>
            <div>
              <form method="post" action="/Administrator/themnd" enctype="multipart/form-data" >
                @csrf
                {{-- @method('POST') --}}
                <div class="my-3">
                  <input class="form-control"  type="text" name="txthoten" placeholder="Họ tên" required></div>
                <div class="my-3">        
                <input class="form-control" type="email" name="txtemail" placeholder="Email" required>
                </div>
                <div class="my-3"><input class="form-control"  type="text" name="txtmatkhau" placeholder="Mật khẩu" required></div>
                <div class="my-3">        
                <input class="form-control" type="file" name="txthinh"  required>
                </div>
               
                <div class="my-3">
                <label>Chọn quyền</label>
                <select class="form-control" name="optloaind">                
                    <option value="1">Quản trị</option>
                    <option value="2" selected>Thành viên</option>
                    <option value="3">Khách hàng</option>
                </select></div>
                <div class="my-3">
                {{-- <input type="hidden" name="action" value="xlthem" > --}}
                <input class="btn btn-primary"  type="submit" value="Thêm">
                <input class="btn btn-warning"  type="reset" value="Hủy"></div>
              </form>          
            </div>
                  
          
          </div>
		@endif
@include('layoutsAdmin.bottom')