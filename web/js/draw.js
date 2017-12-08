/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

window.onload = function(){
    
    // Variables
    var x;
    var y;
    var step = 30;
    var color;
    
    var tabCanvas = [];
    
    var eltCanvas = document.getElementById('canvas');
    var context = eltCanvas.getContext('2d');

    var elemLeft = eltCanvas.offsetLeft;
    var elemTop = eltCanvas.offsetTop;
    
    
  
    // Function - Creation de la GRILLE VIDE
    function drawGridEmpty(x, y, step){        

        for (var i = 0; i < y; i++) {

            for (var j = 0; j < x; j++) {

                context.strokeStyle="rgb(166,166,166)"; // couleur de la bordure (grey)
                context.strokeRect(j * step, i * step, step, step); // carée vide
            }
        } //endfor           
    } // end function drawGridEmpty
        

    // Function - Récuperation de la position sur click
    eltCanvas.addEventListener('click', function(event) {
        
        //recuperation de la position
        var x1 = event.pageX - elemLeft;
        var y1 = event.pageY - elemTop;
        // console.log(x1, y1);

        // récupération d'entier 
        var x2 = Math.trunc(x1/step);
        var y2 = Math.trunc(y1/step);
        // console.log(x2, y2);

        //Coloration du carrée
        var color = "green";
        context.fillStyle = color;
        context.clearRect(x2*step, y2*step, step, step); // on enleve le carée existant
        context.fillRect(x2*step, y2*step, step, step); // creation d'un carée coloré

        //on ajoute les coordonnées dans un array
        tabCanvas.push([x2,y2,color]);

        // conversion de notre tableau des tableaux en une chaine de catachteres avec separateur '-'
        // pour l'injecter ensuite dans bdd
        var elementsString = tabCanvas.join('-');
        console.log(elementsString);

        // elements.forEach(function(element) {
        //     if (y > element.top && y < element.top + element.height && x > element.left && x < element.left + element.width) {

        //     }
        // });

    }, false); // end Event Click     
    
    
}// end window onload


