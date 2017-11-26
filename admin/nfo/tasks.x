#active~star
Dir '/meta': Merge filebase and database. '/nfo.php' to '/lib/nfo/legacy.php' & '/global.php' to '/lib/cfg/global.php'.
Psuedobase class: For better usability, added to library instead of integrating with model-base.
Psuedobase directory configuration list added to /cfg/directories.xml
Changelog data converted to individual xml files for psuedobase implementation test.
Sidebar code: Hardcoded data moved to '/cfg/sidebar.xml'. Relative location of the xml file is still hardcoded.
Structural rewrite completed for upgrade to Query-Joins optimizations.
Filters are split into types using an inheritable interface on the source model-list.

#pending~clock
Refactoring ITEMS to CATALOGUES.
verify additional filters fields on items.
add contenttype to listings under 'item', and on items beside the name in brackets(or not, perhaps grey-small)
Write a new parser for nfo tasks: #section(no more translation), colour, icon, description
complete renderer code for clog/tasks in '/lib/nfo/tasks.php'
New layout for planner/tasks: 'css-grid' blocks auto arranged, colours kept in cfg/*.xml.
New layout for Overview.
Write code for Manifest.
Add system: Legend Instructions.
Add system: Global Notice.
Plan splitting tasks using new type of categorisation.
add styling to psuedo-pagination table and selected item.

#postponed~flag
delete mt folder from lib by moving code to model-base
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