@include('layouts.top')
		@if (Auth::guard('web')->check())
        <div>
            <h3>Nhạc</h3>
            <div><a class="btn btn-primary" href="/Administrator/qlnhac/themnhac"><span class="glyphicon glyphicon-plus"></span> Thêm nhạc</a></div>
		  
            <br>
          
            <!-- Danh sách người dùng -->
            <table class="table table-hover">
                  <tr>
                  <th>Tên nhạc</th> 
                  <th>Nhạc</th> 
                  <th>Hình</th>
                  <th>Tên album</th>
                  <th>Chức năng</th>
                  
                 </tr>
                <?php foreach ($nhac as $nd): ?>
                  <tr>
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
                    
                    
                      <td><a href="/Administrator/qlnhac/xoanhac&{{ $nd['id'] }}-music" class="text-danger">Xóa</a>
                             <span> | </span>
                          <a href="/Administrator/qlnhac/suanhac&{{ $nd['id'] }}-music" class="text-warning">Sửa</a>
                     </td>
                  </tr>    
                    
                
                  <?php endforeach; ?>
            </table>
          
          </div>
		@endif
@include('layouts.bottom')