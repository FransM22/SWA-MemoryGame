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

$(
  function() {
    $(".memory_piece").click(showImage);
  }
)

function showImage() {
  var turned_pieces = $(".memory_piece.showimg:not(.correct)").length

  var is_visible = $(this).hasClass('showimg')

  if (is_visible) {
    rotateToHide(this)
  }
  else if (turned_pieces <= 1) {
    if (window.first_piece_time === undefined) {
      window.first_piece_time = (new Date()).getTime()
      console.log("Starting game now")
    }
    rotateToVisible(this)
  }

  if ($(".memory_piece:not(.correct)").length == 0) {
    duration = (new Date()).getTime() - window.first_piece_time
    console.log("You have won!!!!!")
    console.log("It took you " + (duration/1000) + " seconds")
    win(duration/1000)
  }
}


function win(duration_s) {
  // Submit the score
  score = Math.round(10000/duration_s)
  $.post("submit_user_highscore.php", {"highscore": score});
  $(".memory_piece").each(function() {winAnimation(this)})

  d = $("<div>").addClass("winning")
  d.html("You won in " + duration_s + " seconds!<br>Score: " + score)

  $("body").append(d)
}

function rotateToVisible(div) {

  // Check if a different piece with the same image has already been rotated
  img_url = $(
    $(div).find("img")[0]
  ).attr('src')

  $(".memory_piece.showimg:not(.correct)").each(
    function () {
      other_elem = $(this)
      other_elem_img_url = $(
        $(other_elem).find("img")[0]
      ).attr('src')

      if (other_elem_img_url === img_url) {
        $(div).addClass("correct")
        $(other_elem).addClass("correct")
      }
    }
  )
  $(div).addClass("showimg")
}

function rotateToHide(div) {
  $(div).removeClass("showimg")
}

function winAnimation(div) {
  rect = div.getBoundingClientRect(div)
  win_animation_clone = $(div).clone()
  win_animation_clone.css("position", "fixed")
  initSin = Math.random() * 6.28

  appendChildAnim(div, win_animation_clone, rect.top, rect.left, initSin, 0)
}

function appendChildAnim(div, win_animation_clone, startx, starty, initSin, i) {
  new_child = $(win_animation_clone).clone()

  new_y = (starty + 30*Math.sin(0.2*i + initSin) + 5 * i) % 1080
  new_x = (startx + 5 * i) % 1920
  $(new_child).css("top", new_y)
  $(new_child).css("left", new_x)

  $(div).append(new_child)
  setTimeout(function(){appendChildAnim(div, win_animation_clone, startx, starty, initSin, i + 1)}, 10)
}
