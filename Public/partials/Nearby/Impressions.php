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
        gn_data.Settings.LoginUrl = '/gpsnose/login';
        gn_data.Settings.NearbyImpressionsPageUrl = '/gpsnose/page_nearby_blogs';
    });
})(jQuery);
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.4">

    <div id="ma-gpsnose-<?=$record?>" class="ma-gpsnose-nearby-impressions" data-bind="visible:true" style="display:none;">

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
            <div class="masonry" data-bind="PageableImpressions.Items().length > 0">
                <div class="impressions" id="impressionsContainer">
                    <div class="masonry-sizer col-lg-3 col-md-4 col-sm-6"></div>
                    <!-- ko foreach: PageableImpressions.Items() -->
                    <div class="masonry-item col-lg-3 col-md-4 col-sm-6">
                        <div data-external data-bind="attr: { 'data-src': $data.DetailUrl() }">
                            <div class="outer">
                                <div class="img-container">
                                    <img class="img" data-bind="attr: { src: $data.ImageUrl() + '@600' }" onerror="this.style.display='none'" />
                                </div>
                                <div class="media d-flex mb-2">
                                    <div class="media-body flex-grow-1" data-bind="text: $data.Text"></div>
                                    <div class="media-right">
                                        <div class="media-object" data-bind="text: $data.Mood"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8 col-8">
                                        <small data-bind="text: $data.DateString()"></small>
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

            <div class="alert alert-info" data-bind="visible: PageableImpressions.Items().length == 0">
                <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                <span data-bind="text: ' ' + GetLangRes('Nearby_lblNoImpressions', 'Currently there are no Impressions around')"></span>
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
        vm.PageableImpressions.OnAddItems = function() {
            $('#ma-gpsnose-<?=$record?> .masonry').imagesLoaded(function() {
                MasonryReload();
            });
        }

        ko.applyBindings(vm, $('#ma-gpsnose-<?=$record?>').get(0));

        if (typeof gn_data.Impressions != 'object') {
            if (console) console.warn(gn_data.Impressions);
        } else if (gn_data.Impressions) {
            vm.PageableImpressions.AddItems(gn_data.Impressions);
        }
    });
})(jQuery);
</script>
<!-- MAIN_END -->
