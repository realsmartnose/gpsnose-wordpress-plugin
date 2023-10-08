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
        AddLangRes('Common_btnJoinCommunity', '<?php __("Common_btnJoinCommunity")?>');
        AddLangRes('Common_lblLoadMore', '<?php __("Common_lblLoadMore")?>');
        AddLangRes('Common_lblRequestInProgress', '<?php __("Common_lblRequestInProgress")?>');
        AddLangRes('Common_lblScanToJoin', '<?php __("Common_lblScanToJoin")?>');
        AddLangRes('Home_Index_lblNoNews', '<?php __("Home_Index_lblNoNews")?>');
        AddLangRes('NewsPart_Load_lblBlogWasDeleted', '<?php __("NewsPart_Load_lblBlogWasDeleted")?>');
        AddLangRes('NewsPart_Load_lblCommentWasDeleted', '<?php __("NewsPart_Load_lblCommentWasDeleted")?>');
        gn_data.Settings.NewsPageUrl = $('<textarea />').html('{f:uri.action(action:'pageNews', controller:'Api', pluginName:'Pagenews', pageType:'{settings.ajax.pageNews}', arguments:'{ communityTag : communityTag }')}').text();
    });
})(jQuery);
</script>

<!-- MAIN_BEG -->
<div class="ma-gpsnose" data-gn-version="1.2.4">

    <div id="ma-gpsnose-<?=$record?>" class="ma-gpsnose-news" data-bind="visible:true" style="display: none;">

        <div class="btn-group btn-group-sm ma-btn-group" data-bind="attr: { 'data-remove': ! CommunityEntity.TagName }">
            <a class="btn btn-default btn-outline-primary" data-external role="button" data-bind="html: CommunityEntity.DisplayName(), attr: { href: CommunityEntity.DetailUrl() }"></a>
            <a href="javascript:void(0);" class="btn btn-primary" tabindex="0" role="button" data-bind="text: GetLangRes('Common_btnJoinCommunity', 'Join community'), attr: { 'data-popover-img': gn_data.Community.QrCodeJoinImage, 'data-popover-text': GetLangRes('Common_lblScanToJoin', 'To join the community, scan this QR code using your mobile GpsNose app please'), 'data-remove': ! gn_data.Community.QrCodeJoinImage }"></a>
        </div>

        <div id="newsContainer" class="masonry row">
            <div class="masonry-sizer col-lg-3 col-md-4 col-sm-6"></div>
            <!-- ko foreach: News() -->
            <div class="masonry-item col-lg-3 col-md-4 col-sm-6" data-bind="visible:!$data.IsNowDeleted, template: { name: TemplateName() }"></div>
            <!-- /ko -->
        </div>
        <div class="text-center">
            <div class="btn btn-default btn-outline-secondary btn-lg" role="button"
                data-bind="click: function(){ PageNews() }, visible: HasMoreNews(), attr: { disabled: NewsRequestActive() }">
                <div data-bind="visible: ! NewsRequestActive()">
                    <i class="glyphicon glyphicon-cloud-download fas fa-cloud-download-alt"></i>
                    <span data-bind="text: ' ' + GetLangRes('Common_lblLoadMore', 'more..')"></span>
                </div>
                <div data-bind="visible: NewsRequestActive()">
                    <i class="glyphicon glyphicon-repeat gly-spin fas fa-redo-alt"></i>
                    <span data-bind="text: ' ' + GetLangRes('Common_lblRequestInProgress', 'Loading')"></span>
                </div>
            </div>
        </div>

        <div class="alert alert-info" data-bind="visible: News().length == 0 && ! NewsRequestActive()">
            <i class="glyphicon glyphicon-info-sign fas fa-info-circle"></i>
            <span data-bind="text: ' ' + GetLangRes('Home_Overview_lblNoNews', 'There are currently no such news in your area.')"></span>
        </div>

    </div>

</div>

