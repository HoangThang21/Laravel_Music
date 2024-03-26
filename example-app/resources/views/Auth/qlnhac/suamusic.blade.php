@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Sửa nhạc</h3>
        <div class="my-3">
          @if ($loi != '')
              <div class="text-danger p-2">{{ $loi }}</div>
          @endif
      </div>
        <div>
            <form method="post" action="/Administrator/qlnhac/suanhac" enctype="multipart/form-data">
                @csrf
                @method('put')
                {{-- @method('POST') --}}
                <input class="form-control" type="hidden" name="txtidnhac" value="{{ $music->id }}">

                <div class="my-3">
                    <input class="form-control" type="text" name="txttennhac" placeholder="Tên nhạc" required
                        value="{{ $music->tennhac }}">
                </div>
                <div class="my-3">
                    <label class="form-label">Music</label>
                    <input class="form-control" type="file" name="fnhac" accept=".mp3">
                </div>
                <div class="my-3">
                    <label class="form-label">Hình music</label>
                    <input class="form-control" type="file" name="fhinh">
                </div>
                <div class="my-3">
                    <label>Chọn tên album</label>
                    <select class="form-control" name="optloains">

                        @foreach ($album as $ns)
                            @if ($ns->id == $music->album_idnhac)
                                <option value="{{ $ns->id }}">{{ $ns->tenalbum }}</option>
                            @endif
                        @endforeach
                        @foreach ($album as $ns)
                            @if ($ns->id != $music->album_idnhac)
                                <option value="{{ $ns->id }}">{{ $ns->tenalbum }}</option>
                            @endif
                        @endforeach


                    </select>
                </div>
                <div class="my-3">
                    <label class="form-label">Mã nhạc</label>
                    <input class="form-control" type="number" name="txtmanhac" value="{{ $music->maNhac }}" required>
                </div>
                <div class="my-3">
                    <label class="form-label">Giá</label>
                    <input class="form-control" type="number" name="txtgia"value="{{ $music->gia }}" required>
                </div>
                <div class="my-3">
                    <label>Chọn vip</label>
                    <select class="form-control" name="optloaiphi">
                        <option value="0" @if ($music->vip==0)
                            {{ 'selected' }}
                        @endif>Miễn phí</option>
                        <option value="1" @if ($music->vip==1)
                            {{ 'selected' }}
                        @endif>Vip</option>
                    </select>
                </div>
                <div class="my-3">
                    <label class="form-label">Lyric</label>
                    <textarea id="default" name="txtmotalyric" class="editor" cols="30" rows="10">
                    {{ $music->lyric }}
                  </textarea>

                </div>




                <div class="my-3">
                    {{-- <input type="hidden" name="action" value="xlthem" > --}}
                    <input class="btn btn-primary" type="submit" value="Cập nhật">
                    <input class="btn btn-warning" type="reset" value="Hủy">
                </div>
            </form>
        </div>


    </div>
@endif
@include('layoutsAdmin.bottom')
