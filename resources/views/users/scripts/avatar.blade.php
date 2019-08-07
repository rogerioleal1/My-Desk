@push('scripts')
<script type="text/javascript">
    $('#avatar').fileinput({
        theme: "fas",
        language: "pt-BR",
        showUpload: false,
        showCancel: false,
        showClose: false,
        showCaption: false,
        removeClass: 'btn btn-danger',
        title: 'teste',
        allowedFileExtensions: [
            'jpg', 'jpeg', 'png'
        ],
        defaultPreviewContent: [
            "<img src='{{ uploads_path($user->avatar ?? "avatars/avatar.png") }}' class='file-preview-image' width='180'>",
        ],
        fileActionSettings: {
            showRemove: false,
        },
        overwriteInitial: true,
        purifyHtml: true,
    })
</script>
@endpush