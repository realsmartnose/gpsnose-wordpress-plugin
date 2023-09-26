/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

var MA_GPSNOSE_IS_MASHUP = true;
window.addEventListener("load", function () {
    // gn_data.Settings.MembersPageUrl = $('<textarea />').html('{f:uri.action(action:'pageMembers', controller:'Api', pluginName:'Pagemembers', pageType:'{settings.ajax.pageMembers}', arguments:'{ communityTag : communityTag }')}').text();
	gn_data.Settings.MembersPageUrl = '/myfancyajax.json';

	if (! gn_data.User) gn_data.User = {};
    var vm = new CommunityDetailViewModel(gn_data.Community, gn_data.User);
    vm.MembersPageUrl = gn_data.Settings.MembersPageUrl;
    ko.applyBindings(vm, jQuery('#ma-gpsnose-1').get(0));

    // Add first Page of Members
    if (gn_data.Members) {
        vm.AddMembers(gn_data.Members);
    } else {
        vm.PageMembers();
    }
});

