<?php 

	try{

		$connection = new PDO("mysql:host=localhost;dbname=filmlist", "root", "");
	
	}catch(PDOException $e){
		echo "<h3>Sorry, Database is temporary is unavailable</h3>";
	}

	function addUser($email, $password, $full_name){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				INSERT INTO users (id, email, password, full_name)  
				VALUES (NULL, :u_email, :u_password, :u_full_name)
			");

			$query->execute(array(
				"u_email"=>$email,
				"u_password"=>$password,
				"u_full_name"=>$full_name
			));

			$result = $connection->lastInsertId();

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function getUser($email){
				
		global $connection;

		$result = null;

		try{

			$query = $connection->prepare("
				SELECT * FROM users WHERE email = :u_email 
			");

			$query->execute(array(
				"u_email"=>$email
			));

			$result = $query->fetch();

		}catch(Exception $e){
			
			$result = null;

		}

		return $result;
	}


	function updateUser($id, $full_name){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				UPDATE users  
				SET full_name = :full_name
				WHERE id = :id
			");

			$query->execute(array(
				"id"=>$id,
				"full_name"=>$full_name
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function updatePassword($id, $password){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				UPDATE users  
				SET password = :password
				WHERE id = :id
			");

			$query->execute(array(
				"id"=>$id,
				"password"=>$password
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function addPasswordHistory($user_id, $password){

		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				INSERT INTO password_histories (id, user_id, password, assigned_time)   
				VALUES (NULL, :user_id, :password, NOW())
			");

			$query->execute(array(
				"user_id"=>$user_id,
				"password"=>$password
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;
	}

	function getPasswordHistory($user_id, $password){
		
		global $connection;

		$result = null;

		try{

			$query = $connection->prepare("
				SELECT * FROM password_histories WHERE user_id = :user_id AND password = :password  
			");

			$query->execute(array(
				"user_id"=>$user_id,
				"password"=>$password
			));

			$result = $query->fetch();

		}catch(Exception $e){
			
			$result = null;

		}

		return $result;

	}



	///////////////// FILMS /////////////////


	function addFilm($name, $description, $genre_id, $rating, $year){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				INSERT INTO films (id, name, description, genre_id, rating, year)
			    VALUES (NULL, :name, :description, :genre_id, :rating, :year)
			");

			$query->execute(array(
				"name"=>$name,
				"description"=>$description,
				"genre_id"=>$genre_id,
				"rating"=>$rating,
				"year"=>$year
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}


	function getAllFilms(){
		
		global $connection;

		$result = null;

		try{

			$query = $connection->prepare("
				SELECT f.id, f.name, f.description, f.year, f.rating, f.genre_id, f.likes, g.name AS genre_name 
				FROM films f 
				INNER JOIN genres g ON g.id = f.genre_id 
				ORDER BY f.rating DESC 
			");

			$query->execute();
			$result = $query->fetchAll();

		}catch(Exception $e){
		
		}

		return $result;

	}

	function getFilm($id){
		
		global $connection;

		$result = null;

		try{

			$query = $connection->prepare("
				SELECT f.id, f.name, f.description, f.year, f.rating, f.genre_id, f.likes, g.name AS genre_name  
				FROM films f 
				INNER JOIN genres g ON g.id = f.genre_id 
				WHERE f.id = :id
			");

			$query->execute(array("id"=>$id));
			$result = $query->fetch();

		}catch(Exception $e){
		
		}

		return $result;

	}

	function saveFilm($id, $name, $description, $genre_id, $rating, $year){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				UPDATE films 
				SET name = :name, 
				description = :description,
				genre_id = :genre_id,
				rating = :rating,
				year = :year
				WHERE id = :id
			");

			$query->execute(array(
				"id"=>$id,
				"name"=>$name,
				"description"=>$description,
				"genre_id"=>$genre_id,
				"rating"=>$rating,
				"year"=>$year
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function saveFilmLikes($id, $likes){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				UPDATE films 
				SET likes = :likes 
				WHERE id = :id
			");

			$query->execute(array(
				"likes"=>$likes,
				"id"=>$id
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function countLikes($film_id){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				SELECT COUNT(id) as like_amount FROM film_likes 
				WHERE film_id = :film_id 
			");

			$query->execute(array("film_id"=>$film_id));
			$result = $query->fetch()['like_amount'];

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function addFilmLikes($film_id, $user_id){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				INSERT INTO film_likes (film_id, user_id) 
				VALUES (:film_id, :user_id)
			");

			$query->execute(array(
				"film_id"=>$film_id,
				"user_id"=>$user_id
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function removeFilmLikes($film_id, $user_id){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				DELETE FROM film_likes WHERE film_id = :film_id AND user_id = :user_id 
			");

			$query->execute(array(
				"film_id"=>$film_id,
				"user_id"=>$user_id
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function countFilmUserLike($film_id, $user_id){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				SELECT COUNT(*) likes FROM film_likes WHERE film_id = :film_id AND user_id = :user_id  
			");

			$query->execute(array(
				"film_id"=>$film_id,
				"user_id"=>$user_id
			));

			$result = $query->fetch()['likes'];

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}


	function deleteFilm($id){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				DELETE FROM films WHERE id = :id 
			");

			$query->execute(array(
				"id"=>$id
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}


	function getAllGenres(){
		
		global $connection;

		$result = null;

		try{

			$query = $connection->prepare("
				SELECT * FROM genres 
			");

			$query->execute();
			$result = $query->fetchAll();

		}catch(Exception $e){
		
		}

		return $result;

	}

	function getGenre($id){
		
		global $connection;

		$result = null;

		try{

			$query = $connection->prepare("
				SELECT * FROM genres WHERE id = :id
			");

			$query->execute(array("id"=>$id));
			$result = $query->fetch();

		}catch(Exception $e){
		
		}

		return $result;

	}

	//////////////////////COMMENTS///////////////////////

	function addComment($film_id, $user_id, $comment){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				INSERT INTO comments (id, user_id, film_id, comment, post_date) 
				VALUES (NULL, :user_id, :film_id, :comment, NOW())
			");

			$query->execute(array(
				"user_id"=>$user_id,
				"film_id"=>$film_id,
				"comment"=>$comment
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}

	function getComments($film_id){
		
		global $connection;

		$result = null;

		try{

			$query = $connection->prepare("
				SELECT c.id, c.film_id, c.user_id, c.comment, c.post_date, u.full_name, u.avatar 
				FROM comments c 
				INNER JOIN users u ON c.user_id = u.id
				WHERE c.film_id = :film_id  
				ORDER BY c.post_date DESC 
			");

			$query->execute(array("film_id"=>$film_id));
			$result = $query->fetchAll();

		}catch(Exception $e){
		
		}

		return $result;

	}

	function deleteComment($comment_id, $user_id, $film_id){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				DELETE FROM comments WHERE id = :comment_id AND user_id = :user_id AND film_id = :film_id
			");

			$query->execute(array("comment_id"=>$comment_id, "user_id"=>$user_id, "film_id"=>$film_id));
			$result = true;

		}catch(Exception $e){
		
		}

		return $result;

	}

	function updateAva($id, $target){
		
		global $connection;

		$result = false;

		try{

			$query = $connection->prepare("
				UPDATE users  
				SET avatar = :avatar
				WHERE id = :id
			");

			$query->execute(array(
				"id"=>$id,
				"avatar"=>$target
			));

			$result = true;

		}catch(Exception $e){
			
			$result = false;

		}

		return $result;

	}



?>