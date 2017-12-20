//Variables
var canvas = document.getElementById("canvas");
var color = 'black';
var cadre = document.getElementById("cadre");
var step = '';
var step2 = '';
var envoi = document.getElementById('envoi');
var envoijson = {};
var col = document.getElementById("col");
var row = document.getElementById("row");
var choix = document.getElementsByClassName("choix");
var zoom = document.getElementById("zoom");
var dezoom = document.getElementById("dezoom");
var petitrectangle = document.getElementById("petitrectangle");
var carremoyen = document.getElementById("carremoyen");
var rectanglemoyen = document.getElementById("rectanglemoyen");
var grandcarre = document.getElementById("grandcarre");
var grandrectangle = document.getElementById("grandrectangle");
var picture = '';
var difficulty ='';
var nrbcase='';


//fonctions
function Grid(wc, hc) {
    this.grid = this.init(wc, hc);
    this.wc = wc;
    this.hc = hc;
}
//objet grid
Grid.prototype.init = function (wc, hc) {
    var grid = [];
    for (var i = 0; i < hc; i++) {
        grid[i] = [];
        for (var j = 0; j < wc; j++) {
            grid[i][j] = null;
        }
    }

    return grid;
}

Grid.prototype.setWc = function (wc) {
    this.wc = wc;
    this.grid = this.init(this.wc, this.hc);
}

Grid.prototype.setHc = function (hc) {
    this.hc = hc;
    this.grid = this.init(this.wc, this.hc);
}

Grid.prototype.getWc = function (x, y) {
    return this.wc;
}

Grid.prototype.getHc = function (x, y) {
    return this.hc;
}

Grid.prototype.exportData = function () {
    var data = [];
    var i = 0;
    this.forEach(function (cell, x, y) {
        if (cell) {
            data[i++] = {
                x: y,
                y: x, // <---- C'est Johan
                color: cell
            }
        }
    });

    return data;
}

Grid.prototype.forEach = function (callback) {
    for (var i = 0; i < this.hc; i++) {
        for (var j = 0; j < this.wc; j++) {
            callback(this.grid[i][j], i, j);
        }
    }
};
Grid.prototype.setColor = function (color, x, y) {
    this.grid[x][y] = color;
}

Grid.prototype.getColor = function (x, y) {
    return this.grid[x][y];
}

Grid.prototype.clearColor = function (x, y) {
    this.grid[x][y] = null;
}

/////////////////////////////

// 

/////////////////////////////
//Dessin du canvas de départ(si l'utilisteur reprend un brouillon, un ID est passé dans le templet
if (document.getElementById("picture")) {
    picture = (JSON.parse($("#picture").val()));
    console.log(picture);
    step = picture.metadata.wc;
    step2 = picture.metadata.hc;
    grid = new Grid(step, step2);
    for (i = 0; i < picture.data.length; i++) {
        grid.setColor(picture.data[i].color, picture.data[i].y, picture.data[i].x);
    }
    adaptSize();
} else {
    grid = new Grid(10, 10);

    adaptSize();
}


