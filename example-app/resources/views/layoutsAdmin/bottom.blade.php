</div>
</main>
<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0 mx-auto">
                    <a class="text-muted" href="#"><strong>Web Music</strong></a>
                </p>
            </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="">Hỗ trợ</a>
                    </li>								
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>

</div>
<script src="../../inc/js/indexAdmin.js"></script>
</script>
@if (Auth::guard('api')->check()) 
    <script>
     const user='{{ $ttnguoidung->id }}';
     var csrfToken =` {{ csrf_token() }}`;
     
    </script>
@endif
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>