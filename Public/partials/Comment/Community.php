<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/realsmartnose
 * @since      1.0.0
 *
 * @package    Gpsnose
 * @subpackage Gpsnose/public/partials
 */
?>

<script>
(function($) {
    $(document).ready(function() {
        gn_data.Settings.CommentPageUrl = '/gpsnose/page_comments';
        gn_data.Settings.CommentSaveUrl = '/gpsnose/comment_save';
        gn_data.Settings.LoginUrl = '/gpsnose/login';
    });
})(jQuery);
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.4">

    <div id="ma-gpsnose-<?=$record?>" class="ma-gpsnose-comment" data-bind="visible:true" style="display:none;">

        <div class="btn-group btn-group-sm ma-btn-group">
            <a class="btn btn-default btn-outline-primary" data-external data-bind="html: Entity.DisplayName(), attr: { href: Entity.DetailUrl() }"></a>
            <a href="javascript:void(0);" class="btn btn-primary" tabindex="0" data-bind="text: GetLangRes('Common_btnJoinCommunity', 'Join community'), attr: { 'data-popover-img': gn_data.Community.QrCodeJoinImage, 'data-popover-text': GetLangRes('Common_lblScanToJoin', 'To join the community, scan this QR code using your mobile GpsNose app please'), 'data-remove': ! gn_data.Community.QrCodeJoinImage }"></a>
        </div>

        <ma-gpsnose-comments params="uniqueKey: gn_data.Community.TagName,
                    entity: vm ? vm.Entity : {},
                    imagePath: gn_data.Settings.ImagePath,
                    hideTitle: true,
                    commentPageUrl: gn_data.Settings.CommentPageUrl,
                    commentSaveUrl: gn_data.Settings.CommentSaveUrl,
                    loginUrl: gn_data.Settings.LoginUrl,
                    comments: gn_data.Community.Comments,
                    loginName: gn_data.User.LoginName,
                    isActivated: gn_data.User.IsActivated,
                    onChangeComments: ma_gpsnose_change"></ma-gpsnose-comments>

        <ma-gpsnose-dialog></ma-gpsnose-dialog>

    </div>

</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
var vm;
(function($) {
    $(function() {
        if (! gn_data.User) gn_data.User = {};
        vm = new CommunityDetailViewModel(gn_data.Community, gn_data.User);
        ko.applyBindings(vm, $('#ma-gpsnose-<?=$record?>').get(0));
    });
})(jQuery);
function ma_gpsnose_change(container) {
    $(container).imagesLoaded(function() {
        setTimeout(function() { MasonryReload(); }, 250);
    });
}
</script>
<!-- MAIN_END -->
