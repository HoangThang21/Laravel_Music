@include('layouts.top')
		@if (Auth::guard('web')->check())
        <div>
            <h3>Album</h3>
            <div><a class="btn btn-primary" href="/Administrator/qlalbum/themalbum"><span class="glyphicon glyphicon-plus"></span> Thêm album</a></div>
		  
            <br>
          
            <!-- Danh sách người dùng -->
            <table class="table table-hover">
                  <tr>
                  <th>Tên album</th> 
                  <th>Năm phát hành</th> 
                  <th>Nghệ sĩ album</th>
                  <th>Thể loại album</th>
                  <th>Chức năng</th>
                 </tr>
                <?php foreach ($album as $nd): ?>
                  <tr>
                      <td>{{ $nd['tenalbum'] }}</td>
                      <td>{{ $nd['namphathanh'] }}</td>
                      <?php foreach ($nghesi as $ns): 
                        if($nd['nghesi_idalbum']==$ns['id']){
                      ?>
                      <td>{{ $ns['tennghesi'] }}</td>
                      <?php } endforeach; ?>
                      <?php foreach ($theloai as $tl): 
                        if($nd['theloai_idalbum']==$tl['id']){
                      ?>
                      <td>{{ $tl['tentheloai'] }}</td>
                      <?php } endforeach; ?>
                      
                      <td><a href="/Administrator/qlalbum/xoaalbum&{{ $nd['id'] }}-alb" class="text-danger">Xóa</a>
                             <span> | </span>
                          <a href="/Administrator/qlalbum/suaalbum&{{ $nd['id'] }}-alb" class="text-warning">Sửa</a>
                     </td>
                  </tr>    
                    
                
                  <?php endforeach; ?>
            </table>
          
          </div>
		@endif
@include('layouts.bottom')