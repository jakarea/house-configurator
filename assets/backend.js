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
  