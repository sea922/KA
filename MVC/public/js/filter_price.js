// const lowerSlider = document.querySelector('#lower');
// const  upperSlider = document.querySelector('#upper');

// document.querySelector('#two').value=upperSlider.value;
// document.querySelector('#one').value=lowerSlider.value;

// const  lowerVal = parseInt(lowerSlider.value);
// const upperVal = parseInt(upperSlider.value);

// upperSlider.oninput = function () {
//     lowerVal = parseInt(lowerSlider.value);
//     upperVal = parseInt(upperSlider.value);

//     if (upperVal < lowerVal + 4) {
//         lowerSlider.value = upperVal - 4;
//         if (lowerVal == lowerSlider.min) {
//         upperSlider.value = 4;
//         }
//     }
//     document.querySelector('#two').value=this.value
// };

// lowerSlider.oninput = function () {
//     lowerVal = parseInt(lowerSlider.value);
//     upperVal = parseInt(upperSlider.value);
//     if (lowerVal > upperVal - 4) {
//         upperSlider.value = lowerVal + 4;
//         if (upperVal == upperSlider.max) {
//             lowerSlider.value = parseInt(upperSlider.max) - 4;
//         }
//     }
//     document.querySelector('#one').value=this.value
// }; 

(function() {
 
    var parent = document.querySelector(".price-slider");
    if(!parent) return;
   
    var
      rangeS = parent.querySelectorAll("input[type=range]"),
      numberS = parent.querySelectorAll("input[type=number]");
   
    rangeS.forEach(function(el) {
      el.oninput = function() {
        var slide1 = parseFloat(rangeS[0].value),
              slide2 = parseFloat(rangeS[1].value);
   
        if (slide1 > slide2) {
          [slide1, slide2] = [slide2, slide1];
        }
   
        numberS[0].value = slide1;
        numberS[1].value = slide2;
      }
    });
   
    numberS.forEach(function(el) {
      el.oninput = function() {
          var number1 = parseFloat(numberS[0].value),
          number2 = parseFloat(numberS[1].value);
          
        if (number1 > number2) {
          var tmp = number1;
          numberS[0].value = number2;
          numberS[1].value = tmp;
        }
   
        rangeS[0].value = number1;
        rangeS[1].value = number2;
   
      }
    });
   
  })();