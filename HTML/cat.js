document.getElementById('meowButton').addEventListener('click', function() {
    // Miyavlama sesini çal
    var meowSound = document.getElementById('meowSound');
    meowSound.volume = 0.3; 
    meowSound.play();
});