jQuery(document).ready(function($){
    // Upload de Logo
    var mediaUploader;

    $('.rlq-upload-logo-btn').click(function(e) {
        e.preventDefault();
        
        // Se o uploader já existir, abra-o
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Estender o objeto wp.media
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Escolha o Logo',
            button: {
                text: 'Usar este logo'
            },
            multiple: false
        });

        // Quando um arquivo for selecionado, pegue a URL e o ID
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#rlq_logo_id').val(attachment.id);
            $('#rlq-logo-preview').attr('src', attachment.url).show();
            $('.rlq-remove-logo-btn').show();
        });

        // Abra o uploader
        mediaUploader.open();
    });

    // Remover Logo
    $('.rlq-remove-logo-btn').click(function(e){
        e.preventDefault();
        $('#rlq_logo_id').val('');
        $('#rlq-logo-preview').attr('src', '').hide();
        $(this).hide();
    });
});
