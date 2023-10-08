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
    AddLangRes('Nearby_lblNoTracks', '<?php __("Nearby_lblNoTracks")?>');
    gn_data.Settings.LoginUrl = $('<textarea />').html('{f:uri.page(pageUid:'{settings.login.loginPid}')}').text();
    gn_data.Settings.NearbyTracksPageUrl = $('<textarea />').html('{f:uri.action(action:'pageNearbyTracks', controller:'Api', pluginName:'Pagenearbytracks', pageType:'{settings.ajax.pageNearbyTracks}', arguments:'{ communityTag : communityTag }')}').text();
});
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.4">

    <div id="ma-gpsnose-<?=$record?>" class="ma-gpsnose-nearby-tracks" data-bind="visible:true" style="display:none;">

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
            <div class="masonry" data-bind="PageableTracks.Items().length > 0">
                <div class="tracks" id="tracksContainer">
                    <div class="masonry-sizer col-lg-4 col-sm-6"></div>
                    <!-- ko foreach: PageableTracks.Items() -->
                    <div class="masonry-item col-lg-4 col-sm-6">
                        <div data-external data-bind="attr: { 'data-src': $data.DetailUrl() }">
                            <div class="outer">
                                <div class="media d-flex mb-2">
                                    <div class="media-left mr-2 me-2">
                                        <img class="media-object img-rounded rounded media-height" data-bind="attr: { src: $data.ImageUrl() }" onerror="ImageErrorHandler(this, window.gn_data.Settings.ImagePath+'/EmptyTour.png')" />
                                    </div>
                                    <div class="media-body">
                                        <div class="media-height">
                                            <h4 class="media-heading" data-bind="text: $data.Name"></h4>
                                            <p data-bind="text: $data.Description"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <ma-gpsnose-rating params="percent: $data.RatingAvgPercent, count: $data.RatingCount, imagePath: gn_data.Settings.ImagePath"></ma-gpsnose-rating>
                                </div>
                                <div class="d-flex">
                                    <img class="ma-tour-icon mr-1 me-1" width="24px" data-bind="attr: { src: gn_data.Settings.ImagePath+'/TourType' + $data.TrackType + '.png' }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/TourType99.png')" />
                                    <div class="flex-grow-1">
                                        <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                                    </div>
                                    <div>
                                        <small data-bind="text: GetDistanceString($data)"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /ko -->
                </div>
            </div>

            <div class="alert alert-info" data-bind="visible: PageableTracks.Items().length == 0">
                <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                <span data-bind="text: ' ' + GetLangRes('Nearby_lblNoTracks', 'Currently there are no Tracks around')"></span>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
(function($) {
    $(function() {
        if (! gn_data.User) gn_data.User = {};
        var vm = new NearbyViewModel(gn_data.Community, gn_data.User);
        vm.PageableTracks.OnAddItems = function() {
            $('#ma-gpsnose-<?=$record?> .masonry').imagesLoaded(function() {
                MasonryReload();
            });
        }

        ko.applyBindings(vm, $('#ma-gpsnose-<?=$record?>').get(0));

        if (typeof gn_data.Tracks != 'object') {
            if (console) console.warn(gn_data.Tracks);
        } else if (gn_data.Tracks) {
            vm.PageableTracks.AddItems(gn_data.Tracks);
        }
    });
})(jQuery);
</script>
<!-- MAIN_END -->