<script type="text/javascript">
var MA_GPSNOSE_IS_MASHUP = true;
(function($) {
    $(function() {
        if (! gn_data.User) gn_data.User = {};
        var vm = new OverviewViewModel();
        vm.NewsPageUrl = gn_data.Settings.NewsPageUrl;
        if (gn_data.Community && gn_data.Community.TagName) vm.CommunityTag(gn_data.Community.TagName);
        vm.OnAddNews = function() {
            $('#ma-gpsnose-<?=$record?> .masonry img:not([data-lazy-img])').imagesLoaded(function() {
                MasonryReload();
            });
        }

        ko.applyBindings(vm, $('#ma-gpsnose-<?=$record?>').get(0));

        // Add first Page of News
        if (gn_data.News) {
            vm.AddNews(gn_data.News);
        } else {
            vm.PageNews();
        }
    });
})(jQuery);
</script>

<script type="text/html" id="UnknownTemplate">
    <div class="UnknownNews">
        <div class="outer">
            <div>
                <div class="text-center">
                    <span data-bind="text: GetLangRes('Common_lblUnknownNews', 'Unknown news')"></span>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="AboutNewsTemplate">
    <div class="AboutNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <div class="media d-flex mb-2">
                    <div class="media-left mr-2 me-2">
                        <img class="media-object img-circle rounded-circle media-height" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyUser.png')" />
                    </div>
                    <div class="media-body">
                        <div>
                            <h4 class="media-heading" data-bind="text: $data.Title"></h4>
                            <p data-bind="text: $data.Description"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="ProfileImageNewsTemplate">
    <div class="ProfileImageNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <img class="image" data-bind="attr: { src: ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyUser.png')" />
                <p data-bind="text: $data.Description"></p>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="NewGuestUserNewsTemplate">
    <div class="NewGuestUserNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <div class="media d-flex mb-2">
                    <div class="media-left mr-2 me-2">
                        <img class="media-object img-circle rounded-circle media-height" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyUser.png')" />
                    </div>
                    <div class="media-body">
                        <div>
                            <h4 class="media-heading" data-bind="text: $data.Title"></h4>
                            <p data-bind="text: $data.Description"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="ProfileActivatedTemplate">
    <div class="ProfileActivated">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <div class="media d-flex mb-2">
                    <div class="media-left mr-2 me-2">
                        <img class="media-object img-circle rounded-circle media-height" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyUser.png')" />
                    </div>
                    <div class="media-body">
                        <div>
                            <h4 class="media-heading" data-bind="text: $data.Title"></h4>
                            <p data-bind="text: $data.Description"></p>
                        </div>
                    </div>
                    <div class="text-center">
                        <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="PhotoBlogNewsTemplate">
    <div class="PhotoBlogNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <div class="media mb-2">
                    <img class="image" data-bind="attr: { src: $data.ThumbUrl() }" onerror="this.style.display='none'" />
                </div>
                <div class="media d-flex mb-2">
                    <div class="media-body flex-grow-1" data-bind="text: $data.Impression_Text"></div>
                    <div class="media-right">
                        <div class="media-object" data-bind="text: $data.Impression_Mood"></div>
                    </div>
                </div>
                <div class="media mb-2">
                    <div class="media-body">
                        <div class="text-right text-end">
                            <span class="middle" data-bind="text: NoseDto.LoginName"></span>
                            <img class="img-circle rounded-circle" width="32" data-bind="attr: { src: NoseDto.ImageUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyUser.png')" />
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="PoIPublishedNewsTemplate">
    <div class="PoIPublishedNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <div class="media d-flex mb-2">
                    <div class="media-left mr-2 me-2">
                        <img class="media-object img-rounded rounded media-height" data-bind="attr: { src: ThumbUrl(), 'data-default': $parent.GetDefaultImageFromKeywords($data.Keywords) }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyPoi.png')" />
                    </div>
                    <div class="media-body">
                        <div class="media-height">
                            <h4 class="media-heading" data-bind="text: $data.Title"></h4>
                            <p data-bind="text: $data.Description"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="TourNewsTemplate">
    <div class="TourNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <div class="media d-flex mb-2">
                    <div class="media-left mr-2 me-2">
                        <img class="media-object img-rounded rounded media-height" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyTour.png')" />
                    </div>
                    <div class="media-body">
                        <div class="media-height">
                            <h4 class="media-heading" data-bind="text: $data.Title"></h4>
                            <p data-bind="text: $data.Description"></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <img class="ma-tour-icon" width="24px" data-bind="attr: { src: gn_data.Settings.ImagePath+'/TourType' + $data.Track_TrackType + '.png' }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/TourType99.png')" />
                    <div class="flex-grow-1">
                        <div class="text-center">
                            <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="EventNewsTemplate">
    <div class="AboutNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled: $data.IsNowDeleted }">
                <div class="media d-flex mb-2">
                    <div class="media-left mr-2 me-2">
                        <img class="media-object img-rounded rounded media-height" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyEvent.png')" />
                    </div>
                    <div class="media-body">
                        <div>
                            <h4 class="media-heading" data-bind="text: $data.Title"></h4>
                            <p data-bind="text: $data.Description"></p>
                            <p data-bind="text: $data.Event_LocationAddress"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="CommentNewsTemplate">
    <div class="CommentNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl() }">
                <div>
                    <div class="comment-image-container clearfix">
                        <div data-bind="if: Comment_CommentItemType == 'Tour'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyTour.png')" />
                        </div>
                        <div data-bind="if: Comment_CommentItemType == 'FavoriteLocation'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl(), 'data-default': $parent.GetDefaultImageFromKeywords($data.Keywords) }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyPoi.png')" />
                        </div>
                        <div data-bind="if: Comment_CommentItemType == 'PhotoBlog'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyImage.png')" />
                        </div>
                        <div data-bind="if: Comment_CommentItemType == 'Community'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyCommunity.png')" />
                        </div>
                        <img class="img-rounded comment-image-left" data-bind="attr: { src: NoseDto.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyUser.png')" />
                    </div>
                    <p class="text-center" data-bind="text: CommentText()"></p>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="RatingNewsTemplate">
    <div class="RatingNews">
        <div class="outer">
            <div data-external data-bind="attr: { src: ThumbUrl(), 'data-src': $data.DetailUrl() }">
                <div>
                    <div class="comment-image-container clearfix">
                        <div data-bind="if: Rating_RatedItemType == 'Tour'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyTour.png')" />
                        </div>
                        <div data-bind="if: Rating_RatedItemType == 'FavoriteLocation'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl(), 'data-default': $parent.GetDefaultImageFromKeywords($data.Keywords) }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyPoi.png')" />
                        </div>
                        <div data-bind="if: Rating_RatedItemType == 'PhotoBlog'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyImage.png')" />
                        </div>
                        <div data-bind="if: Rating_RatedItemType == 'Community'">
                            <img class="img-rounded comment-image-right" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyCommunity.png')" />
                        </div>
                        <img class="img-rounded comment-image-left" data-bind="attr: { src: NoseDto.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyUser.png')" />
                    </div>
                    <div class="rating-stars-container">
                        <ma-gpsnose-rating params="percent: $data.Rating_Percent, count: -1, imagePath: gn_data.Settings.ImagePath"></ma-gpsnose-rating>
                    </div>
                    <p class="text-center" data-bind="text: $data.Description"></p>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="MashupNewsTemplate">
    <div class="MashupNews">
        <div class="outer">
            <div data-external data-bind="attr: { 'data-src': $data.DetailUrl(), disabled:$data.IsNowDeleted }">
                <div class="media d-flex mb-2">
                    <div class="media-left mr-2 me-2">
                        <img class="media-object img-rounded rounded media-height" data-bind="attr: { src: $data.ThumbUrl() }" onerror="ImageErrorHandler(this, gn_data.Settings.ImagePath+'/EmptyCommunity.png')" />
                    </div>
                    <div class="media-body">
                        <div class="media-height">
                            <h4 class="media-heading" data-bind="text: $data.Title"></h4>
                            <p data-bind="text: $data.Description"></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <small data-bind="text: GetDateStringFromTicks($data.CreationTicks)"></small>
                </div>
            </div>
        </div>
    </div>
</script>
<!-- MAIN_END -->
