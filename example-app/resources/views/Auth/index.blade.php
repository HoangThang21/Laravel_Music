@include('layoutsAdmin.top')

@if (Auth::guard('api')->check())
				<!-- Nút mở hộp modal chứa form thêm mới -->
				<div class=""><i class="bi bi-filter-left"></i></div>
				<div><a class="btn btn-primary" href="/Administrator/themnguoidung"><span class="glyphicon glyphicon-plus"></span> Thêm người dùng</a></div>
		  
				<br>
				<div class="tableUser">
					@foreach ($user as $us)
					{{-- quyền nhân viên --}}
					@if ($ttnguoidung['quyen']==2)
						@if ($us['quyen']>2)
							
							<div class="the" style="background: #fff">
								<div class="imageUser">
									<img src="../../images/webicon.png" alt="">
									<div class="user_type" style="background-color: var(--color-<?php if ($us['quyen']==1) {echo 'admin';} else if ($us['quyen']==2){echo 'nhanvien';}else {echo 'user';}?>);">
									<?php if ($us['quyen']==1) {
										echo 'Admin';
									} else if ($us['quyen']==2){
										echo 'Nhân Viên';
									}else {
										echo 'Người dùng';
									}
									?></div>
									@if($us["quyen"]!=1) 
										<div class="chucnangUser">
											<i class="dotuser bi bi-three-dots-vertical" ></i>
											<div class="menu">
												<ul >
													@if($us["quyen"]!=1) 
														@if ($us["trangthai"]==1)
															<li><i class="bi bi-key-fill"></i>Khóa </li>
														@else
															<li><i class="bi bi-key-fill"></i>Mở Khóa </li>
														@endif
													@endif
													<li><i class="bi bi-trash-fill"></i> Xóa</li>
												</ul>
											</div>
										</div>
									@endif
								</div>
								<div class="infoUser">
									<div class="name">
										{{ $us['name'] }}
									</div>
									<div class="email">{{ $us['email'] }}</div>
								</div>
								@if($us["quyen"]!=1) 
									<div class="mandates">
										@if ($us["trangthai"]==1)
										<div class="trangthai">Trạng Thái: <span style="color:#15936b">Mở</span></div>
										@else
										<div class="trangthai">Trạng Thái: <span style="color:#8b1717">Khóa</span></div>
										@endif
										<div class="vipUser">Ngày hết hạn gói Prenium: Full</div>
									</div>
								@endif
								
			
							</div>
						@endif
						
					@endif
					{{-- quyền admin --}}
					@if ($ttnguoidung['quyen']==1)
					<div class="the" style="background: #fff">
						<div class="imageUser">
							<img src="../../images/webicon.png" alt="">
							<div class="user_type" style="background-color: var(--color-<?php if ($us['quyen']==1) {echo 'admin';} else if ($us['quyen']==2){echo 'nhanvien';}else {echo 'user';}?>);">
							<?php if ($us['quyen']==1) {
								echo 'Admin';
							} else if ($us['quyen']==2){
								echo 'Nhân Viên';
							}else {
								echo 'Người dùng';
							}
							?></div>
							@if($us["quyen"]!=1) 
								<div class="chucnangUser">
									<i class="dotuser bi bi-three-dots-vertical" ></i>
									<div class="menu">
										<ul >
											@if($us["quyen"]!=1) 
												@if ($us["trangthai"]==1)
													<li><i class="bi bi-key-fill"></i>Khóa </li>
												@else
													<li><i class="bi bi-key-fill"></i>Mở Khóa </li>
												@endif
											@endif
											<li><i class="bi bi-trash-fill"></i> Xóa</li>
										</ul>
									</div>
								</div>
							@endif
						</div>
						<div class="infoUser">
							<div class="name">
								{{ $us['name'] }}
							</div>
							<div class="email">{{ $us['email'] }}</div>
						</div>
						@if($us["quyen"]!=1) 
							<div class="mandates">
								@if ($us["trangthai"]==1)
								<div class="trangthai">Trạng Thái: <span style="color:#15936b">Mở</span></div>
								@else
								<div class="trangthai">Trạng Thái: <span style="color:#8b1717">Khóa</span></div>
								@endif
								<div class="vipUser">Ngày hết hạn gói Prenium: Full</div>
							</div>
						@endif
						
	
					</div>
					
					@endif	
					@endforeach
				</div>
		@endif
@include('layoutsAdmin.bottom')
