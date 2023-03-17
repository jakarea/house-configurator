// set pills tabs active based on cookie
jQuery(document).ready(function($) {
    $("#h__tabs-level a").click(function (e) {
        e.preventDefault();
        $(this).tab("show");
        var tab = $(this).attr("href");
        $.cookie("active_tab", tab);
    });
    
    var activeTab = $.cookie("active_tab");
    if (activeTab) {
        $("#h__tabs-level a[href='" + activeTab + "']").tab("show");
    }
});
  

jQuery(document).ready(function($){

    // Image Upload
    var customUploader;

    $('.level_featured_image_button').click(function(e) {
        e.preventDefault();

        // If the uploader object has already been created, reopen the dialog
        if (customUploader) {
            customUploader.open();
            return;
        }

        // Extend the wp.media object
        customUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it as the text field's value
        customUploader.on('select', function() {
            var attachment = customUploader.state().get('selection').first().toJSON();

            // show preview
            $('.level-featured-image-preview').html('<img src="' + attachment.url + '" style="max-width:100%;"/>');

            // set the value of the input field
            $('.level_featured_image').val(attachment.id);
        });

        // Open the uploader dialog
        customUploader.open();
    });
});
