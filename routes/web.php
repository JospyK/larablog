<?php

#visitors links
Route::group(['middleware' => ['visitors']], function(){
	Route::get ('/login', "LoginController@login");
	Route::post('/login', "LoginController@postLogin");

	Route::get('/forgot-password',  "ForgotPasswordController@forgotPassword");
	Route::post('/forgot-password', "ForgotPasswordController@postForgotPassword");

	Route::get('/reset/{email}/{resetCode}',  "ForgotPasswordController@resetPassword");
	Route::post('/reset/{email}/{resetCode}', "ForgotPasswordController@postResetPassword");

	Route::get('/activate/{email}/{activationCode}', "ActivationController@activate");
});

#dashboard index
Route::group(['middleware' => ['has_any_role'], 'prefix' => 'dashboard/'], function() {
	Route::get('/',				['as'=>'dashboard', 	'uses'=>'DashboardController@getDashboardIndex']);
});


#complete dashboard
Route::group(['middleware' => ['has_any_role'], 'prefix' => 'dashboard/blog'], function() {

	Route::get('posts/all',			['as' => 'posts.all', 		'uses' => 'PostController@all']);		#all posts		
	Route::get('posts/trashed',		['as' => 'posts.trashed', 	'uses' => 'PostController@trashed']);	#trashed	
	Route::get('posts/{id}/kill',	['as' => 'posts.kill', 		'uses' => 'PostController@kill']);		#kill
	Route::get('posts/{id}/restore',['as' => 'posts.restore', 	'uses' => 'PostController@restore']);	#restore	
	Route::delete('posts/{id}/',	['as' => 'posts.destroy',	'uses' => 'PostController@destroy']);	#destroy
	Route::get('posts/{id}/delete',	['as' => 'posts.delete',	'uses' => 'PostController@destroy']);	#delete
	
	#preview
	Route::get('posts/preview/{slug}/',['as' => 'posts.preview','uses' => 'PostController@preview'])->where('slug','[\w\d\-\_]+');

	Route::resource('posts', 	 	'PostController');
	Route::resource('tags', 	 	'TagController',	 ['except' => ['create']]);
	Route::resource('categories',	'CategoryController',['except' => ['create']]);
	Route::resource('comments',	 	'CommentsController',['except' => ['create', 'show', 'index']]);
	Route::resource('users', 	 	'UserController',	 ['except' => ['edit']]);
	Route::resource('messages',		'MessagesController',['except' => ['create', 'show','edit', 'update']]);

	#comments
	Route::get('comments/{id}/edit', 	['as' => 'comments.edit',  	'uses' => 'CommentsController@edit']);
	Route::put('comments/{id}/', 		['as' => 'comments.update',	'uses' => 'CommentsController@update']);
	Route::delete('comments/{id}/', 	['as' => 'comments.destroy','uses' => 'CommentsController@destroy']);
	Route::get('comments/{id}/delete',	['as' => 'comments.delete',	'uses' => 'CommentsController@delete']);

	Route::delete('categories/{id}/',	['as' => 'categories.destroy','uses' => 'categoryController@destroy']);
	Route::delete('tags/{id}/',	 		['as' => 'tags.destroy',	'uses' => 'tagController@destroy']);

//Notificaitons
	Route::get('markasread',	 			['as' => 'notification.markAsRead',	'uses' => 'NotificationController@markAsRead']);
	Route::post('messages/notification',	['as' => 'messages.notification', 'uses' => 'MessagesController@notification']);
	Route::get('messages/{id}/important',	['as' => 'messages.important', 'uses' => 'MessagesController@important']);		
	Route::get('/timeline',		['as'=>'timeline',		'uses'=>'PagesController@getTimelineTest']);

	#research
	Route::post('search/', ['as'=>'dash.search', 'uses'=>'SearchController@results']);
});


Route::group(['middleware' => ['has_any_role']], function() {
	Route::post('/logout', "LoginController@logout"); #logout
});

#registration
Route::get ('/register', ['as'=>'register', 'uses'=>'RegistrationController@register']);
Route::post('/register', "RegistrationController@postRegister");


#statut des posts
Route::group(['middleware' => ['admin'], 'prefix' => 'dashboard/blog'], function(){
	Route::post('posts/{id}/accept', 	['as'=>'posts.accept', 	'uses'=>'PostStatutController@postAccept']);
	Route::post('posts/{id}/refuse', 	['as'=>'posts.refuse', 	'uses'=>'PostStatutController@postRefuse']);
	Route::post('posts/{id}/askEdit', 	['as'=>'posts.askEdit', 'uses'=>'PostStatutController@askForEdit']);
});

//Le reste est accessible a tout le monde
Route::get('blog', 		   				['as' => 'blog.index', 		'uses' => 'BlogController@getIndex']);
Route::get('blog/category/{category}',	['as' => 'blog.category',	'uses' => 'BlogController@getCategory']);
Route::get('blog/tag/{tag}',		 	['as' => 'blog.tag',		'uses' => 'BlogController@getTag']);
Route::get('blog/users/', 				['as' => 'blog.users',		'uses' => 'BlogController@getUsers']);
Route::get('blog/users/{name}', ['as' => 'blog.users',		'uses' => 'BlogController@getUserPosts']);
Route::get('blog/{slug}',  		['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::post('/contact', ['as' => 'postCcontact', 	'uses' => 'PagesController@postContact']);
Route::get('/contact', 	['as' => 'getContact', 		'uses' => 'PagesController@getContact']);

Route::get('/about', ['as' => 'about', 		'uses' => 'PagesController@getAbout']);
Route::get('/',		 ['as' => 'home', 		'uses' => 'PagesController@getIndex']);

Route::post('comments/{post_id}',	['as' => 'comments.store', 	'uses' => 'CommentsController@store']);

Route::post('blog/search/', ['as'=>'blog.search', 'uses'=>'SearchController@blogresults']);