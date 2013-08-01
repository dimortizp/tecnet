$(document).ready(function(){
	var reporteHistorial = (function(){
		var doc, tipoHistorial,tipoDoc,consultBtn,plantillaHistorial;
		/*_________________Funciones_________________*/
		var init = function(config){
			doc = config.doc;
			tipoDoc = config.tipoDoc;
			historialData = $("#TemplateContent");
			plantillaHistorial = $("#historialTemplate");
			consultBtn = config.consultBtn;
			bindEvents();
		},
		bindEvents = function(){
			$("#configContent").find("input[type=radio]").each(function(i,item){
				$(item).click(function(){
					showTypeDoc($(item));	
				});
			});
			consultBtn.on('click',function(){
				consultarHistorial();
			});
		},
		showTypeDoc = function (item) {
			if(item.val() === "clt"){
				$("#contentTipDoc").css('display','inline-block');
			}else{
				$("#contentTipDoc").css('display','none');
			}
		},
		consultarHistorial = function(){
			console.log(url);
			var typeConsult = $('input[name=tipoHistorial]:checked').val();
			if(typeConsult !== undefined){
				$.ajax({
					type:'POST',
					url:url,
					dataType: "json",
					data: {
						typeConsult:typeConsult, 
						doc: doc.val(), 
						tipoDoc : tipoDoc.val()
					},
					success:function(data){
						showHistorialData(data);
					},
					error:function(){
						historialData.html('');
						alert("La busqueda no fue exitosa, verifique los datos por favor");
					}
				});
			}			
		},
		showHistorialData = function(data){
			var template = Handlebars.compile(plantillaHistorial.html());
            var contenido = template(data);           
            historialData.html(contenido);
        };

		return {
			init:init
		}	
	})();

	reporteHistorial.init({
		doc : $("#idConsult"),
		tipoDoc :$("#tipoDoc"),
		consultBtn : $("#consultBtn")
	});
});
