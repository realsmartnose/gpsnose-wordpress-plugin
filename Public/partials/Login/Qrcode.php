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
var tLoginVerifyUrl = $('<textarea />').html('{f:uri.action(action: 'loginVerifie', controller: 'Api', pageType: '{settings.ajax.loginVerifie}', arguments: {mashup : mashup, loginId:'{login_id}'})}').text();
var tReturnUrl = '{return_url}';
var tQrCodeImage = '{qr_code_image}';
$(document).ready(function() {
    AddLangRes('Account_Login_lblTitle', '<?php __("Account_Login_lblTitle")?>');
    AddLangRes('Account_Login_lblLoginText', '<?php __("Account_Login_lblLoginText")?>');
    AddLangRes('Common_lblUnknownError', '<?php __("Common_lblUnknownError")?>');
    AddLangRes('Common_lblCompanyName', '<?php __("Common_lblCompanyName")?>');
    gn_data.Settings.LoginVerifyUrl = tLoginVerifyUrl;
    gn_data.Settings.ReturnUrl = tReturnUrl;
    gn_data.Settings.QrCodeImage = tQrCodeImage;
});
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.0">

    <div id="ma-gpsnose-{record}" class="ma-gpsnose-login" data-bind="visible:true" style="display:none;">

        <div id="polling-stopped-message" style="display: none;">
            <div class="alert alert-danger">
                <div class="media d-flex">
                    <div class="media-left mr-2 me-2">
                        <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                    </div>
                    <div class="media-body flex-grow-1">
                        <p class="m-0" data-bind="text: ' ' + GetLangRes('Common_lblLoginPollingStopped', 'The polling stopped, please use the button to restart the polling.')"></p>
                    </div>
                    <div class="media-right">
                        <button class="btn btn-sm btn-danger" data-bind="click: function() { document.location.reload(); }">
                            <i class="glyphicon glyphicon-user fas fa-user"></i>
                            <span data-bind="text: ' ' + GetLangRes('Common_btnRestart', 'Restart')"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="alert alert-info">
                    <h4>
                        <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                        <span data-bind="text: ' ' + GetLangRes('Account_Login_lblTitle', 'Login')"></span>
                    </h4>
                    <span data-bind="text: GetLangRes('Account_Login_lblLoginText', 'To login, scan this QR code using your mobile GpsNose app please')"></span>
                </div>
            </div>
            <div class="col-md-6 text-center">

                <img class="ma-qrcode-image" data-bind="attr: { src: gn_data.Settings.QrCodeImage }, visible: gn_data.Settings.QrCodeImage" />

                <div class="alert alert-danger" data-bind="visible: ! gn_data.Settings.QrCodeImage">
                    <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
                    <span data-bind="text: ' ' + GetLangRes('Common_lblUnknownError', 'An unknown error is occured!')"></span>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>

        <br />

        <div class="row my-2">
            <div class="col-6">
                <div class="text-end text-right">
                    <a href="#" data-external role="button" data-bind="attr: { 'href': AppleLink }">
                        <img data-bind="attr: { src: gn_data.Settings.ImagePath + '/badge_app_store.png' }" alt="App Store">
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="text-start text-left">
                    <a href="#" data-external role="button" data-bind="attr: { 'href': GoogleLink }">
                        <img data-bind="attr: { src: gn_data.Settings.ImagePath + '/badge_google_play.png' }" alt="Google Play">
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
$(function() {
    if (! gn_data.User) gn_data.User = {};
    ko.applyBindings(new BaseViewModel(), $('#ma-gpsnose-{record}').get(0));
    window.setTimeout(function() {
        MaWaitForLogin(gn_data.Settings.LoginVerifyUrl, gn_data.Settings.ReturnUrl, new Date().getTime() + 60000, function() { $('#polling-stopped-message').show(); });
    }, 3500);
});
</script>
<!-- MAIN_END -->
