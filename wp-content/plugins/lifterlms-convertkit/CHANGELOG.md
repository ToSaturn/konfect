CHANGELOG
=========

v2.1.0 - 2019-03-18
-------------------

##### Updates

+ **Important: This update raises the LifterLMS Core version requirement to 3.29.0. Please upgrade the LifterLMS core if you haven't already done so.**
+ Added an option to allow LifterLMS native ecommerce purchases to be synced to ConvertKit using the ConvertKit purchases API, enabling automations based on purchases.
+ Added additional options when using LifterLMS with WooCommerce to ensure consenting customers are subscribed via LifterLMS ConvertKit registration and enrollment automations.
+ Added custom field mapping to allow automatic population of ConvertKit custom fields with data from LifterLMS registration, checkout, and enrollment fields.
+ "Consent" requirements may now be disabled a single line of code: `add_filter( 'llms_ck_enable_consent', '__return_false' )`.
+ API errors are now logged to a "convertkit" file isolated from the main LifterLMS log file.
+ Improved data validation for all settings submitted via forms on the admin panel.
+ Reorganized the settings screen for increased visual clarity.

##### Bug Fixes

+ Fixed a LifterLMS core 3.29.0 compatibility issue preventing consent from being saved properly during new user registration via the checkout/enrollment screen.
+ Resolved an issue allowing the consent and unsubscribe notice message options to show as empty or blank on the integration settings screen.

##### Deprecated Functions

**These functions, methods, and classes have been marked as deprecated and will be removed during our next major update. Custom code should be modified to use replacements as soon as possible.**

+ Deprecated `LLMSCK()`, use `LLMS_ConvertKit()->api()` instead.
+ Deprecated class `LLMS_ConvertKit_Api`, use `LLMS_CK_API` instead.


v2.0.1 - 2018-06-14
-------------------

+ When adding or changing API keys, test calls will be made to check if the keys are functional. If they are not a warning will be displayed.
+ Fixed issue preventing cached tags and sequences from being cleared by the button on the integration settings
+ Deprecated `LLMS_ConvertKit_Api->clear_cache()`, use `$skip_cache` when calling api class methods to bypass cached results. This function should no longer be used by third party integrations, custom plugins, or themes as it will be removed in the next major version.


v2.0.0 - 2018-05-18
-------------------

+ **Removes LifterLMS 2.x compatibility, raising the minimum required LifterLMS version to 3.8.0**
+ Adds a checkbox to enrollment, registration, and checkout forms allowing users to explicitly consent to receive emails
+ To accommodate GDPR compliance, sequences and tags will only be applied to users who have explicitly consented to receive emails.
+ Users who have previously consented to receive emails may opt out via a checkbox on the edit account tab of the student dashboard
+ New options have been added to allow customization of the consent and unsubscribe messages
+ Added Privacy Policy Suggested content linking to the ConvertKit Privacy Policy. Relies on WP 4.9.6.
+ In addition to an API Key, a Secret Key must also be obtained to API methods to unsubscribe users
+ Class `LLMS_Settings_Integrations_ConvertKit` has been replaced by `LLMS_Integration_ConvertKit` which is an integration child accessible programattically via `LLMS()->integrations()->get( 'convertkit' )`
+ Renamed plugin options to be consistent with other LifterLMS integration classes. Preexisting options will be renamed automatically upon plugin upgrade.


v1.0.4 - 2016-10-04
-------------------

+ Add compatibility for LifterLMS 3.0.0
+ This release is fully compatible with both LifterLMS 2.x and LifterLMS 3.x


v1.0.3 - 2016-04-28
-------------------

Sorry! I never updated the version number at 1.0.2 so there was an infinite and unresolvable update loop. This release resolves that.


v1.0.2 - 2016-04-28
-------------------

+ Update membership tag & sequence application to run of new LifterLMS action `llms_user_added_to_membership_level`


v1.0.1 - 2016-03-07
-------------------

+ Updated ConvertKit "Courses" to the new "Sequences"


v1.0.0 - 2016-03-07
-------------------

+ Initial public release

v0.1.0 - 2015-12-31
-------------------

+ Initial private beta release
