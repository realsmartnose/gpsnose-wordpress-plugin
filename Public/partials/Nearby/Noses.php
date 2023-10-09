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
        gn_data.Settings.NearbyNosesPageUrl = '/gpsnose/page_nearby_noses';
    });
})(jQuery);
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.4">

    <div id="ma-gpsnose-<?=$record?>" class="ma-gpsnose-nearby-noses" data-bind="visible:true" style="display:none;">

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
            <div class="row publishers" data-bind="foreach: PageableNoses.Items">
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 col-6">
                    <div class="outer" data-external="true" data-bind="attr: { 'data-src': $data.DetailUrl() }">
                        <div class="thumbnail">
                            <img data-bind="attr: { src: $data.ThumbUrl() }" onerror="this.src=window.gn_data.Settings.ImagePath+'/EmptyUser.png'" />
                            <div data-bind="if: $data.IsAdmin">
                                <img class="ma-crown" data-bind="attr: { src: window.gn_data.Settings.ImagePath + '/IcActionCrown.png'}" />
                            </div>
                            <div class="loginname">
                                <div data-bind="text: $data.LoginName"></div>
                                <div class="row">
                                    <div class="col-xs-8 col-8 text-left text-start">
                                        <small data-bind="text: GetAgeStringFromTicks($data.CreationTicks)"></small>
                                    </div>
                                    <div class="col-xs-4 col-4 text-right text-end">
                                        <small data-bind="text: GetDistanceString($data)"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info" data-bind="visible: PageableNoses.Items().length == 0">
                <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                <span data-bind="text: ' ' + GetLangRes('Nearby_lblNoNoses', 'Currently there are no other Noses around')"></span>
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
        ko.applyBindings(vm, $('#ma-gpsnose-<?=$record?>').get(0));

        if (typeof gn_data.Noses != 'object') {
            if (console) console.warn(gn_data.Noses);
        } else if (gn_data.Noses) {
            vm.PageableNoses.AddItems(gn_data.Noses);
        }
    });
})(jQuery);
</script>
<!-- MAIN_END -->
