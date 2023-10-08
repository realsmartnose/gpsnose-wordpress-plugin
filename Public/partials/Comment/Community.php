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
$(document).ready(function() {
    AddLangRes('Comment_lblErrorTextRequired', '<?php __("Comment_lblErrorTextRequired")?>');
    AddLangRes('Comment_lblErrorCannotSave', '<?php __("Comment_lblErrorCannotSave")?>');
    AddLangRes('Common_btnClose', '<?php __("Common_btnClose")?>');
    AddLangRes('Common_btnDelete', '<?php __("Common_btnDelete")?>');
    AddLangRes('Common_btnEdit', '<?php __("Common_btnEdit")?>');
    AddLangRes('Common_btnJoinCommunity', '<?php __("Common_btnJoinCommunity")?>');
    AddLangRes('Common_btnLogin', '<?php __("Common_btnLogin")?>');
    AddLangRes('Common_btnOk', '<?php __("Common_btnOk")?>');
    AddLangRes('Common_btnSend', '<?php __("Common_btnSend")?>');
    AddLangRes('Common_btnShowProfile', '<?php __("Common_btnShowProfile")?>');
    AddLangRes('Common_lblCommentAddHint', '<?php __("Common_lblCommentAddHint")?>');
    AddLangRes('Common_lblCommentEdit', '<?php __("Common_lblCommentEdit")?>');
    AddLangRes('Common_lblCommentEditHint', '<?php __("Common_lblCommentEditHint")?>');
    AddLangRes('Common_lblComments', '<?php __("Common_lblComments")?>');
    AddLangRes('Common_lblError', '<?php __("Common_lblError")?>');
    AddLangRes('Common_lblLoadMore', '<?php __("Common_lblLoadMore")?>');
    AddLangRes('Common_lblNoCommentsAvailable', '<?php __("Common_lblNoCommentsAvailable")?>');
    AddLangRes('Common_lblRequestInProgress', '<?php __("Common_lblRequestInProgress")?>');
    AddLangRes('Common_lblScanToJoin', '<?php __("Common_lblScanToJoin")?>');
    AddLangRes('Community_loginRequired', '<f:translate key="Community_loginRequired" />');
    gn_data.Settings.CommentPageUrl = $('<textarea />').html('{f:uri.action(action:'pageComments', controller:'Api', pluginName:'Pagecomments', pageType:'{settings.ajax.pageComments}', arguments:'{ communityTag : communityTag }')}').text();
    gn_data.Settings.CommentSaveUrl = $('<textarea />').html('{f:uri.action(action:'commentSave', controller:'Api', pluginName:'Commentsave', pageType:'{settings.ajax.commentSave}', arguments:'{ communityTag : communityTag }')}').text();
    gn_data.Settings.LoginUrl = $('<textarea />').html('{f:uri.page(pageUid:'{settings.login.loginPid}')}').text();
});
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
