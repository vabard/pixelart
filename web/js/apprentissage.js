
window.onload = function () {
    
    var p = {};

    document.querySelectorAll('.filterDifficulty').forEach(function (element) {
        //console.log(element);
        element.addEventListener('click', function () {
            p.difficulty = this.getAttribute('value');
            //console.log(p);
            ajaxFiltre(); 
        }); // end addEventListener'click'
    }); // end forEach
    
    document.querySelectorAll('.filterCategory').forEach(function (element) {
        //console.log(element);
        element.addEventListener('click', function () {
            p.category = this.getAttribute('value');
            //console.log(p);
            ajaxFiltre();   
        }); // end addEventListener'click'
    }); // end forEach



function html(){
    var div1 = document.createElement('div');
            div1.className = "col-sm-6 col-md-4";
    var div2 = document.createElement('div');
            div2.className = "shop-box";
    div1.appendChild(div2);
    
    var div3 = document.createElement('div');
            div3.className = "text-center div-img";
    div2.appendChild(div3);
    
    var img = document.createElement('img');
            img.className = "img-galery";
            img.setAttribute('alt', obj[i].Title);
            img.setAttribute('src', obj[i].Thumb.replace(/ /g,"+"));
    div3.appendChild(img);
    
    var div4 = document.createElement('div');
            div4.className = "shop-box-hover text-center";
    div2.appendChild(div4);
    
    var div5 = document.createElement('div');
            div5.className = "c-table";
    div4.appendChild(div5);

    var div6 = document.createElement('div');
            div6.className = "c-cell";
    div5.appendChild(div6);
    
    var link = document.createElement('a');
            link.className = "linkLearnPicture";
            link.setAttribute('href', (BASE_URL + 'apprendre-pixelart/'+ obj[i].id));
    div6.appendChild(link);   
    
    var span = document.createElement('span');
            span.className = "glyphicon glyphicon-education";
    link.appendChild(span);
    
    var textSpan = document.createTextNode(' Apprendre');
    link.appendChild(textSpan);
    
    var div7 = document.createElement('div');
            div7.className = "shop-box-title";
    div1.appendChild(div7);  
    
    var div8 = document.createElement('div');
            div8.className = "row";
    div7.appendChild(div8);  
    
    var div9 = document.createElement('div');
            div9.className = "col-xs-12";
    div8.appendChild(div9);  
    
    var p1 = document.createElement('p');
            p1.className = "gras titlePicture";
    div9.appendChild(p1);    
    
    var textP1 = document.createTextNode(obj[i].Title.slice(0, 10));
    p1.appendChild(textP1);
    
//    var p2 = document.createElement('p');
//            p2.className = "text-uppercase";
//    div9.appendChild(p2);
//    
//    var textP2 = document.createTextNode(obj[i].categories.Title);
//    p2.appendChild(textP2);
    
//    var div10 = document.createElement('div');
//            div10.className = "col-xs-6";
//    div8.appendChild(div10);      
    
//    var p3 = document.createElement('p');
//            p3.className = "text-lowercase text-right";
//    div9.appendChild(p3);    
//    
//    var textP3 = document.createTextNode(obj[i].Difficulty);
//    p3.appendChild(textP3);    
    
    var p4 = document.createElement('p');
            p4.className = "text-lowercase gras";
    div9.appendChild(p4);
    
    var textP4 = document.createTextNode('par ' + obj[i].user.Username);
    p4.appendChild(textP4);  
    
    document.getElementById('galery-section').appendChild(div1);
   
} 


                
    /*parametres += $(par).val().slice(0,-1);*/

    function ajaxFiltre() {

        /* PARAMETRES */
        var param = "";
        for (var prop in p) {
            param += prop + '=' + p[prop] + '&';
            //console.log(param);
        }
        param = param.slice(0, -1);
        console.log(param);

        /* FICHIER CIBLE */
        var file = BASE_URL + 'api/pictures';

        /* création de l'objet ajax */
        if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        } else {
            var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        // on prépare la connexion
        xhttp.open("POST", file, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour methode POST


        xhttp.onreadystatechange = function () {
            if (xhttp.status == 200 && xhttp.readyState == 4) {
                //console.log(xhttp.responseText);

                // création de l'objet JS
                obj = JSON.parse(xhttp.responseText);
               // console.log(obj);
                if(obj.length !== 0){
                    document.getElementById('galery-section').innerHTML = '';

                    // on place la réponse dans l'element
                    for (i = 0; i < obj.length; i++) {
                        //console.log(obj[i]);
                        html();
                    }     
                } else {
                    document.getElementById('galery-section').innerHTML = 'toto';
                }
                
                
            }
        }

        // on envoie les infos
        xhttp.send(param);

    } // end function ajaxFiltre()
}
