@include('layouts.top')
		@if (Auth::guard('web')->check())
        <div>
           <h3>Nghệ sĩ</h3>
           <div><a class="btn btn-primary" href="/Administrator/qlnghesi/themnghesi"><span class="glyphicon glyphicon-plus"></span> Thêm nghệ sĩ</a></div>
		  
           <br>
         
           <!-- Danh sách người dùng -->
           <table class="table table-hover">
                 <tr>
                 <th>Tên nghệ sĩ</th> 
                 <th>Chức năng</th>
                 <th></th>
                </tr>
               <?php foreach ($nghesi as $nd): ?>
                 <tr>
                     <td>{{ $nd['tennghesi'] }}</td>
                     <td><a href="/Administrator/qlnghesi/xoanghesi&{{ $nd['id'] }}-ns" class="text-danger">Xóa</a>
                            <span> | </span>
                         <a href="/Administrator/qlnghesi/suanghesi&{{ $nd['id'] }}-ns" class="text-warning">Sửa</a>
                    </td>
                 </tr>    
                   
               
                 <?php endforeach; ?>
           </table>
          
          </div>
		@endif
@include('layouts.bottom')