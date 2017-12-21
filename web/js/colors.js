
var colorsTab = [
'#FF0000',
'#f44336',
'#CC3300',
'#e91e63',
'#FF3366',
'#FF6699',
'#FFCCCC',
'#FF9999',
'#FFEBEE',
'#FFCCFF',
'#CC3399',
'#9c27b0',
'#660066',
'#6600FF',
'#CC66FF',
'#673ab7',
'#CCCCFF',
'#003366',
'#3f51b5',
'#2196f3',
'#03a9f4',
'#0033FF',
'#000066',
'#330099',
'#0066FF',
'#00bcd4',
'#CCFFFF',
'#66FFFF',
'#00FFCC',
'#006666',
'#E1F5FE',
'#009688',
'#66FF00',
'#4caf50',
'#FFFF99',
'#CCFF00',
'#8bc34a',
'#666600',
'#cddc39',
'#FFFF00',
'#ffeb3b',
'#FFCC66',
'#ffc107',
'#ff9800',
'#ff5722',
'#FF3300',
'#FF6600',
'#996600',
'#990000',
'#660000',
'#795548',
'#607d8b',
'#666666',
'#9e9e9e',
'#ffffff',
'#000000'

];

function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}

// usage example:
var unique = colorsTab.filter( onlyUnique );

for(var i = 0; i < unique.length; i++){
    var btn = document.createElement('button');
    btn.style.background = unique[i];
    btn.setAttribute('data-color', unique[i]);
    document.getElementById('my').appendChild(btn);
}

