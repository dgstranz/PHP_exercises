<?php

$add_movie_fields = ['movie_name', 'movie_type', 'movie_year', 'movie_director', 'movie_leadactor'];

$edit_movie_fields = $add_movie_fields;
	array_unshift($edit_movie_fields, 'movie_id');

$add_person_fields = ['people_fullname', 'people_isactor', 'people_isdirector'];

$edit_person_fields = $add_person_fields;
	array_unshift($edit_person_fields, 'people_id');

?>