@include('layoutsAdmin.top')
@if (Auth::guard('api')->check())
				<!-- Nút mở hộp modal chứa form thêm mới -->
				<div><a class="btn btn-primary" href="/Administrator/themdanhmuc"><span class="glyphicon glyphicon-plus"></span> Thêm danh mục</a></div>
		  
				<br>
			  
				<!-- Danh sách người dùng -->
				<table class="table table-hover">
					  <tr>
					  <th>Tên</th>
					  <th>Hình</th>
                      <th>Chức năng</th>
					</tr>
					<?php foreach ($danhmuc as $dm): ?>
					  <tr><td>{{  $dm["tendanhmuc"] }}</td>
						  <td><img src="../../img/{{ $dm['hinh'] }}" width="80" class="img-thumbnail"></td>
						<?php 
                         echo ' <td><a href="/Administrator/'. $dm['id'] .'&suadm"><i class="bi bi-pencil bi-lg"></i> </a>|
                    <a href="/Administrator/'. $dm['id'] .'&xoadm"><i class="bi bi-trash bi-xl"></i></a></td></tr>';
					endforeach; ?>
                    
				</table>
			  
	
	   
		@endif
@include('layoutsAdmin.bottom')