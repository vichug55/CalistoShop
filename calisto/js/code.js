function mostrar_contra(){
    var tipo=document.getElementById("input")
    var eye=document.getElementById('eye');
    if(tipo.type=='password'){
        tipo.type='text'
        eye.style.opacity=0.2;
    }else{
        tipo.type='password'
        eye.style.opacity=0.8;
    }
}

function mostrar_contra2(){
    var tipo2=document.getElementById("input2")
    var eye2=document.getElementById('eye2');
    if(tipo2.type=='password'){
        tipo2.type='text'
        eye2.style.opacity=0.2;
    }else{
        tipo2.type='password'
        eye2.style.opacity=0.8;
    }
}