@include('layoutsAdmin.top')

@if (Auth::guard('api')->check())
				<!-- Nút mở hộp modal chứa form thêm mới -->
				<div class="infofilter">
					
					<form action="/Administrator/search" method="post" id="searchForm">
						@csrf
						<div class="searchbar">
							<div class="searchbar-wrapper">
								
						
								<div class="searchbar-center">
									<div class="searchbar-input-spacer"></div>
						
									<input type="text"name='searchbar_input' class="searchbar-input" maxlength="2048"  placeholder="Tìm kiếm tên người dùng hoặc email">
								</div>
								<div class="searchbar-left">
									<div class="delete-icon-wrapper">
										<i class="bi bi-x-lg"></i>
									</div>|
									<div class="search-icon-wrapper">
										
										<div class="searchicon" id="searchButton"><i class="bi bi-search"></i></div>
									</div>
								</div>
							</div>
					</div>
					</form>
					
				<div><a class="btn btn-primary" href="/Administrator/themnguoidung"><span class="glyphicon glyphicon-plus"></span> Thêm người dùng</a></div>
		  
				<br>
				{{-- search --}}
				@if ($usersearch!="")
				<div class="tableUser" id="user-container">
					@foreach ($usersearch as $us)
									{{-- quyền nhân viên --}}	
								@if ($ttnguoidung['quyen']==2)
									@if ($us['quyen']>2)
										<div id="infolo">
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
																			<li><a href=""><i class="bi bi-key-fill"></i>Khóa </a></li>
																		@else
																			<li><a href=""><i class="bi bi-key-fill"></i>Mở Khóa</a> </li>
																		@endif
																	@endif
																	<li><a href=""><i class="bi bi-trash-fill"></i> Xóa</a></li>
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
										</div>
									@endif
									
								@endif
								{{-- quyền admin --}}
								@if ($ttnguoidung['quyen']==1)
								<div id="infolo">
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
																	<li><a href=""><i class="bi bi-key-fill"></i>Khóa </a></li>
																@else
																	<li><a href=""><i class="bi bi-key-fill"></i>Mở Khóa</a> </li>
																@endif
															@endif
															<li><a href=""><i class="bi bi-trash-fill"></i> Xóa</a></li>
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
								</div>
							
								@endif	
					
					@endforeach
				</div>
				{{-- end search--------------------------------------------------------------- --}}
				@else
					<div class="tableUser" id="user-container">
						@foreach ($user as $us)
							@if ($ttnguoidung['quyen']==2)
								@if ($us['quyen']>2)
								{{-- quyền nhân viên --}}
								<div id="infolo">
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
																	<li><a href=""><i class="bi bi-key-fill"></i>Khóa </a></li>
																@else
																	<li><a href=""><i class="bi bi-key-fill"></i>Mở Khóa</a> </li>
																@endif
															@endif
															<li><a href=""><i class="bi bi-trash-fill"></i> Xóa</a></li>
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
								</div>
								@endif
							@endif
								{{-- quyền admin --}}
							@if ($ttnguoidung['quyen']==1)
								<div id="infolo">
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
																	<li><a href=""><i class="bi bi-key-fill"></i>Khóa </a></li>
																@else
																	<li><a href=""><i class="bi bi-key-fill"></i>Mở Khóa </a></li>
																@endif
															@endif
															<li><a href=""><i class="bi bi-trash-fill"></i> Xóa</a></li>
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
								</div>

							@endif	
									
						@endforeach
					</div>
				@endif
				
		@endif
@include('layoutsAdmin.bottom')
