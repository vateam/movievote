 <?php
 
 function latest_night_id(){
	$query = mysql_query("SELECT MAX(nightid) from movies");
	
	return mysql_result($query, 0);
 
 }
  

function add_movie($mdata){
	array_walk($mdata, 'array_sanitize');
	print_r($mdata);
	$data = "'" . implode("','", $mdata)."'";
	$fields =  implode(",",array_keys($mdata));
	mysql_query("INSERT INTO movies ($fields) VALUES ($data)");
	//header("Location: makenight.php?success");
	echo "INSERT INTO movies ($fields) VALUES ($data)";
	return true;
	
} 

function get_movie_datas($nightid){
	$query = mysql_query("SELECT * FROM movies WHERE  nightid = $nightid");
	$results = array();
	while($row = mysql_fetch_assoc($query)) {
		$results[] = $row;
	}
	return $results;
}

function  get_night_data($nightid){
	$query = mysql_query("SELECT nightid,nighttime,nightdate,theme FROM movies WHERE nightid = $nightid");
	$result =mysql_fetch_assoc($query);
	return $result;

}

function get_omdbapi($id){

 $json = file_get_contents("http://www.omdbapi.com/?i=". $id);
 $result = json_decode($json, true);
return $result;

}


function dl_poster($link,$name){
	$img = 'posters/'. $name.'.jpg';
	file_put_contents($img, file_get_contents($link));
	return $img;
}


 ?>