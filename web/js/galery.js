//var canvas = document.getElementById("canvas-learn");
//
//zoom=document.getElementById("zoom");
//zoom.addEventListener("click",function(){
//   canvas.width=1.1*canvas.width;
//   canvas.height=1.1*canvas.height;
//   drawGrid(grid,canvas);
//})
//
//dezoom=document.getElementById("dezoom");
//dezoom.addEventListener("click",function(){
//   if(canvas.width>50){
//   canvas.width=0.9*canvas.width;
//   canvas.height=0.9*canvas.height;
//   drawGrid(grid,canvas);}
//})

// AJAX  - RECUPERATION
function editAjax(id) { // cette fonction est declarée dans apprendre-pixelart.html.twig

    $.ajax({
        url: BASE_URL + 'api/picture/' + id, // page cible avec id récupéré via template twig
        data: 1, // les parametres
        dataType: "json", // le format des données de retour
        success: actionAjax // on lance la fonction en cas de succes de requette ajax
    }); // end $.ajax

}//end function editAjax


// ACTION AJAX
function actionAjax(responseData) {
    var obj = JSON.parse(responseData.canvas);
    animation = obj.data;
    //console.log(animation);
    init();
}

// PICTURE
function createPicture(color) {

    // 1. Je crée un li vide et un span
    var li = document.createElement('li');
    var span = document.createElement('span');

    // 2. J'ajoute les classe et le style a mon span
    span.className = "glyphicon glyphicon-stop";
    span.style.color = color;

    // 3. je selectionne un ul existant
    var ul = document.querySelector('#colors');

    // 4. j'ajoute mon span dans li et li dans ul
    li.appendChild(span);
    ul.appendChild(li);
}
