var c = 0;
document.getElementById("start").addEventListener("click", function () {
  c++;
  flag = !flag;
  document.getElementById("start").innerText = "Restart";
  document.getElementById("pause").style.display = "block";
  if (c % 2 === 0) {
    window.location.reload(true);
  }
});
document.getElementById("pause").addEventListener("click", function () {
  flag = !flag;
  document.getElementById("pause").innerText = "Resume";
});
// document.getElementById("newgame").addEventListener("click", function () {
//   document.getElementById("newgame").style.display = "none";
//   window.location.reload(true);
// });
