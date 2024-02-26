@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
				<!-- Nút mở hộp modal chứa form thêm mới -->
				<div><a class="btn btn-primary" href="/Administrator/themnguoidung"><span class="glyphicon glyphicon-plus"></span> Thêm người dùng</a></div>
		  
				<br>
			  
				<!-- Danh sách người dùng -->
				<table class="table table-hover">
					  <tr>
					  <th>Tên người dùng</th>
					  <th>Hình</th>
					  <th>Họ tên</th>
					  <th>Loại quyền</th>
					 
					  <th>Trạng thái</th>
					  <th>Chức năng</th>
						<th></th>
					</tr>
					<?php foreach ($user as $nd): ?>
					  <tr><td>{{  $nd["email"] }}</td>
						  <td><img src="../../img/{{ $nd['image'] }}" width="80" class="img-thumbnail"></td>
						  <td>{{ $nd['name'] }}</td>
						  <td><?php if($nd["user_type"]==1) echo "Quản trị";elseif($nd["user_type"]==2) echo "Nhân viên"; else echo "Người dùng" ; ?></td>
						 
						  <td class="<?php if($nd["user_type"]!=1) {if($nd["status"]==1) echo "text-success"; else echo "text-danger" ; }?>"><?php if($nd["user_type"]!=1) {if($nd["status"]==1) echo "Đang hoạt động"; else echo "Khóa" ; }?></td>
						
						<td>

						<?php 
						if($nd["user_type"]!=1) {
						  if($nd["status"]==1){ ?>
							<a  href="/Administrator/{{ $nd["id"] }}&0&users">Khóa</a></td>
							<td><a href="/Administrator/{{ $nd["id"] }}&userde">Xóa</a></td></tr>
						  <?php 
						  }
						  else { ?>
							<a  href="/Administrator/{{ $nd["id"] }}&1&users">Bỏ khóa</a></td>
							<td><a href="/Administrator/{{ $nd["id"] }}&userde">Xóa</a></td></tr>
						<?php 
						  }
						}
						
					
					endforeach; ?>
				</table>
			  
	
	   
		@endif
@include('layoutsAdmin.bottom')