@include('layouts.top')
<div class="ttuser-menu">
    <div class="top-ttuser">
        <div style="cursor: pointer;">
            <div id="imageContainer" class="imageContainer">
                <img id="imagePreview" src="../../images/{{ $ttnguoidung->image }}" alt="Preview Image">
                <div class="changeImageText" id="changeImageText"><i class="bi bi-camera"></i></div>
            </div>
        </div>

        <div class="ten-ttuser">name</div>
    </div>
    <div class="body-ttuser">
        <div class="top-body-ttuser">
            <div class="item-top-body-ttuser info-top-body-ttuser active">Thông tin</div>
            <div class=" item-top-body-ttuser changepass-top-body-ttuser">Đổi mật khẩu</div>
        </div>
        <div class="bottom-body-user">
            <form action="#" method="post" class="form-bottom-body-user">
                @csrf
                <input type="file" id="inputImage" accept="image/*" style="display: none;">
                <div class="inputGroup">
                    <input type="text" id="txtname" name="txtname" required="" autocomplete="off">
                    <label for="txtname">Tên Người dùng</label>
                </div>
                <div class="inputGroup">
                    <input type="text" id="txtemail" name="txtemail" required="" autocomplete="off">
                    <label for="txtemail">Email</label>
                </div>
                <div class="inputGroup">
                    <input type="text" id="txtsdt" name="txtsdt" required="" autocomplete="off">
                    <label for="txtsdt">Số điện thoại</label>
                </div>
                <button type="submit">Lưu</button>
            </form>
            <form action="#" method="post" class="form-bottom-body-user">
                @csrf
                <div class="inputGroup">
                    <input type="text" id="txtmkcu" name="txtmkcu" required="" autocomplete="off">
                    <label for="txtmkcu">Mật khẩu cũ</label>
                </div>
                <div class="inputGroup">
                    <input type="text" id="txtmkmoi" name="txtmkmoi" required="" autocomplete="off">
                    <label for="txtmkmoi">Mâtk khẩu mới</label>
                </div>
                <div class="inputGroup">
                    <input type="text" id="txtxnmkmoi" name="txtxnmkmoi" required="" autocomplete="off">
                    <label for="txtxnmkmoi">Xác nhận mật khẩu</label>
                </div>
                <button type="submit">Lưu</button>
            </form>
        </div>
    </div>
</div>
@include('layouts.bottom')
