function showImage1() {
  var num = document.getElementById("flip1");
  var img = document.getElementById('myImage1');
    if(num.style.display === 'none') {
      num.style.display = 'flex';
      img.style.display = 'none';
    } else {
      num.style.display = 'none';
      img.style.display = 'flex';   
    }
}

function showImage2() {
  var num2 = document.getElementById("flip2");
  var img2 = document.getElementById('myImage2');
    if(num2.style.display === 'none') {
      num2.style.display = 'flex';
      img2.style.display = 'none';
    } else {
      num2.style.display = 'none';
      img2.style.display = 'flex';   
    }
}

