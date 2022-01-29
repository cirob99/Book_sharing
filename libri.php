<HTML>
<HEAD>
   <TITLE>Anna Goy - Tecnologie Web: approcci avanzati</TITLE>
   <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="TEXT/HTML; CHARSET=utf-8">
   <LINK REL="STYLESHEET" TYPE="TEXT/CSS" HREF="../anna.css">
   <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
   <script src="jquery-3.4.1.js" type="text/javascript"></script>
   
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
		$libri = array();
	  foreach ($listaLibri as $l) { // per ogni domanda
		$id = $l['id_libro'];
		$libri[] = $id;
		//echo $id;
	  }
	}
?>
 
 <span id=messaggio> </span>

 <script>
   jQuery(document).ready(function() {
	   console.log('<?= $id ?>');

	$.ajax({
			url: ('https://www.googleapis.com/books/v1/volumes/'+'<?= $id ?>'),
			type: "GET",
		})
		.done(function (response) {
			console.log(response);
			var read_books_html=`

                    <!-- start table -->
                    <table class='table table-bordered table-hover'>
                        <tr>
                            <th class='w-15-pct'>Titolo</th>
                            <th class='w-10-pct'>Autore</th>
                            <th class='w-15-pct'>Categoria</th>
                            <th class='w-25-pct'>Descrizione</th>
                        </tr>
                        <tr>
                                <td>` + response.volumeInfo.title + `</td>
                                <td>` + response.volumeInfo.authors + ` euro</td>
                                <td>` + response.volumeInfo.categories + `</td>
                                <td>` + response.volumeInfo.description + `</td>
                        </tr>
                        </table>`
			$("#messaggio").html("<p>"+read_books_html+"</p><br /><br />");
		})
		.fail(function (xhr, resp, text) {
			// stampo l'errore sulla console e sulla pagina (NB sulla pagina, solo in fase di sviluppo!!)
			console.log(xhr, resp, text);
			$("messaggio").html(xhr+resp+text);
		});
   })

   </script>
