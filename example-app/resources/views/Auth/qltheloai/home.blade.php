@include('layoutsAdmin.top')
		@if (Auth::guard('api')->check())
        <div>
           <h3>Thể loại</h3>
           <div><a class="btn btn-primary" href="/Administrator/qltheloai/themtheloai"><span class="glyphicon glyphicon-plus"></span> Thêm thể loại</a></div>
		  
           <br>
         
           <!-- Danh sách người dùng -->
           <table class="table table-hover">
                 <tr>
                 <th>Tên thể loại</th> 
                 <th>Chức năng</th>
                 <th></th>
                </tr>
               <?php foreach ($theloai as $nd): ?>
                 <tr>
                     <td>{{ $nd['tentheloai'] }}</td>
                     <td><a href="/Administrator/qltheloai/xoatheloai&{{ $nd['id'] }}-tl" class="text-danger">Xóa</a>
                            <span> | </span>
                         <a href="/Administrator/qltheloai/suatheloai&{{ $nd['id'] }}-tl" class="text-warning">Sửa</a>
                    </td>
                 </tr>    
                   
               
                 <?php endforeach; ?>
           </table>
          
          </div>
		@endif
@include('layoutsAdmin.bottom')