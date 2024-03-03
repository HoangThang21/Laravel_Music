@include('layoutsAdmin.top')
		@if (Auth::guard('api')->check())
        <div class="row" >
            <div class="col-12 col-md-10 m-auto">
              <div class="card p-5">
                <div class="card-header">          
                  <h4 class="text-info text-center">Sửa thể loại</h4> 
                </div>
                <div class="card-body">
                  <form method="post"  action="/Administrator/qltheloai/suatheloai">
                    @csrf
                     @method('put')
                      <input type="hidden" name="txtidtheloai" value="{{  $theloai->id  }}" >
                    <div class="my-3">
                    <label class="form-label">Tên thể loại</label>
                    <input class="form-control" type="text" name="txttentheloai" placeholder="Tên thể loại" value="{{ $theloai->tentheloai }}" required></div>
                    <div class="my-3 text-center">            
                    <input class="btn btn-primary"  type="submit" value="Cập nhật">
                    <a href="/Administrator/qltheloai" class="btn btn-warning">Không</a>
                    {{-- <input class="btn btn-warning"  type="reset" value="Không"> --}}
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
		@endif
@include('layoutsAdmin.bottom')