//fonction du responsive
function adaptSize() {
    canvas.width = canvas.parentElement.clientWidth;
    if (step == '') {
        canvas.height = canvas.width;
    } else {
        canvas.height = step2 * (canvas.width / step);
    }
    drawGrid(grid, canvas);
}
//fonction qui crée la métadata envoyée dans la BDD
function createJson(grid) {


    envoijson = {
        metadata: {
            wc: grid.getWc(),
            hc: grid.getHc()
        },
        data: grid.exportData()

    };

    envoijson = JSON.stringify(envoijson);

}
//Fonction qui dessin la grille 
function drawGrid(grid, canvas) {
    var context = canvas.getContext('2d');
    var cellW = canvas.width / grid.wc;
    var cellH = cellW;
    context.clearRect(0, 0, cellW * this.wc, cellH * this.hc);
    context.strokeWidth = '2';
    grid.forEach(function (cell, x, y) {
        if (cell) {
            context.fillStyle = cell;
            context.clearRect(y * cellW, x * cellH, cellW, cellH);
            context.fillRect(y * cellW, x * cellH, cellW, cellH);
        } else {
            context.strokeStyle = 'black';
            context.clearRect(y * cellW, x * cellH, cellW, cellH);
            context.strokeRect(y * cellW, x * cellH, cellW, cellH);
        }
    });
}
//fonction qui évalue la difficulté
function assessDifficulty(){
    nbrcase=grid.exportData();
    if (nbrcase.length<30){
        difficulty="très facile";
    }
    else if(nbrcase.length<50){
        difficulty="facile";
    }
    else if(nbrcase.length<=150){
        difficulty="moyen";
    }
    else if(nbrcase.length>150){
        difficulty="difficile";
    }
    return difficulty;
}
//ajax qui envoie le canvas dans la bdd
function enregistrerCanvas(param) {

    console.log('enregistrer');
    $.ajax({
        type: 'POST',
        url: $("#form").attr('action'),
        data: param,
        succes: null
    });

    console.log(param);
}
;

//Evenements
window.onresize = function (event) {
    adaptSize();
};
//Zoom et dézoom
zoom = document.getElementById("zoom");
zoom.addEventListener("click", function () {
    canvas.width = 1.1 * canvas.width;
    canvas.height = 1.1 * canvas.height;
    drawGrid(grid, canvas);
})

dezoom = document.getElementById("dezoom");
dezoom.addEventListener("click", function () {
    if (canvas.width > 50) {
        canvas.width = 0.9 * canvas.width;
        canvas.height = 0.9 * canvas.height;
        drawGrid(grid, canvas);
    }
})

//Choix des dimensions avec le select
for (var i = 0; i < choix.length; i++) {
    choix[i].addEventListener("change", function (e) {


        //if(document.getElementById("canvas")){document.getElementById("cadre").removeChild(document.getElementById('canvas'))}; 
        if (row.value>=2 && col.value>=2) {
            $("#canvas").fadeOut(500, function () {
                grid.setWc(parseInt(col.value));
                grid.setHc(parseInt(row.value));
                step = parseInt(col.value);
                step2 = parseInt(row.value);
                adaptSize();
                //init(wc,hc);
            }
            );
            $("#canvas").fadeIn(500);

        }
    })
}

//Choix des dimensions avec les boutons sur les cotés
petitrectangle.addEventListener("click", function (e) {


    //if(document.getElementById("canvas")){document.getElementById("cadre").removeChild(document.getElementById('canvas'))}; 

    $("#canvas").fadeOut(500, function () {
        grid.setWc(10);
        grid.setHc(15);
        step = 10;
        step2 = 15;
        adaptSize();
        //init(wc,hc);
    }
    );
    $("#canvas").fadeIn(500);

});

carremoyen.addEventListener("click", function (e) {


    //if(document.getElementById("canvas")){document.getElementById("cadre").removeChild(document.getElementById('canvas'))}; 

    $("#canvas").fadeOut(500, function () {
        grid.setWc(25);
        grid.setHc(25);
        step = 25;
        step2 = 25;
        adaptSize();
        //init(wc,hc);
    }
    );
    $("#canvas").fadeIn(500);

});

rectanglemoyen.addEventListener("click", function (e) {


    //if(document.getElementById("canvas")){document.getElementById("cadre").removeChild(document.getElementById('canvas'))}; 

    $("#canvas").fadeOut(500, function () {
        grid.setWc(18);
        grid.setHc(25);
        step = 18;
        step2 = 25;
        adaptSize();
        //init(wc,hc);
    }
    );
    $("#canvas").fadeIn(500);

});

