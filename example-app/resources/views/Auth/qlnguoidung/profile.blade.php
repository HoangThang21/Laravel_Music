@include('layoutsAdmin.top')
		@if (Auth::guard('api')->check())
        <div class="row" >
            <div class="col-12 col-md-10 m-auto">
              <div class="card p-5">
                <div class="card-header">          
                  <h4 class="text-info text-center">HỒ SƠ NGƯỜI DÙNG</h4> 
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data" action="/Administrator/suand">
                    @csrf
                     @method('put')
                      <input type="hidden" name="txtiduser" value="{{  $ttnguoidung->id  }}" >
                      <input type="hidden" name="txthinhanhcu" value="{{ $ttnguoidung->image }}" >
                    <div class="text-center">
                      <img class="img-thumbnail" src="" alt="" width="100px">
                    </div>
                    <input type="hidden" name="txtid" value="">
                    <div class="my-3">    
                    <label class="form-label">Email</label>    
                    <input class="form-control" type="email" name="txtemail" placeholder="Email" value="{{ $ttnguoidung->email }}" readonly>
                    </div>
                              
                    <div class="my-3">
                    <label class="form-label">Họ tên</label>
                    <input class="form-control" type="text" name="txthoten" placeholder="Họ tên" value="{{ $ttnguoidung->name }}" required></div>
                    <div class="my-3">
                      <label class="form-label">Đổi hình đại diện</label>
                      <input class="form-control" type="file" name="fhinh" >
                    </div>
                    <div class="my-3 text-center">            
                    <input class="btn btn-primary"  type="submit" value="Cập nhật">
                    <a href="/Administrator" class="btn btn-warning">Không</a>
                    {{-- <input class="btn btn-warning"  type="reset" value="Không"> --}}
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
		@endif
@include('layoutsAdmin.bottom')