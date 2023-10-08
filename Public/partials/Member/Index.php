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
    AddLangRes('Common_btnJoinCommunity', '<?php __("Common_btnJoinCommunity")?>');
    AddLangRes('Common_lblLoadMore', '<?php __("Common_lblLoadMore")?>');
    AddLangRes('Common_lblRequestInProgress', '<?php __("Common_lblRequestInProgress")?>');
    AddLangRes('Common_lblScanToJoin', '<?php __("Common_lblScanToJoin")?>');
    AddLangRes('Community_lblMembersNoEntryMessage', '<?php __("Community_lblMembersNoEntryMessage")?>');
    gn_data.Settings.MembersPageUrl = $('<textarea />').html('{f:uri.action(action:'pageMembers', controller:'Api', pluginName:'Pagemembers', pageType:'{settings.ajax.pageMembers}', arguments:'{ communityTag : communityTag }')}').text();
});
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.4">

    <div id="ma-gpsnose-<?=$record?>" class="ma-gpsnose-members" data-bind="visible:true" style="display:none;">

        <div class="btn-group btn-group-sm ma-btn-group">
            <a class="btn btn-default btn-outline-primary" data-external data-bind="html: Entity.DisplayName(), attr: { href: Entity.DetailUrl() }"></a>
            <a href="javascript:void(0);" class="btn btn-primary" tabindex="0" data-bind="text: GetLangRes('Common_btnJoinCommunity', 'Join community'), attr: { 'data-popover-img': gn_data.Community.QrCodeJoinImage, 'data-popover-text': GetLangRes('Common_lblScanToJoin', 'To join the community, scan this QR code using your mobile GpsNose app please'), 'data-remove': ! gn_data.Community.QrCodeJoinImage }"></a>
        </div>

        <div class="row publishers" data-bind="foreach: Members">
            <div class="masonry-item col-lg-2 col-md-3 col-sm-4 col-xs-6 col-6">
                <div class="outer" data-external="true" data-bind="attr: { 'data-src': $data.NoseDto.DetailUrl() }">
                    <div class="thumbnail">
                        <img data-bind="attr: { src: $data.NoseDto.ThumbUrl() }" onerror="this.src=window.gn_data.Settings.ImagePath+'/EmptyUser.png'" />
                        <div data-bind="if: $data.IsAdmin">
                            <img class="ma-crown" data-bind="attr: { src: window.gn_data.Settings.ImagePath + '/IcActionCrown.png'}" />
                        </div>
                        <div class="loginname">
                            <div data-bind="text: $data.LoginName"></div>
                            <div data-bind="text: GetAgeStringFromTicks($data.JoinTicks) + ''"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">

            <div class="btn btn-default btn-outline-secondary btn-lg" data-bind="click: function(){ PageMembers() }, visible: HasMoreMembers(), attr: { disabled: MembersRequestActive() }">
                <div data-bind="visible: ! MembersRequestActive()">
                    <i class="glyphicon glyphicon-cloud-download fas fa-cloud-download-alt"></i>
                    <span data-bind="text: ' ' + GetLangRes('Common_lblLoadMore', 'more..')"></span>
                </div>
                <div data-bind="visible: MembersRequestActive()">
                    <i class="glyphicon glyphicon-repeat gly-spin fas fa-redo-alt"></i>
                    <span data-bind="text: ' ' + GetLangRes('Common_lblRequestInProgress', 'Loading')"></span>
                </div>
            </div>

        </div>

        <div class="alert alert-info" data-bind="visible: Members().length == 0 && ! MembersRequestActive()">
            <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
            <span data-bind="text: ' ' + GetLangRes('Community_lblMembersNoEntryMessage', 'There are no members in this community currently.')"></span>
        </div>

    </div>

</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
(function($) {
    $(function() {
        if (! gn_data.User) gn_data.User = {};
        var vm = new CommunityDetailViewModel(gn_data.Community, gn_data.User);
        vm.MembersPageUrl = gn_data.Settings.MembersPageUrl;
        ko.applyBindings(vm, $('#ma-gpsnose-<?=$record?>').get(0));

        // Add first Page of Members
        if (gn_data.Members) {
            vm.AddMembers(gn_data.Members);
        } else {
            vm.PageMembers();
        }
    });
})(jQuery);
</script>
<!-- MAIN_END -->
