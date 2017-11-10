#active~star
Added a lot of missing translations.

#pending~clock
Fix fullordering on admin/listings.
Fix unable to publish/unpublish on admin/listings.
Add translations to Table Headers like 'Listing name' etc.
Move view.html.php/page-header together with set-title into setDocument method.
Populate form type views.
Change non-list manager views to Form type (test if possible).
Change ratings icon types based on the type of ratings used.
Upgrade all views to use filters.

#postponed~flag
Add a router, 'alias' fields to tables and admin/form views.
Plan new layout for overview and planner, include legend instructions.
Overview to show only latest changelog.
Add a global notice system that shows on all admin/views.
Add badges html renderer for 'showing x of y results', 'version', etc
Post filter comment-compacting on views.
Delete UlwizSources after all functionality has been implemented on other views.
Add a maintenance view, use it to purge, refactor, and defragment datatables.

#notes~lamp
Publishing states (2 to -2): archived, published, unpublished, ??, marked for deletion.
Initialize the MT_Users component.
Learn and implement custom tasks and post-processing (try JModelForm->loadformdata).
Plan a new UI system for Submission wizard
Use a counter for ratings: rating_cache_counter, rating_cache_reset, rating_cache_value.

#cancelled~trash
Override model/getItems using com_content/articles: Not required.