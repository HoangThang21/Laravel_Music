@include('layouts.top')
<div class="ttuser-menu">
    <div class="top-ttuser">
        <div style="cursor: pointer;">
            <div id="imageContainer" class="imageContainer">
                <img id="imagePreview" src="../../images/{{ $ttnguoidung->image }}" alt="Preview Image">
                <div class="changeImageText" id="changeImageText"><i class="bi bi-camera"></i></div>
            </div>
        </div>

        <div class="ten-ttuser">{{ $ttnguoidung->name }}</div>
    </div>
    <div class="body-ttuser">
        <div class="top-body-ttuser">
            <div class="item-top-body-ttuser info-top-body-ttuser active">Thông tin</div>
            <div class=" item-top-body-ttuser changepass-top-body-ttuser">Đổi mật khẩu</div>
        </div>
        <div class="bottom-body-user">
            <form action="/changettuser" method="post" id="form-bottom-body-user-tt"enctype="multipart/form-data" class="form-bottom-body-user active">
                @csrf
                <input type="file" id="inputImage" name="inputImage" accept="image/*" style="display: none;">
                <div class="inputGroup">
                    <input type="text" id="txtname" name="txtname" required  autocomplete="off"
                        value="{{ $ttnguoidung->name }}">
                    <label for="txtname">Tên Người dùng</label>
                </div>

                <?php 
                    if (is_numeric($ttnguoidung->email)) {
                ?>
                 <div class="inputGroup activeamil">
                    <input type="text" id="txtemail" name="txtemail" readonly autocomplete="off"
                        value="{{ $ttnguoidung->email }}">
                    <label for="txtemail">Số điện thoại</label>
                </div>
                <div class="inputGroup">
                    <input type="text" id="txtsdt" name="txtsdt"  autocomplete="off"
                        value="{{ $ttnguoidung->sdt }}">
                    <label for="txtsdt">Email</label>
                </div>
                <?php }else{
                        ?>
                <div class="inputGroup activeamil">
                    <input type="text" id="txtemail" name="txtemail" readonly autocomplete="off"
                        value="{{ $ttnguoidung->email }}">
                    <label for="txtemail">Email</label>
                </div>
                <div class="inputGroup">
                    <input type="text" id="txtsdt" name="txtsdt"  autocomplete="off"
                        value="{{ $ttnguoidung->sdt }}">
                    <label for="txtsdt">Số điện thoại</label>
                </div>
                <?php   };?>
                <button type="submit">Lưu</button>
            </form>
            <form action="/changepassttuser" method="post" id="form-bottom-body-user-chane" class="form-bottom-body-user">
                @csrf
                <div class="inputGroup">
                    <input type="password" id="txtmkcu" name="txtmkcu" required autocomplete="off">
                    <label for="txtmkcu">Mật khẩu cũ</label>
                </div>
                <div class="inputGroup">
                    <input type="password" id="txtmkmoi" name="txtmkmoi" required autocomplete="off">
                    <label for="txtmkmoi">Mâtk khẩu mới</label>
                </div>
                <div class="inputGroup">
                    <input type="password" id="txtxnmkmoi" name="txtxnmkmoi" required autocomplete="off">
                    <label for="txtxnmkmoi">Xác nhận mật khẩu</label>
                </div>
                <button type="submit">Lưu</button>
            </form>
        </div>
    </div>
</div>
@include('layouts.bottom')
