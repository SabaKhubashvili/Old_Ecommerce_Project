var mainImg= document.getElementById('mainImg');
var smallImage=document.getElementsByClassName('small-img');


for(let i=0 ; i<4; i++){
       smallImage[i].onclick= function() {
       mainImg.src = smallImage[i].src;
 };
}

