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


<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script src="../../inc/js/pusher.js"></script>
<script src="../../inc/js/app.js"></script>
@if (Auth::guard('api')->check())
    <script>
        var csrfToken = ` {{ csrf_token() }}`;
        var contentFilter = {{ $contentFilter }};
    </script>
@endif
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../../editor/tinymce/tinymce.min.js"></script>
<script src="../../inc/js/indexAdmin.js"></script>

<script>
    tinymce.init({
        selector: 'textarea#default',
        width: 900,
        height: 300,
        plugins: [
            'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
            'table', 'emoticons', 'template', 'codesample'
        ],
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons',
        menu: {
            favs: {
                title: 'menu',
                items: 'code visualaid | searchreplace | emoticons'
            }
        },
        menubar: 'favs file edit view insert format tools table',
        content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
    });
    
</script>
</body>

</html>
