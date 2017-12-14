
var canvas = document.getElementById("canvas-learn");
var color = 'black';

function Grid(wc, hc) {
    this.grid = this.init(wc, hc);
    this.wc = wc;
    this.hc = hc;
}

Grid.prototype.init = function (wc, hc) {
    var grid = [];
    for (var i = 0; i < wc; i++) {
        grid[i] = [];
        for (var j = 0; j < hc; j++) {
            grid[i][j] = null;
        }
    }

    return grid;
}

Grid.prototype.setWc = function (wc) {
    this.wc = wc;
}

Grid.prototype.setHc = function (wc) {
    this.hc = hc;
}

Grid.prototype.forEach = function (callback) {
    for (var i = 0; i < this.wc; i++) {
        for (var j = 0; j < this.hc; j++) {
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

/**
 * 
 * Animation
 * 
 */

function Action(x, y, color) {
    this.x = x;
    this.y = y;
    this.color = color;
}

var animation = [
    new Action(0, 3, "pink"),
    new Action(4, 3, "green"),
    new Action(4, 12, "red"),
    new Action(4, 4, "blue"),
    new Action(6, 4, "grey"),
    new Action(20, 20, "black"),
    new Action(4, 6, "black"),
    new Action(8, 4, "yellow"),
    new Action(20, 10, "purple")
];

// On récupère dans les array séparés les X, Y et les Couleurs
var tabx = [];
var taby = [];
var tabColors = [];
for (var i = 0; i < animation.length; i++) {
    tabx.push(animation[i].x);
    taby.push(animation[i].y);
    tabColors.push(animation[i].color);
}

// on récupère les min, les max des x et des y pour définir notre Grid
var minX = 1 + tabx.reduce(function (a, b) {
    return Math.min(a, b);
});
var maxX = minX + tabx.reduce(function (a, b) {
    return Math.max(a, b);
});
//console.log(maxX);

var minY = 1 + taby.reduce(function (a, b) {
    return Math.min(a, b);
});
var maxY = minY + taby.reduce(function (a, b) {
    return Math.max(a, b);
});
//console.log(maxY);

// Function pour récupérer les valeur unique dans un array
function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}

// on récupère les couleurs uniques pour les afficher à l'utilisateur
var uniqueColor = tabColors.filter( onlyUnique );
//console.log(uniqueColor);

// On affiche les couleurs
for(var i=0; i < uniqueColor.length; i++){
    createColor(uniqueColor[i]);
}

//THUMB
var stopBtn = document.getElementById('stop');
stopBtn.addEventListener('click', function(){
    var data = canvas.toDataURL();
    document.getElementById('thumb-learn').setAttribute("src", data);
    console.log(data);
});



// ANIMATION
var indexAnimation = 0;
var playBtn = document.getElementById('play');
speedOfAnimation = 2000;

playBtn.addEventListener('click', play);

function play(){
    var animate = setInterval(function () {
        var action = animation[indexAnimation++];

        if (typeof action === 'undefined') {
            clearInterval(animate);
            return;
        }

        grid.setColor(action.color, action.x, action.y);

        drawGrid(grid, canvas);

        createStep(action.x, action.y, action.color);

    }, speedOfAnimation);    
}



/////////////////////////////

grid = new Grid(maxX, maxY);

adaptSize();

window.onresize = function (event) {
    adaptSize();
};

function adaptSize() {
    canvas.width = canvas.parentElement.clientWidth;
    canvas.height = canvas.width;
    drawGrid(grid, canvas);
}

function drawGrid(grid, canvas) {
    var context = canvas.getContext('2d');
    var cellW = canvas.width / grid.wc;
    var cellH = cellW;
    context.clearRect(0, 0, cellW * this.wc, cellH * this.hc);
    context.strokeWidth = '2';
    grid.forEach(function (cell, x, y) {
        if (cell) {
            context.fillStyle = cell;
            context.clearRect(x * cellW, y * cellH, cellW, cellH);
            context.fillRect(x * cellW, y * cellH, cellW, cellH);
        } else {
            context.strokeStyle = 'black';
            context.clearRect(x * cellW, y * cellH, cellW, cellH);
            context.strokeRect(x * cellW, y * cellH, cellW, cellH);
        }
    });
}



/*
 * 
 * Affichage des étapes
 * 
 */

function createStep(x, y, color){
    
    // 1. Je crée un li vide et un span
    var li = document.createElement('li');
    var span = document.createElement('span');
     
    // 2. J'ajoute les classe et le style a mon span
    span.className = "glyphicon glyphicon-stop";
    span.style.color = color;

    // 3. je creer du texte
    var texte = document.createTextNode('Case : ' + (x+1) + ' - ' + (y+1));

    // 4. j'ajoute mon texte dans mon li	
    li.appendChild(texte);

    // 5. je selectionne un ul existant
    var ul = document.querySelector('#steps');

    // 6. j'ajoute mon span dans li et li dans ul
    li.appendChild(span);
    ul.appendChild(li);
}

function createColor(color){
    
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
//
//function createImg(color){
//    
//    // 1. Je crée un li vide et un span
//    var = document.createElement('li');
//    var span = document.createElement('span');
//     
//    // 2. J'ajoute les classe et le style a mon span
//    span.className = "glyphicon glyphicon-stop";
//    span.style.color = color;
//
//    // 3. je selectionne un ul existant
//    var ul = document.querySelector('#colors');
//
//    // 4. j'ajoute mon span dans li et li dans ul
//    li.appendChild(span);
//    ul.appendChild(li);
//}



