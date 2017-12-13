#active~star


#pending~clock
Fix multi-choice custom types not working. https://forum.joomla.org/viewtopic.php?t=640264
Fix multi-choice hints not shown.
Add <tag-type-icons>, one each genre after alias.

#postponed~flag
Write a view-list fieldtype referencing '/cfg/views.xml'
Figure out Genre filter field and apply (Need SQL syntaces)
Add systems: Legend Instructions, Global Notice, ViewType specific DebugBox.
Add MVC/RatingGenres.
Fix MVC/RatingCatalogues.
Rewrite and apply final manager code to all other manager views.
Write a new parser for nfo tasks: #section(no more translation), colour, icon, description
complete renderer code for clog/tasks in '/lib/nfo/tasks.php'
New layout for planner/tasks: 'css-grid' blocks auto arranged.
New layout for Overview.
Write code for Manifest.
Plan splitting tasks using new type of categorisation.
add styling to psuedo-pagination table and selected item.
Plan ajax routing through standalone/absolutely referenced php for form-view db-auto-fetch (JResponseJson).
Regroup global config after manager code is complete. (Remember: note/spacer field types can be used to imitate grouping visuals)
Escape all helper methods (pending answer/solution).
For all MVCs, add filter system, comment-compacting.
Cleanup and finalise all MVC list view codes for 'alpha' stage.
Add accesslog for recording which user visited which listing (would be helpful in determining moles)
Add errorlog for recording captcha failures/brute-force-attacks.

Form Mechanics Notes:
Reset recentedit to 0 if author saves an edit.
Write handlers for rating an other cache methods.
New layout and html-modules for Rating form views.
Register new tasks to enable btn-group options in the manager-view 'state' column.
Site:
Plan a new UI system for Submission wizard

#ideas~lamp
Router.
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
Delete UlwizSources: Only after all functionality is analysed and integrated.
Merge ratings and reviews for catalogues: pointless when db-Joins are available.