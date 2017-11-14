#0.0.12 E~13-11-2017
Fixed 'publish' not working.
Updated SQL definitions for all tables.
Moved helpers/nfo.php to lib/mt/nfo.php.
Added Admin/Listing form view.
Added translations to Table Headers like 'COLUMNHEADER_LISTINGNAME'.

#0.0.12 D1~10-11-2017
Fixed admin/listings fullordering not working.
Fixed column header not showing directional arrow on default state.
Added a lot of missing translations, cleaned up unused libraries.
Write custom translations for fullordering. Make 'id desc' the default order.
Add minitheatre folder to lib, and move mt specific helpers.

#0.0.12 D~10-11-2017
Added a custom renderer for messages that can parse and translate arrays.
Standardised sql table definition for items.
Upgraded site/item code to conform to the new system.
Added a basic tablayout to site/items. Pending actual design and content.
Changed #__mtcm_metadatas to #__mt_shared, and updated tables.
Fixed footer colspan values for all manager-list views.
Upgraded admin/listings to use non tutorial filters.(not fully functional yet)

#0.0.12 C~04-11-2017
Fixed default_view global parameter.
Removed bloat layout data from Overview.
Added and Implemented a central indexing for tables at admin/meta/config.php.
Added and Implemented ManagerFields renderer to help populate table-cells.
Added JTable classes, SQL definitions and admin MVC lists for 'ratings'. (Reinstall required)
Compacted method comments to optimize file sizes.
Fixed irregular responsive columns for many manager views.

#0.0.12 B2~01-11-2017
Created a paging API, added to library.
Moved required JS and CSS to media directory.
Optimized API calling and dependency syntax to simplify implementation.
Created an 'include' API system for indexing and loading php/css/js files based on required tasks.
Created a planner view and moved the changelog and roadmap data to here from 'overview'.
Implemented the new paging API on the tasks and changelog psueodules: Success.
Optimized a few sections using the new API.

#0.0.12 B1~31-10-2017
Styling added for Changelogs and Tasks.
Started making changes for adding an API library.
Started moving custom CSS and JS to designated media folders.

#0.0.12 A4~30-10-2017
Added Custom Pagination to Admin/Overview/ChangeLog.
Attempted the most basic use of forms on Admin/Genre.Edit to some success.
Added helpers/html.php to help with layout rendering. Might move this to a admin/lib directory later.

#0.0.12 A3~30-10-2017
Added ChangeLog to Admin/Overview. Moving it over to advanced overview is pending.
Added NFO folder for storing roadmap, planner, version, changelog and other metadata.
Added helpers/nfo.php to act as a model for NFO data.
Added layout to Admin/Reviews
A few required changes done to database. Upgrade code hasn't been added. Prior uninstall required.

#0.0.12 A2~28-10-2017
Added Admin/Listings MVC table
Fixed an error with Admin/Reviews (Layout still pending)
Upgraded Site/EditListing to a better data-model.
Added submenu items to the toolbar menu for the component.
Added a basic frame for a site end model-helper class.

#0.0.12 A1~26-10-2017
Added a basic frame to Admin/Franchises.
Upgraded Admin/Genres code to somewhat usable.
Solified the implementation of the model helper class. Added basic code to it.

#0.0.12~26-10-2017
Added Global Configurations.
Added a basic frame for Admin/Genres.
Planned a basic implementation for a Model Helper class to optimize code efficiency.

#0.0.11 X12~23-10-2017
Added Admin/ContentType as a final replacement for ulwizsources.
ContentType will act as the primary category system and also contain custom uploader code.
Upgraded Site/MyListings to JModelList API over its previously inadequate JModelAdmin API.
Added Site/MyReviews view-set with basic code.
Minor upgrade for Site/Item to better, and current code.

#0.0.11 X10~10-10-2017
Added a basic framework for My-Listings, EditListing views on site-end.
Added some translations.
Added Database definition modifications as per requirements.

#0.0.11 X7~01-10-2017
Added additional views.
Planning actual database fields.
Trying to implement similar data onto other views.

#0.0.11 X1~18-09-2017
Added a few provisional blank views(frontend). MVC implementation pending.
Acquiring: SQL syntaces.
Ditching tutorial based SQL schema for a more robust, relevant one.
Added a few provisional tables to meet the projected tasks of this component.
Upgrade existing 'MyISAM' data-tables(as in tutorials) to their InnoDB counterparts.

#0.0.11~12-09-2017
Tutorial: Add Verification. (I think they meant to say Validation).
Minor repurposing. Large one pending, perhaps. Database implementation pending.
Minor refactoring, translation changes. 1 pending.
Learnt how to use RegEx formatting, required for validation.

#0.0.10D~11-09-2017
Git: Added an updated git repo inclusive of major previous versions.
Applied: Publish, Unpublish, Archive, Trash options.
Several minor optimizations done to code and a few translations changed.

#0.0.10~09-09-2017
Tutorial: Added 'search' and 'filter' interfaces to management.
Several translations added and optimized.

#0.0.9R~07-09-2017
Start of repurposing contents to meet site requirements.
Refactor elements to match context: Done
Rename Database-Table(s): Done

#0.0.9~01-09-2017
Several tutorials completed.
Start of development alongside advanced tutorials

#0.0.1~28-08-2017
Start tutorial by using a basic 'Hello World' project.