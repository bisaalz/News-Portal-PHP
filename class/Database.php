<?php  
	abstract class Database{
		protected $conn =  null;
		protected $sql 	=  null;
		protected $stmt =  null;
		protected $table = null;
		
		public function __construct(){
			/*DB Connection*/
			try{

				$this->conn = new PDO("mysql:hosts=".DB_HOST.";dbname=".DB_NAME.";" ,DB_USER, DB_PWD);

				$this->conn->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$this->sql = "SET NAMES utf8";
				$this->stmt = $this->conn->prepare($this->sql);
				$this->stmt->execute();

				} catch(PDOException $e){
				$message = date('Y-m-d H:i:s')." Connection(PDO): ".$e->getMessage()."\r\n";
				error_log($message, 3, ERROR_LOG);
				
				// 2019-03-24 04:05:03 Connection(PDO): Table not Found.
				//2019-03-25  02:03:25 Connection(PDO): Connection establishment unsucessful.
				}catch(Exception $e){

				$message = date('Y-m-d H:i:s')." Connection(General): ".$e->getMessage()."\r\n";

				error_log($message, 3 , ERROR_LOG);

				}

				}
				final protected function table($_table){
				$this->table = $_table;
				}

		final protected function select($args = array(), $query_debug= false){
			try{

				/*
					SELECT fields FROM table 
						JOIN Clause
						WHERE Clause
						Group By clause
						ORDER By clause
						LIMIT clause


					//$sql = "SELECT * FROM users WHERE email = '".$user_name."'";
				*/
						$this->sql = "SELECT ";

						if(isset($args['fields']) && !empty($args['fields'])){
							if(is_array($args['fields'])){
								$this->sql .= implode(", ", $args['fields']);

							}else{
								$this->sql .= $args['fields'];
							}
						}else{
							$this->sql .= " * ";
						}

						$this->sql .= " FROM ";

						$this->sql .= $this->table;

						/*JOIN statement*/
						if(isset($args['join']) && !empty($args['join'])){
							$this->sql .= " ".$args['join'];
						}
						/*JOIN statement*/

						/*Where*/

						if(isset($args['where']) && !empty($args['where'])){
							if(is_string($args['where'])){
								$this->sql .= " WHERE ".$args['where'];
							}else{
								$temp = array();
								foreach($args['where'] as $column_name => $value){
									$str = $column_name." = :".$column_name;
									$temp[] = $str;
								}
								$this->sql .= ' WHERE '.implode(' AND ', $temp);
							}
						}

						/*where*/

						/*Group By*/
						/*Group By*/

						/*ORDER BY*/
						if(isset($args['order_by']) && !empty($args['order_by'])){
							$this->sql .= " ORDER BY ".$args['order_by'];
						} else {
							$this->sql .= " ORDER BY ".$this->table.".id DESC ";
						}

						/*ORDER BY*/

						if(isset($args['limit']) && !empty($args['limit'])){
							$this->sql .= " LIMIT ".$args['limit'];
						}

						if($query_debug){

							echo $this->sql;
							debug($args, true);
						}

						$this->stmt = $this->conn->prepare($this->sql);

						if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
							foreach($args['where'] as $column_name => $value){
								if(is_int($value)){
									$param = PDO::PARAM_INT;
								} else if(is_bool($value)){
									$param = PDI::PARAM_BOOL;
								} else {
									$param = PDO::PARAM_STR;

								}

								if($param){
									$this->stmt->bindvalue(":".$column_name, $value, $param);
								}
							}
						}

						//debug($this->stmt, true);
						

						$this->stmt->execute();
						return $this->stmt->fetchAll(PDO::FETCH_OBJ);

			}catch(PDOException $e){
			
			$message = date('Y-m-d H:i:s')." SELECT(PDO): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_LOG);
			return false;

				}catch(Exception $e){

			$message = date('Y-m-d H:i:s')." SELECT(General): ".$e->getMessage()."\r\n";
			error_log($message, 3 , ERROR_LOG);
			return false;

				}

		}

		public function runRaw($sql){
			$this->stmt = $this->conn->prepare($sql);
			return $this->stmt->execute();
		}

		final protected function insert($data, $query_debug = false){
			try{

				/*
					INSERT INTO table SET 
						column_name = :key,
						column_nmae_2 = :key_2;

					SELECT fields FROM table
						WHERE ......

					UPDATE table SET 
						column_name = :key,
						column_name = :key_2,....
					WHERE .......... 
				*/
						$this->sql = "INSERT INTO ";

						if(!isset($this->table) || empty($this->table)){
							throw new Exception('Table Not Set.');
						}

						$this->sql .= $this->table." SET ";

						/*JOIN statement*/
						/*JOIN statement*/

						/*Where*/

						if(isset($data) && !empty($data)){
							if(is_string($data)){
								$this->sql .= $data;
							}else{
								$temp = array();
								foreach($data as $column_name => $value){
									$str = $column_name." = :".$column_name;
									$temp[] = $str;
								}
								$this->sql .= implode(', ', $temp);
							}
						}

						/*where*/


						if($query_debug){

							echo $this->sql;
							debug($data, true);
						}

						$this->stmt = $this->conn->prepare($this->sql);

						if(isset($data) && !empty($data) && is_array($data)){
							foreach($data as $column_name => $value){
								if(is_int($value)){
									$param = PDO::PARAM_INT;
								} else if(is_bool($value)){
									$param = PDI::PARAM_BOOL;
								} else {
									$param = PDO::PARAM_STR;

								}

								if($param){
									$this->stmt->bindvalue(":".$column_name, $value, $param);
								}
							}
						}

						//debug($this->stmt, true);
						

						$this->stmt->execute();
						return $this->conn->lastInsertId();

				} catch(PDOException $e) {
			
				$message = date('Y-m-d H:i:s')." INSERT(PDO): ".$e->getMessage()."\r\n";
				error_log($message, 3, ERROR_LOG);
				return false;

				} catch(Exception $e) {

				$message = date('Y-m-d H:i:s')." INSERT(General): ".$e->getMessage()."\r\n";
				error_log($message, 3 , ERROR_LOG);
				return false;

				}

		}

		final protected function update($data, $args = array(), $query_debug = false){
			try{

				/*
					
					UPDATE table SET 
						column_name = :key,
						column_name = :key_2,....
					WHERE .......... 
				*/
						$this->sql = "UPDATE ";

						if(!isset($this->table) || empty($this->table)){
							throw new Exception('Table Not Set.');
						}

						$this->sql .= $this->table." SET ";

						/*JOIN statement*/
						/*JOIN statement*/

						/*data*/

						if(isset($data) && !empty($data)){
							if(is_string($data)){
								$this->sql .= $data;
							}else{
								$temp = array();
								foreach($data as $column_name => $value){
									$str = $column_name." = :".$column_name;
									$temp[] = $str;
								}
								$this->sql .= implode(', ', $temp);
							}
						}

						/*data*/

						/*Where*/

						if(isset($args['where']) && !empty($args['where'])){
							if(is_string($args['where'])){
								$this->sql .= " WHERE ".$args['where'];
							}else{
								$temp = array();
								foreach($args['where'] as $column_name => $value){
									$str = $column_name." = :_".$column_name;
									$temp[] = $str;
								}
								$this->sql .= ' WHERE '.implode(' AND ', $temp);
							}
						}

						/*where*/



						if($query_debug){

							echo $this->sql;
							debug($data, true);
						}

						$this->stmt = $this->conn->prepare($this->sql);

						if(isset($data) && !empty($data) && is_array($data)){
							foreach($data as $column_name => $value){
								if(is_int($value)){
									$param = PDO::PARAM_INT;
								} else if(is_bool($value)){
									$param = PDI::PARAM_BOOL;
								} else {
									$param = PDO::PARAM_STR;

								}

								if($param){
									$this->stmt->bindvalue(":".$column_name, $value, $param);
								}
							}
						}

						if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
							foreach($args['where'] as $column_name => $value){
								if(is_int($value)){
									$param = PDO::PARAM_INT;
								} else if(is_bool($value)){
									$param = PDI::PARAM_BOOL;
								} else {
									$param = PDO::PARAM_STR;

								}

								if($param){
									$this->stmt->bindvalue(":_".$column_name, $value, $param);
								}
							}
						}

						//debug($this->stmt, true);
						

					return $this->stmt->execute();
				} catch(PDOException $e) {
			
				$message = date('Y-m-d H:i:s')." UPDATE(PDO): ".$e->getMessage()."\r\n";
				error_log($message, 3, ERROR_LOG);
				return false;

				} catch(Exception $e) {

				$message = date('Y-m-d H:i:s')." UPDATE(General): ".$e->getMessage()."\r\n";
				error_log($message, 3 , ERROR_LOG);
				return false;

				}

		}




		final protected function delete($args = array(), $query_debug= false){
			try{

				/*
					DELETE FROM table
					WHERE clause


				*/
						$this->sql = "DELETE FROM ";


						$this->sql .= $this->table;

						
						/*Where*/

						if(isset($args['where']) && !empty($args['where'])){
							if(is_string($args['where'])){
								$this->sql .= " WHERE ".$args['where'];
							}else{
								$temp = array();
								foreach($args['where'] as $column_name => $value){
									$str = $column_name." = :".$column_name;
									$temp[] = $str;
								}
								$this->sql .= ' WHERE '.implode(' AND ', $temp);
							}
						}

						/*where*/

						if($query_debug){

							echo $this->sql;
							debug($args, true);
						}

						$this->stmt = $this->conn->prepare($this->sql);

						if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
							foreach($args['where'] as $column_name => $value){
								if(is_int($value)){
									$param = PDO::PARAM_INT;
								} else if(is_bool($value)){
									$param = PDI::PARAM_BOOL;
								} else {
									$param = PDO::PARAM_STR;

								}

								if($param){
									$this->stmt->bindvalue(":".$column_name, $value, $param);
								}
							}
						}

						//debug($this->stmt, true);
						

						return $this->stmt->execute();
			} catch(PDOException $e){
			
			$message = date('Y-m-d H:i:s')." DELETE(PDO): ".$e->getMessage()."\r\n";
			error_log($message, 3, ERROR_LOG);
			return false;

				} catch(Exception $e){

			$message = date('Y-m-d H:i:s')." DELETE(General): ".$e->getMessage()."\r\n";
			error_log($message, 3 , ERROR_LOG);
			return false;

				}

		}




	}