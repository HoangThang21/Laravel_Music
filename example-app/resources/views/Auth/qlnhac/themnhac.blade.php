@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Thêm nhạc</h3>
        <div>
            <form method="post" action="/Administrator/qlnhac/themmusic" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}
                <div class="my-3">
                    @if ($loi != '')
                        <div class="text-danger p-2">{{ $loi }}</div>
                    @endif
                </div>
                <div class="my-3">
                    <input class="form-control" type="text" name="txttennhac" placeholder="Tên nhạc" required>
                </div>
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
                        @foreach ($nghesi as $ns)
                            @foreach ($album as $alb)
                                @if ($ns->id == $alb->nghesi_idalbum)
                                    <option value="{{ $alb->id }}">{{ $alb->tenalbum }} ( {{ $ns->tennghesi }} )
                                    </option>
                                @endif
                            @endforeach
                        @endforeach

                    </select>
                </div>
                <div class="my-3">
                    <label class="form-label">Mã nhạc</label>
                    <input class="form-control" type="number" name="txtmanhac" required>
                </div>
                <div class="my-3">
                    <label class="form-label">Giá</label>
                    <input class="form-control" type="number" name="txtgia" required>
                </div>
                <div class="my-3">
                    <label class="form-label">Lyric</label>
                    <textarea id="default" name="txtmotalyric" class="editor" cols="30" rows="10">
                            
                        </textarea>

                </div>




                <div class="my-3">
                    {{-- <input type="hidden" name="action" value="xlthem" > --}}
                    <input class="btn btn-primary" type="submit" value="Thêm">
                    <input class="btn btn-warning" type="reset" value="Hủy">
                </div>
            </form>
        </div>


    </div>
@endif
@include('layoutsAdmin.bottom')
