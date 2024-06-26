@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div class="row">
        <div class="col-12 col-md-10 m-auto">
            <div class="card p-5">
                <div class="card-header">
                    <h4 class="text-info text-center">Sửa nghệ sĩ :
                        @foreach ($user as $us)
                            @if ($nghesi['id_nghesi_user'] == $us['id'])
                                {{ $us['email'] }}
                            @endif
                        @endforeach
                        @foreach ($userapi as $usapi)
                            @if ($nghesi['idnghesi_userapi'] == $usapi['id'])
                                {{ $usapi['email'] }}
                            @endif
                        @endforeach

                    </h4>
                </div>
                <div>
                    @if ($loi != '')
                        <div class="text-danger p-2">{{ $loi }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="/Administrator/qlnghesi/suanghesi">
                        @csrf
                        
                        @foreach ($user as $us)
                            @if ($nghesi['id_nghesi_user'] == $us['id'])
                                <input type="hidden" name="txttype" value="user" readonly>
                            @endif
                        @endforeach
                        @foreach ($userapi as $usapi)
                            @if ($nghesi['idnghesi_userapi'] == $usapi['id'])
                                <input type="hidden" name="txttype" value="userapi" readonly>
                            @endif
                        @endforeach
                        <input type="hidden" name="txtidnghesi" value="{{ $nghesi->id }}" readonly>
                        <div class="my-3">
                            <label class="form-label">Tên nghệ sĩ</label>
                            <input class="form-control" type="text" name="txttennghesi" placeholder="Tên nghệ sĩ"
                                value="{{ $nghesi->tennghesi }}" required>
                        </div>
                        <div class="my-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="txtmota" id="" cols="30" rows="10" class="w-100">{{ $nghesi->mota }}</textarea>
                        </div>
                        <div class="my-3 text-center">
                            <input class="btn btn-primary" type="submit" value="Cập nhật">
                            <a href="/Administrator/qlnghesi" class="btn btn-warning">Không</a>
                            {{-- <input class="btn btn-warning"  type="reset" value="Không"> --}}
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endif
@include('layoutsAdmin.bottom')
