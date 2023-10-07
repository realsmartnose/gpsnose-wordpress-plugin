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
    AddLangRes('Common_btnLogin', '<?php __("Common_btnLogin")?>');
    AddLangRes('Common_lblError', '<?php __("Common_lblError")?>');
    AddLangRes('Common_lblLoadMore', '<?php __("Common_lblLoadMore")?>');
    AddLangRes('Common_lblRequestInProgress', '<?php __("Common_lblRequestInProgress")?>');
    AddLangRes('Common_lblScanToJoin', '<?php __("Common_lblScanToJoin")?>');
    AddLangRes('Common_loginRequired', '<?php __("Common_loginRequired")?>');
    AddLangRes('Nearby_lblNoEvents', '<?php __("Nearby_lblNoEvents")?>');
    gn_data.Settings.LoginUrl = $('<textarea />').html('{f:uri.page(pageUid:'{settings.login.loginPid}')}').text();
    gn_data.Settings.NearbyEventsPageUrl = $('<textarea />').html('{f:uri.action(action:'pageNearbyEvents', controller:'Api', pluginName:'Pagenearbyevents', pageType:'{settings.ajax.pageNearbyEvents}', arguments:'{ communityTag : communityTag }')}').text();
});
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.0">

    <div id="ma-gpsnose-{record}" class="ma-gpsnose-nearby-events" data-bind="visible:true" style="display:none;">

        <div class="btn-group btn-group-sm ma-btn-group">
            <a class="btn btn-default btn-outline-primary" data-external data-bind="html: Entity.DisplayName(), attr: { href: Entity.DetailUrl() }"></a>
            <a href="javascript:void(0);" class="btn btn-primary" tabindex="0" data-bind="text: GetLangRes('Common_btnJoinCommunity', 'Join community'), attr: { 'data-popover-img': gn_data.Community.QrCodeJoinImage, 'data-popover-text': GetLangRes('Common_lblScanToJoin', 'To join the community, scan this QR code using your mobile GpsNose app please'), 'data-remove': ! gn_data.Community.QrCodeJoinImage }"></a>
        </div>

        <div data-bind="if: ! gn_data.User.LoginName">
            <div class="alert alert-info">
                <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                <span data-bind="text: ' ' + GetLangRes('Common_loginRequired', 'Please login first.')"></span>
                <button type="button" class="btn btn-info btn-sm pull-right float-right float-end" data-bind="click: function() { document.location.href = $data.GetLoginUrl(gn_data.Settings.LoginUrl); }">
                    <i class="glyphicon glyphicon-user fas fa-user"></i>
                    <span data-bind="text: ' ' + GetLangRes('Common_btnLogin', 'Login')"></span>
                </button>
            </div>
        </div>
        <div data-bind="if: gn_data.User.LoginName">
            <div class="masonry" data-bind="PageableEvents.Items().length > 0">
                <div class="events" id="eventsContainer">
                    <div class="masonry-sizer col-lg-4 col-sm-6"></div>
                    <!-- ko foreach: PageableEvents.Items() -->
                    <div class="masonry-item col-lg-4 col-sm-6">
                        <div data-external data-bind="attr: { 'data-src': $data.DetailUrl() }">
                            <div class="outer">
                                <div class="media d-flex mb-2">
                                    <div class="media-left mr-2 me-2">
                                        <img class="media-object img-rounded rounded media-height" data-bind="attr: { src: $data.ImageUrl() }" onerror="ImageErrorHandler(this, window.gn_data.Settings.ImagePath+'/EmptyEvent.png')" />
                                    </div>
                                    <div class="media-body">
                                        <div class="media-height">
                                            <h4 class="media-heading" data-bind="text: $data.Name"></h4>
                                            <p data-bind="text: $data.Description"></p>
                                            <p data-bind="text: $data.Address"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8 col-8">
                                        <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                                    </div>
                                    <div class="col-xs-4 col-4 text-right text-end">
                                        <small data-bind="text: GetDistanceString($data)"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /ko -->
                </div>
            </div>

            <div class="alert alert-info" data-bind="visible: PageableEvents.Items().length == 0">
                <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                <span data-bind="text: ' ' + GetLangRes('Nearby_lblNoEvents', 'Currently there are no Events around')"></span>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
$(function() {
    if (! gn_data.User) gn_data.User = {};
    var vm = new NearbyViewModel(gn_data.Community, gn_data.User);
    vm.PageableEvents.OnAddItems = function() {
        $('#ma-gpsnose-{record} .masonry').imagesLoaded(function() {
            MasonryReload();
        });
    }

    ko.applyBindings(vm, $('#ma-gpsnose-{record}').get(0));

    if (typeof gn_data.Events != 'object') {
        if (console) console.warn(gn_data.Events);
    } else if (gn_data.Events) {
        vm.PageableEvents.AddItems(gn_data.Events);
    }
});
</script>
<!-- MAIN_END -->
