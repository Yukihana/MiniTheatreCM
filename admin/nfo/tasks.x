#active~star
Added MVC/Catalogues and removed MVC/Items. (Refactors on other views pending)
Complete rewrite of the component options and its handler class.
Updated Menus and Configurations to prepare for upcoming changes.
Manager HTML-renderer code has been re-written from scratch to match current manager code.
Added filters: state,access, ctype,franchise, author,recentedit with respective field classes.
Cleaned up 80 KBs of outdated library classes and data drivers.

#pending~clock
Write a view-list fieldtype referencing '/cfg/views.xml'
Figure out Genre filter field and apply (Need SQL syntaces)
Manager concept: Ctype after Name(same line), Line#2 alternates between alias/genres where required. Or 'Mouse over for genres'?
- Genres cannot have a separate column, so they have to piggyback on other columns. Only choice: Main column.
Add systems: Legend Instructions, Global Notice, ViewType specific DebugBox.

Add MVC/RatingGenres.
Fix MVC/RatingCatalogues.
Rewrite and apply final manager code to all other manager views.
add contenttype to listings under 'item', and on items beside the name in brackets(or not, perhaps grey-small)

Non-critical:
Write a new parser for nfo tasks: #section(no more translation), colour, icon, description
complete renderer code for clog/tasks in '/lib/nfo/tasks.php'
New layout for planner/tasks: 'css-grid' blocks auto arranged.
New layout for Overview.
Write code for Manifest.
Plan splitting tasks using new type of categorisation.
add styling to psuedo-pagination table and selected item.

#postponed~flag
Regroup global config after manager code is complete. (Remember: note/spacer field types can be used to imitate grouping visuals)
Escape all helper methods (pending answer/solution).
Plan code minimization on model function overrides now that a model base is present.
For all MVCs, add filter system, comment-compacting.
Cleanup and finalise all MVC list view codes for 'alpha' stage.
Remove MTmodelhelper, move to src model, use class inheritance.
Add accesslog for recording which user visited which listing (would be helpful in determining moles)
Add errorlog for recording captcha failures/brute-force-attacks.

Form Mechanics Notes:
Reset recentedit to 0 if author saves an edit.
Write handlers for rating an other cache methods.
New layout and html-modules for Rating form views.
Register new tasks to enable btn-group options.
Site:
Plan a new UI system for Submission wizard

#ideas~lamp
Router.
Cache for ratings: tick, reset-marker, value.
Overview, Planner, ID migration log.
Maintenance, Error/Access-Log.

#notes~tag-2
Publishing states (2 to -2): archived, published, unpublished, ??, marked for deletion.
state (current request/page only), and userstate (persists for the entire session).
Allow only J<name> and JGLOBAL_<name> translations from core joomla.
Reg task @ controller ctor. Then controller->taskname() calls model->taskname()[post processing].
Add and Add to MT_Users: Issues, Feedback

#trashed~trash
Override model/getItems using data from com_content/articles: Not required.
Add error-log location to global configuration: Php can auto-fetch location.
Delete UlwizSources: Only after all functionality is analysed and integrated.
Add View-All checkbox option to tab/pager views: Impractical for these layouts.
Merge ratings and reviews for catalogues: pointless when db-Joins are available.