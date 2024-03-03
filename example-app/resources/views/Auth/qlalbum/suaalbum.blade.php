@include('layouts.top')
		@if (Auth::guard('web')->check())
    <div class="row" >
      <div class="col-12 col-md-10 m-auto">
        <div class="card p-5">
          <div class="card-header">          
            <h4 class="text-info text-center">Sửa album</h4> 
          </div>
          <div class="card-body">
            <form method="post"  action="/Administrator/qlalbum/suaalbum">
              @csrf
               @method('put')
                <input type="hidden" name="txtidalbum" value="{{  $album->id  }}" >
              <div class="my-3">
              <label class="form-label">Tên album</label>
              <input class="form-control" type="text" name="txttenalbum" placeholder="Tên album" value="{{ $album->tenalbum }}" required></div>
              <div class="my-3">
              <label class="form-label">Năm phát hành</label>
              <input class="form-control" type="text" name="txtnamphathanh" placeholder="Năm phát hành" value="{{ $album->namphathanh	 }}" required></div>
              
              <div class="my-3">
                <label>Chọn nghệ sĩ album</label>
                <select class="form-control" name="optloains">
                  @foreach ($nghesi as $ns)
                    @if ($ns->id==$album->nghesi_idalbum)
                      <option value="{{ $ns->id }}">{{ $ns->tennghesi }}</option>
                    @endif
                  @endforeach 
                    @foreach ($nghesi as $ns)
                      @if ($ns->id!=$album->nghesi_idalbum)
                        <option value="{{ $ns->id }}">{{ $ns->tennghesi }}</option>
                      @endif
                    @endforeach              
                </select>
              </div>
              <div class="my-3">
                  <label>Chọn thể loại</label>
                  <select class="form-control" name="optloaitl">  
                    @foreach ($theloai as $ns)
                      @if ($ns->id==$album->theloai_idalbum)
                        <option value="{{ $ns->id }}">{{ $ns->tentheloai }}</option>
                      @endif
                    @endforeach 
                    @foreach ($theloai as $ns)
                      @if ($ns->id!=$album->theloai_idalbum)
                        <option value="{{ $ns->id }}">{{ $ns->tentheloai }}</option>
                      @endif
                    @endforeach 
                                  
                  </select>
              </div>
              
              
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