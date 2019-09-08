LifterLMS MailChimp Changelog
=============================

v3.1.2 - 2019-04-15
-------------------

+ Added an action which fires when user consent is saved.
+ Fixed an issue causing an error when saving API credentials for the first time.
+ Fixed an issue preventing subscriptions from being created when consent is disabled via the `llms_mc_enable_consent` hook.


v3.1.1 - 2019-03-08
-------------------

+ Fix an issue preventing grouping and tagging during new user registration on the enrollment/checkout screen.


v3.1.0 - 2018-08-14
-------------------

+ Adds a "Default Group" option to add interest groups to users during registration
+ Adds a new option when using WooCommerce which will add consenting users to lists and groups during account registration, checkout, and enrollment into courses and memberships through connected products
+ Added filters to allow disabling student consent requirements. Use `add_filter( 'llms_mc_enable_consent', '__return_false' );` to completely disable consent.


v3.0.0 - 2018-05-23
-------------------

+ **Removes LifterLMS 2.x compatibility, raising the minimum required LifterLMS version to 3.8.0**
+ "Confirmation Emails" subscription setting is now enabled by default when installing LifterLMS Add-on
+ Adds a checkbox to enrollment, registration, and checkout forms allowing users to explicitly consent to receive emails
+ To accommodate GDPR compliance, sequences and tags will only be applied to users who have explicitly consented to receive emails.
+ Users who have previously consented to receive emails may opt out via a checkbox on the edit account tab of the student dashboard
+ New options have been added to allow customization of the consent and unsubscribe messages
+ Added Privacy Policy Suggested content linking to the MailChimp Privacy Policy. Relies on WP 4.9.6.
+ Renamed plugin options to be consistent with other LifterLMS integration classes. Preexisting options will be renamed automatically upon plugin upgrade.
+ Moved ajax functions to their own class
+ Removed function `LLMS_MailChimp()->get_groups()`, use `LLMS_MailChimp()->get_intergration()->get_groups()` instead
+ Removed function `LLMS_MailChimp()->get_lists()`, use `LLMS_MailChimp()->get_intergration()->get_lists()` instead


v2.2.2 - 2017-06-30
-------------------

+ Use `PUT` requests to add/update list subscribers during enrollment actions. Prevents an issues preventing existing subscribers from being added to groups if they has previously been added to the list from a different source.


v2.2.1 - 2017-06-13
-------------------

+ Prevent checkboxes on settings screen from always being checked
+ Now fully translateable and i18n-friendly!


v2.2.0 - 2016-12-09
-------------------

+ Updates API to rely on [MailChimp API v3](http://developer.mailchimp.com/).
+ Added an option that enables email confirmation when adding students to lists


v2.1.4 - 2016-10-21
-------------------

+ Removed the 25-list cap so admins can select from up to 100 lists


v2.1.3 - 2016-10-04
-------------------

+ Adds compatibility for LifterLMS 3.0.0
+ This release is fully compatible with both LifterLMS 2.x and LifterLMS 3.x


v2.1.2 - 2016-06-13
-------------------

+ Resolve issue with an incorrect data type being returned which resulted in a PHP warning when adding students to MailChimp lists.


v2.1.1 - 2016-03-18
-------------------

+ Added a handling function that automatically adds a user to a group if they're already subscribed to the chosen list. This allows you to choose different interest groups for each course or membership rather than only being able to choose different lists.
+ Fixed a typo
+ Added two filters:
  + `llms_mailchimp_add_contact`: allows customization of merge field data sent to MailChimp
  + `llms_mailchimp_double_optin`: allows you to enable double optin when subscribing users to your lists


v2.1.0 - 2016-03-17
-------------------

**This version will work best with LifterLMS version 2.2.3 or later. Some new features will only be available if LifterLMS 2.2.3 is available**

+ We've updated to work with LifterLMS actions for course and membership enrollment
+ When a student is added to a course by an admin via the Students tab of a Course the user will now be added to the MailChimp list & group selected for the course
+ MailChimp lists and groups can now be configured for Memberships.
+ Users who join a membership and are auto-enrolled in multiple courses will now be correctly added to MailChimp lists and groups associated with all auto-enroll courses
+ Fixed a few code standards issues
+ Updated a few functions to have more normalized programmatic responses

v2.0.0 - 2016-02-11
-------------------

+ Deprecated reliance on the Plugin Update Checker class from the LifterLMS core in order to allow update and activation via the new free LifterLMS Helper plugin.
+ This version requires LifterLMS 1.5.0 at a minimum and will not function with older versions of LifterLMS.
+ Upgrading to v2.0.0 from older versions of LifterLMS MailChimp is easy, simply retrieve the update automatically from your WordPress installation. Please Note that after updating to v2.0.0 you will no longer be able to receive automatic updates without installing the free LifterLMS Helper plugin. Version 2.0.0 of LifterLMS (coming soon) will remove update functionality so we urge you to update to MailChimp v2.0.0 soon and install the updater plugin to continue receiving automatic updates.
+ Properly enqueue Javascript


v1.0.2 - 2015-08-18
-------------------
+ Works on PHP compatibility issues


v1.0.1 - 2015-07-31
-------------------
+ Bug Fixes


v1.0.0 - 2015-07-17
-------------------
+ Initial release
+ Activate Plugin
+ Connect to Mailchimp using API Key
+ Test Connection
+ Sync Mailchimp Lists and Groups
+ Add User to List on account registration
+ Add User to List / Group on course registration
