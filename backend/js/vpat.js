 function validacion() {

        indice = document.getElementById("gep").selectedIndex;
        if( indice == null || indice == 0 ) {
          return false;
        }


        indice2 = document.getElementById("grp").selectedIndex;
        if( indice2 == null || indice2 == 0 ) {
          return false;
        }

        indice3 = document.getElementById("espm").selectedIndex;
        if( indice3 == null || indice3 == 0 ) {
          return false;
        }

        indice4 = document.getElementById("pati").selectedIndex;
        if( indice4 == null || indice4 == 0 ) {
          return false;
        }

        indice5 = document.getElementById("doc").selectedIndex;
        if( indice5 == null || indice5 == 0 ) {
          return false;
        }

        indice6 = document.getElementById("lab").selectedIndex;
        if( indice6 == null || indice6 == 0 ) {
          return false;
        }



      indice7 = document.getElementById("appmont").value;
        if( indice7 == null || indice7 == 0 ) {
          return false;
        }


    }