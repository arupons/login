
        $( "#mobil > a" ).hover(
          function() {
            $( '#menuS' ).addClass( "icon-orange" );
          }, function() {
            $( '#menuS' ).removeClass( "icon-orange" );
          }
        );
        
        $( document ).ready(function() {
          if($( window ).width()<964)
          {            
            $( "#mobil" ).show();
            $( "#menuB" ).hide();
            $( "#menuS" ).show();
            $( "#Empresa" ).hide();
            $( "#nbft").css( "margin-top", "-70px" ); //hide();//para posicionar correctamente gracias pe
          }
          else
          {
            $( "#mobil" ).hide();
            $( "#menuB" ).show();
            $( "#menuS" ).hide();
            $( "#Empresa" ).show();
            $( "#nbft").css( "margin-top", "0px" );
          }
        });
				$( window ).resize(function() {
          if($( window ).width()<964)
          {
            $( "#mobil" ).show();
            $( "#menuB" ).hide();
            $( "#menuS" ).show();
            $( "#Empresa" ).hide();
            $( "#nbft").css( "margin-top", "-70px" );
          }
          else
          {
            $( "#mobil" ).hide();
            $( "#menuB" ).show();
            $( "#menuS" ).hide();
            $( "#Empresa" ).show();
            $( "#nbft").css( "margin-top", "0px" );
          }
        });