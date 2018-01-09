#active~star


#pending~clock
Dummy subform for 'fetch' wondering whether I should save the data in the db, even temporarily.
Ethics: Relational Tables(Except Rating Tables) are SECONDARY DATA. Primary data are the comma delimited STR fields.
Fix multi-choice hints not shown.
Figure out SQL for genres spanned data.
Add <tag-type-icons>, one each genre after alias.

#postponed~flag
Add new name-display-order field-type and add to global config. (later, required on frontend)
Write a view-list fieldtype referencing '/cfg/views.xml'
Figure out Genre filter field and apply (Need SQL syntaces)
Add MVC/RatingGenres.
Fix MVC/RatingCatalogues.
Rewrite and apply final manager code to all other manager views.
Cleanup and finalise all MVC list view codes for 'alpha' stage.
Regroup global config after manager code is complete. (Remember: note/spacer field types can be used to imitate grouping visuals)
Add systems: Legend Instructions, Global Notice, ViewType specific DebugBox.
Escape all helper methods (pending answer/solution).
For all MVCs, add filter system, comment-compacting.

NFO
New layout for Overview.
Write code for Manifest.
add styling to psuedo-pagination table and selected item.
Plan splitting tasks using new type of categorisation.
Write a new parser for nfo tasks: #section(no more translation), colour, icon, description
Complete layout renderer code for clog/tasks in '/lib/nfo/tasks.php': 'css-grid' blocks auto arranged.
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
Router. ID migration
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