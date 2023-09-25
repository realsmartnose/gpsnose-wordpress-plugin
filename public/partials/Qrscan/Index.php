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
    AddLangRes('Home_Index_lblNoNews', '<?php __("Home_Index_lblNoNews")?>');
    AddLangRes('NewsPart_Load_lblBlogWasDeleted', '<?php __("NewsPart_Load_lblBlogWasDeleted")?>');
    AddLangRes('NewsPart_Load_lblCommentWasDeleted', '<?php __("NewsPart_Load_lblCommentWasDeleted")?>');
    gn_data.Settings.NewsPageUrl = $('<textarea />').html('{f:uri.action(action:'pageNews', controller:'Api', pluginName:'Pagenews', pageType:'{settings.ajax.pageNews}', arguments:'{ communityTag : communityTag }')}').text();
});
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.0">

    <div id="ma-gpsnose-{record}" class="ma-gpsnose-security-token-validator" data-bind="visible:true" style="display:none;">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-info" data-bind="visible: ! HasMessage()">
                    <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                    <span data-bind="text: ' ' + GetLangRes('SecurityTokenValidator_hint', 'Start the camera and scan a SecurityToken..')"></span>
                </div>
                <div class="alert alert-success" data-bind="visible: MessageSuccess()">
                    <i class="glyphicon glyphicon-ok-sign fas fa-check-circle"></i>
                    <span data-bind="text: ' ' + MessageSuccess()"></span>
                </div>
                <div class="alert alert-danger" data-bind="visible: MessageError()">
                    <i class="glyphicon glyphicon-remove-sign fas fa-times-circle"></i>
                    <span data-bind="text: ' ' + MessageError()"></span>
                </div>

                <div id="gn-qr-code-scanner">
                    <canvas></canvas>
                </div>

                <div id="gn-qr-code-scanner-buttons" class="text-center">
                    <button class="btn btn-primary" id="start" data-bind="disable: IsCameraOn(), click: function() {ToggleCamera()}"><i class="fas fa-play"></i> <span>Start</span></button>
                    <button class="btn btn-danger" id="stop" data-bind="disable: ! IsCameraOn() || IsCameraPending(), click: function() {ToggleCamera()}"><i class="fas fa-stop"></i> <span>Stop</span></button>
                </div>

                <ul class="list-group" data-bind="foreach: SecurityTokens().sort(function (l, r) { return l.ScannedTicks() &lt; r.ScannedTicks() ? 1 : -1 })">
                    <li class="list-group-item" data-bind="css: { 'list-group-item-success': $data.IsValid(), 'list-group-item-warning': !$data.IsValid() && !$data.IsPending(), 'disabled': $data.IsPending() }">
                        <span class="pull-right float-right float-end" data-bind="visible: $data.IsPending()">
                            <i class="fas fa-redo-alt gly-spin"></i>
                        </span>
                        <h5 data-bind="text: $data.CreatorUserName"></h5>
                        <p data-bind="text: GetDateStringFromTicks($data.ScannedTicks())"></p>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
var selector = "#ma-gpsnose-{record}";

$(function() {
    if (! gn_data.User) gn_data.User = {};
    var vm = new SecurityTokenValidatorViewModel();
    vm.ValidateUrl = gn_data.Settings.ValidateUrl;
    vm.setDefaultDecoder($(selector + " #gn-qr-code-scanner canvas"), gn_data.Settings.DecoderWorkerPath);

    vm.OnValidateComplete = function(tokenIsValide, creatorUserName) {
        var success = tokenIsValide;
        // Customer-Rules here...
        if (success)
            vm.MessageSuccess(GetLangRes('SecurityTokenValidator_validationSuccess', 'The security-token of %user_name% was successfully validated').replace('%user_name%', creatorUserName));
        else
            vm.MessageError(GetLangRes('SecurityTokenValidator_validationFail', 'The security-token of %user_name% is not valide').replace('%user_name%', creatorUserName));
    };

    ko.applyBindings(vm, $(selector).get(0));
});
</script>
<!-- MAIN_END -->
