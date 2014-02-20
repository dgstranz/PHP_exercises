<?php

// The fields that are required to perform the different actions (add, edit or delete)

$add_movie_fields = ['movie_name', 'movie_type', 'movie_year', 'movie_director', 'movie_leadactor'];

$edit_movie_fields = $add_movie_fields;
	array_unshift($edit_movie_fields, 'movie_id');

$delete_movie_fields = ['movie_id'];

$add_person_fields = ['people_fullname'];

$edit_person_fields = ['people_id', 'people_fullname'];

$delete_person_fields = ['people_id'];

?>