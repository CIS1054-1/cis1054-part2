/** 
    * game
    *
    * @author Gioele Giunta
    * @version 1.0
    * @since 2024-05-07
    * @info Me (Gioele) am going to use the CAMEL CASE for the java files
**/

document.addEventListener('DOMContentLoaded', function () {
    const player = document.getElementById('player');
    let playerPosition = 50;
    let aliens = [];
    let bullets = [];
    let play = 1;

    document.addEventListener('keydown', function (event) {
        if(play){
            document.getElementById('instruction').style.display = "none";
            if (event.key === 'ArrowLeft' && playerPosition > 0) {
                playerPosition -= 10;
                player.style.left = playerPosition + 'px';
            } else if (event.key === 'ArrowRight' && playerPosition < 800) {
                playerPosition += 10;
                player.style.left = playerPosition + 'px';
            } else if (event.key === ' ') { // Space bar to shoot
                shoot();
            }
        }

    });

    setInterval(createAlien, 2000); // Create a new alien every 2 seconds
    setInterval(moveAliens, 1000); // Move the aliens every second

    function createAlien() {
        if(play){
            const alien = document.createElement('div');
            alien.classList.add('alien');
            alien.style.left = Math.random() * 730 + 'px'; // Random position in the x-axis
            document.getElementById('game-container').appendChild(alien);
            aliens.push(alien);
            alienShoot(alien); // Alien starts shooting when created
        }
    }

    function moveAliens() {
        if(play){
            aliens.forEach(function (alien, index) {
                const alienBottom = parseInt(window.getComputedStyle(alien).bottom);
                if (alienBottom > 0) {
                    alien.style.bottom = alienBottom - 10 + 'px';
                    // Check if the alien hits the player
                    const alienLeft = parseInt(window.getComputedStyle(alien).left);
                    if (alienBottom <= 50 && alienLeft >= playerPosition && alienLeft <= playerPosition + 50) {
                        gameOver();
                    }
                } else {
                    aliens.splice(index, 1);
                    alien.remove();
                }
            });
        }
    }

    function alienShoot(alien) {
        const bullet = document.createElement('div');
        bullet.classList.add('bullet');
        bullet.style.left = parseInt(alien.style.left) + 25 + 'px'; // Center bullet horizontally
        bullet.style.bottom = '350px'; // Start bullet from top of the alien
        document.getElementById('game-container').appendChild(bullet);
        bullets.push(bullet);

        const moveBulletInterval = setInterval(function () {
            if(play){
                const bulletTop = parseInt(window.getComputedStyle(bullet).bottom);
                if (bulletTop > 0) {
                    bullet.style.bottom = bulletTop - 10 + 'px';
                    // Check if bullet hits player
                    if (bulletTop <= 50 && parseInt(bullet.style.left) >= playerPosition && parseInt(bullet.style.left) <= playerPosition + 50) {
                        gameOver();
                    }
                } else {
                    clearInterval(moveBulletInterval);
                    bullet.remove();
                    bullets.splice(bullets.indexOf(bullet), 1);
                }
            }
        }, 100);
    }

    function shoot() {
        const bullet = document.createElement('div');
        bullet.classList.add('bullet');
        bullet.style.left = playerPosition + 25 + 'px'; // Center bullet horizontally
        bullet.style.bottom = '50px';
        document.getElementById('game-container').appendChild(bullet);
        bullets.push(bullet);

        const moveBulletInterval = setInterval(function () {
            if(play){
                const bulletTop = parseInt(window.getComputedStyle(bullet).bottom);
                if (bulletTop < 700) {
                    bullet.style.bottom = bulletTop + 10 + 'px';
                    // Check if bullet hits alien
                    aliens.forEach(function (alien, index) {
                        const alienBottom = parseInt(window.getComputedStyle(alien).bottom);
                        const alienLeft = parseInt(window.getComputedStyle(alien).left);
                        if (bulletTop >= alienBottom && bulletTop <= alienBottom + 50 && parseInt(bullet.style.left) >= alienLeft && parseInt(bullet.style.left) <= alienLeft + 50) {
                            clearInterval(moveBulletInterval);
                            bullet.remove();
                            bullets.splice(bullets.indexOf(bullet), 1);
                            aliens.splice(index, 1);
                            alien.remove();
                        }
                    });
                } else {
                    clearInterval(moveBulletInterval);
                    bullet.remove();
                    bullets.splice(bullets.indexOf(bullet), 1);
                }
            }
        }, 100);
    }

    function gameOver() {
        play = 0;
        document.getElementById('instruction').style.display = "block";
        document.getElementById('instruction').innerHTML = "Game Over! </br> Refres the Page!";
    }
});