grandcarre.addEventListener("click", function (e) {


    //if(document.getElementById("canvas")){document.getElementById("cadre").removeChild(document.getElementById('canvas'))}; 

    $("#canvas").fadeOut(500, function () {
        grid.setWc(50);
        grid.setHc(50);
        step = 50;
        step2 = 50;
        adaptSize();
        //init(wc,hc);
    }
    );
    $("#canvas").fadeIn(500);

});

$('.save').on('click', function () {
    createJson(grid);
    assessDifficulty();
    console.log(difficulty);
    console.log(envoijson);
    $('#envoicanvas').attr('value', envoijson);
    var thumb = canvas.toDataURL();
    $('#thumb').attr('value', thumb);
    $('#thumbdef').attr('value', thumb);

})

grandrectangle.addEventListener("click", function (e) {


    //if(document.getElementById("canvas")){document.getElementById("cadre").removeChild(document.getElementById('canvas'))}; 

    $("#canvas").fadeOut(500, function () {
        grid.setWc(35);
        grid.setHc(50);
        step = 35;
        step2 = 50;
        adaptSize();
        //init(wc,hc);
    }
    );
    $("#canvas").fadeIn(500);

});





//remplissage du canvas avec les couleurs quand on clique dessus
canvas.addEventListener('click', function (event) {
    var posX = event.pageX - canvas.offsetLeft - cadre.offsetLeft + cadre.scrollLeft;//ne pas oublier les scrollTop et scrollLeft lors de l'intégration !//- canvas.offsetLeft
    var posY = event.pageY - canvas.offsetTop - cadre.offsetTop + cadre.scrollTop;
    console.log(event.pageX);
    console.log(posX);
    console.log(posY);
    var cellX = parseInt(posX / (canvas.width / grid.wc));
    console.log(cellX);
    var cellY = parseInt(posY / (canvas.height / grid.hc));
    console.log(cellY);
    cellColor = grid.getColor(cellY, cellX);
    if (!cellColor || cellColor != color) {
        grid.setColor(color, cellY, cellX);
    } else {
        grid.clearColor(cellY, cellX);
    }

    drawGrid(grid, canvas);
    console.log(grid);
    gridjson = JSON.stringify(grid);
    console.log(gridjson);
    var dessinJson = createJson(grid);
    console.log(dessinJson);
});
//Attribution de la couleur quand on clique sur le bouton
var buttons = document.querySelectorAll('button');

buttons.forEach(function (el) {
    el.addEventListener('click', function (event) {
        color = event.target.getAttribute('data-color');
    });
});
$("#erase").on('click',function(){
  color=null;  
})
//Quand on submit le formulaire de sauvegarde du brouillon         
$('#form').on('submit', function (e) {
    $(".erreurtitre").text('');
    e.preventDefault();
    
    var value=$("#id_categories").val();
    if($("#title").val().length>15){
       $("#erreurtitre").text("La titre du dessin ne doit pas dépasser 15 caractères");
    }else{
    param = 'title=' + $("#title").val() + '&thumb=' + $("#thumb").val() + '&state=' + $("#state").val() + '&canvas=' + envoijson + '&id_categories=' + value + '&difficulty='+ difficulty;
    enregistrerCanvas(param);
    console.log(param);
    $("#modal").fadeOut(500);
    $("#modal").removeClass('in');
    $(".modal-backdrop").attr('style', 'position:static');
    $("body").removeClass('modal-open');
    }
});
//Quand on envoiue le dessin
$('#form2').on('submit', function (e) {
    e.preventDefault();
    $(".erreurtitre").text('');
    var value=$("#id_categoriesdef").val();
    if($("#titledef").val().length>15){
       $("#erreurtitredef").text("La titre du dessin ne doit pas dépasser 15 caractères");
    }else{
    param = 'title=' + $("#titledef").val() + '&thumb=' + $("#thumbdef").val() + '&state=' + $("#statedef").val() + '&canvas=' + envoijson + '&id_categories=' + value + '&difficulty='+ difficulty;;
    enregistrerCanvas(param);
    window.location = "mes-pixelarts";
}});





