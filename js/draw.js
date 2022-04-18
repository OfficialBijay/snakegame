const canvas = document.querySelector(".canvas");
const ctx = canvas.getContext("2d");
const scale = 10;
const rows = canvas.height / scale;
const columns = canvas.width / scale;
var snake;
var flag = false;

(function setup() {
  snake = new Snake();
  fruit = new Fruit();
  fruit.pickLocation();
  window.setInterval(() => {
    if (flag) {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      fruit.draw();
      snake.update();
      snake.draw();
      ctx.stroke();
    }
    if (snake.eat(fruit)) {
      fruit.pickLocation();
    }

    snake.checkCollision();
    document.getElementById("score").value = snake.total;
  }, 150);
  
})();

window.addEventListener("keydown", (evt) => {
  const direction = evt.key.replace("Arrow", "");
  snake.changeDirection(direction);
});
