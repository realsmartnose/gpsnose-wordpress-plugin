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
    AddLangRes('Nearby_lblNoPois', '<?php __("Nearby_lblNoPois")?>');
    gn_data.Settings.LoginUrl = $('<textarea />').html('{f:uri.page(pageUid:'{settings.login.loginPid}')}').text();
    gn_data.Settings.NearbyPoisPageUrl = $('<textarea />').html('{f:uri.action(action:'pageNearbyPois', controller:'Api', pluginName:'Pagenearbypois', pageType:'{settings.ajax.pageNearbyPois}', arguments:'{ communityTag : communityTag }')}').text();
});
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.0">

    <div id="ma-gpsnose-{record}" class="ma-gpsnose-nearby-pois" data-bind="visible:true" style="display:none;">

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
            <div class="masonry" data-bind="PageablePois.Items().length > 0">
                <div class="pois" id="poisContainer">
                    <div class="masonry-sizer col-lg-4 col-sm-6"></div>
                    <!-- ko foreach: PageablePois.Items() -->
                    <div class="masonry-item col-lg-4 col-sm-6">
                        <div data-external data-bind="attr: { 'data-src': $data.DetailUrl() }">
                            <div class="outer">
                                <div class="media d-flex mb-2">
                                    <div class="media-left mr-2 me-2">
                                        <img class="media-object img-rounded rounded media-height" data-bind="attr: { src: $data.ThumbUrl(), 'data-default': $parent.GetDefaultImageFromKeywords($data.Keywords) }" onerror="ImageErrorHandler(this, window.gn_data.Settings.ImagePath+'/EmptyPoi.png')" />
                                    </div>
                                    <div class="media-body">
                                        <div class="media-height">
                                            <h4 class="media-heading" data-bind="text: $data.Name"></h4>
                                            <span data-bind="text: $data.Address"></span>
                                            <div class="keywords-small">
                                                <ma-gpsnose-keywords params="keywordString: $data.Keywords"></ma-gpsnose-keywords>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <ma-gpsnose-rating params="percent: $data.RatingAvgPercent, count: $data.RatingCount, imagePath: gn_data.Settings.ImagePath"></ma-gpsnose-rating>
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

            <div class="alert alert-info" data-bind="visible: PageablePois.Items().length == 0">
                <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                <span data-bind="text: ' ' + GetLangRes('Nearby_lblNoPois', 'Currently there are no Pois around')"></span>
            </div>

        </div>

    </div>

</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
$(function() {
    if (! gn_data.User) gn_data.User = {};
    var vm = new NearbyViewModel(gn_data.Community, gn_data.User);
    vm.PageablePois.OnAddItems = function() {
        $('#ma-gpsnose-{record} .masonry').imagesLoaded(function() {
            MasonryReload();
        });
    }

    ko.applyBindings(vm, $('#ma-gpsnose-{record}').get(0));

    if (typeof gn_data.Pois != 'object') {
        if (console) console.warn(gn_data.Pois);
    } else if (gn_data.Pois) {
        vm.PageablePois.AddItems(gn_data.Pois);
    }
});
</script>
<!-- MAIN_END -->
