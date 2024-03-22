@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
    <div>
        <h3>Gửi email</h3>
        <div>
            <form method="post" action="/Administrator/sendmail" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}

                <div class="my-3">
                    <input class="form-control" type="text" name="txtemail" value="{{ $user->email }}" readonly>
                </div>
                <div class="my-3 ">
                    
                    <textarea id="default" name="txtmota" class="editor" cols="30" rows="10">
                        
                    </textarea>
                </div>



                <div class="my-3">
                    {{-- <input type="hidden" name="action" value="xlthem" > --}}
                    <input class="btn btn-primary" type="submit" value="Gửi">
                    <input class="btn btn-warning" type="reset" value="Hủy">

                </div>
            </form>
        </div>


    </div>
@endif
@include('layoutsAdmin.bottom')
