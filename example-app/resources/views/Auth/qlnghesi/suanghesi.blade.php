@include('layouts.top')
		@if (Auth::guard('web')->check())
        <div class="row" >
            <div class="col-12 col-md-10 m-auto">
              <div class="card p-5">
                <div class="card-header">          
                  <h4 class="text-info text-center">Sửa nghệ sĩ</h4> 
                </div>
                <div class="card-body">
                  <form method="post"  action="/Administrator/qlnghesi/suanghesi">
                    @csrf
                     @method('put')
                      <input type="hidden" name="txtidnghesi" value="{{  $nghesi->id  }}" >
                    <div class="my-3">
                    <label class="form-label">Tên nghệ sĩ</label>
                    <input class="form-control" type="text" name="txttennghesi" placeholder="Tên nghệ sĩ" value="{{ $nghesi->tennghesi }}" required></div>
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
@include('layouts.bottom')