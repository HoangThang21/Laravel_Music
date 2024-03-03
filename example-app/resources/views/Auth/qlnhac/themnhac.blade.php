@include('layouts.top')
		@if (Auth::guard('web')->check())
        <div>
            <h3>Thêm nhạc</h3>
            <div>
              <form method="post" action="/Administrator/themnhac" enctype="multipart/form-data" >
                @csrf
                {{-- @method('POST') --}}

                <div class="my-3">
                  <input class="form-control"  type="text" name="txttennhac" placeholder="Tên nhạc" required></div>
                  <div class="my-3">
                    <label class="form-label">Music < 40mb </label>
                    <input class="form-control" type="file" name="fnhac" accept=".mp3" required>
                </div>
                <div class="my-3">
                    <label class="form-label">Hình music</label>
                    <input class="form-control" type="file" name="fhinh" required>
                </div>
                <div class="my-3">
                    <label>Chọn tên album</label>
                    <select class="form-control" name="optloains">
                       
                        @foreach ($album as $ns)
                            <option value="{{ $ns->id }}">{{ $ns->tenalbum }}</option>
                        @endforeach              
                    </select>
                </div>
                
              
                  

                <div class="my-3">
                {{-- <input type="hidden" name="action" value="xlthem" > --}}
                <input class="btn btn-primary"  type="submit" value="Thêm">
                <input class="btn btn-warning"  type="reset" value="Hủy"></div>
              </form>          
            </div>
                  
          
          </div>
		@endif
@include('layouts.bottom')