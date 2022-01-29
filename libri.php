<HTML>
<HEAD>
   <TITLE>La mia libreria</TITLE>
   <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="TEXT/HTML; CHARSET=utf-8">
   <link href="style.css" rel="stylesheet" />
   <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
   <script src="jquery-3.4.1.js" type="text/javascript"></script>
   <!-- bootstrap CSS -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</HEAD>

<BODY>

<?php
	// includo la classe Book
	include("DataMGR/Book.php"); 

	// includo la connessione al database (var $db)
	require("DataMGR/connDB.php");

	 
	if ($erroreDB != "") {
		echo $erroreDB;
	  }
	  else {
		$listaLibri = $db->query("SELECT id_libro FROM utenti_libri JOIN utenti WHERE utenti.id_utente = 2");
		
		//if($listaLibri->rowCount()>0) { // se ci sono dei libri...
			// creo un array
			$libri = array();
			
			//$libri["books"] = array();
		
			while ($id_libro = $listaLibri->fetch(PDO::FETCH_ASSOC)){  	

				//$prova= $id_libro['id_libro'];

				$book_item = array(
					"id" => $id_libro['id_libro'],
				);
				
				//$item= $id_libro['id_libro'];
			
			array_push($libri, $book_item);

			//return $json;
			
			}
			$json = json_encode($libri); 
  
		}
?>
 
 <div id=messaggio> </div>


 <script>
 jQuery(document).ready(function() {

	var arr = '<?= $json ?>';
	const myArr = JSON.parse(arr);
	console.log(arr);
	
	//arr.forEach(item => console.log(item));

	var read_books_html=`
	<table class='table table-bordered table-hover'>
	<tr>
		<th class='w-15-pct'>Titolo</th>
		<th class='w-10-pct'>Autore</th>
		<th class='w-15-pct'>Categoria</th>
		<th class='w-25-pct'>Descrizione</th>
	</tr>`;

	for (var i = 0; i < myArr.length; i++) {
		var obj = myArr[i];
		//$("#messaggio").html("<p>"+arr[i]+"</p><br /><br />");
    	console.log(obj['id']);  

	$.ajax({
			url: ('https://www.googleapis.com/books/v1/volumes/'+ obj['id']),
			type: "GET",
		})
		.done(function (response) {
			console.log(response);
			read_books_html= read_books_html+ `
				<tr>
						<td>` + response.volumeInfo.title + `</td>
						<td>` + response.volumeInfo.authors + ` </td>
						<td>` + response.volumeInfo.categories + `</td>
						<td>` + response.volumeInfo.description + `</td>
				</tr>`
				
			$("#messaggio").html(read_books_html);
		})
		.fail(function (xhr, resp, text) {
			// stampo l'errore sulla console e sulla pagina (NB sulla pagina, solo in fase di sviluppo!!)
			console.log(xhr, resp, text);
			$("messaggio").html(xhr+resp+text);
		});
	}
   })
 
   </script>

</table>

</BODY>
</HTML>