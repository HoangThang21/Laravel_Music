@include('layoutsAdmin.top')
<div class="">
  
</div>
		@if (Auth::guard('api')->check())
        <div>
            <h3>Nhạc</h3>
            <div class="infofilter">
              <div><a class="btn btn-primary" href="/Administrator/qlnhac/themnhac"><span class="glyphicon glyphicon-plus"></span> Thêm nhạc</a></div>
              <form action="/Administrator/qlnhac/searchs?=" method="post" id="searchForm">
                  @csrf
                  <div class="searchbar">
                      <div class="searchbar-wrapper">
                          <div class="searchbar-center">
                              <div class="searchbar-input-spacer"></div>
                              <input type="text"name='searchbar_input' class="searchbar-input" maxlength="2048"
                                  @if ($searchbarinput) value="{{ $searchbarinput }}"
                                      @else
                                      placeholder="Tìm kiếm tên nhạc" @endif>
  
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
          </div>
            <br>
          
            <!-- Danh sách người dùng -->
            <table class="table table-hover">
                  <tr>
                  <th>STT</th> 
                  <th>Tên nhạc</th> 
                  <th>Nhạc</th> 
                  <th>Hình</th>
                  <th>Tên album</th>
                  <th>Chức năng</th>
                 
                  
                 </tr>
                 @foreach ($nhac as $nd)
                 <tr>
                    <td>@php
                        $number = str_pad($loop->iteration, 2, '0', STR_PAD_LEFT); // Định dạng số với hai chữ số và thêm số 0 ở đầu nếu cần
                    @endphp {{ $number }}</td>
                      <td>{{ $nd['tennhac'] }}</td>
                      <td><audio controls>
                        <source src="../../music/{{ $nd['nhaclink']  }}" type="audio/mp3">
                    </audio></td>
                    <td><img src="../../images/{{ $nd['imagemusic'] }}" width="80" class="img-thumbnail"></td>
                   
                    @foreach ($album as $ns)
                        @if ($ns['id']==$nd['album_idnhac'])
                        <td>{{ $ns['tenalbum'] }}</td>
                        @endif
                        
                    @endforeach
                    
                    
                      <td><a href="/Administrator/qlnhac/xoanhac&{{ $nd['id'] }}-music" class="text-danger delete-link" >Xóa</a>
                             <span> | </span>
                          <a href="/Administrator/qlnhac/suanhac&{{ $nd['id'] }}-music" class="text-warning">Sửa</a>
                     </td>
                     <td>
                      @if ($nd->xetduyet==0)
                      <a href="/Administrator/qlalbum/duyetmusic&{{ $nd['id'] }}-albc" class="text-danger">Chưa duyệt</a>
                      @else
                      <a href="/Administrator/qlalbum/duyetmusic&{{ $nd['id'] }}-albd" class="text-success">Đã duyệt</a>
                      <a href="/Administrator/loadchat&{{ $nd['id'] }}-albd">Send chat</a>
                      @endif
                     
                  </td>
                  </tr>    
                    
                 @endforeach
            </table>
          
          </div>
		@endif
@include('layoutsAdmin.bottom')