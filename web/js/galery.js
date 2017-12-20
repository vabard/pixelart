document.getElementById('select-difficulty').addEventListener('change', function(e){
    e.preventDefault();
    
    var val = e.target.options[e.target.selectedIndex].value;
    
    window.location = val;
});

document.getElementById('select-category').addEventListener('change', function(e){
    e.preventDefault();
    
    var val = e.target.options[e.target.selectedIndex].value;
    
    window.location = val;
});

