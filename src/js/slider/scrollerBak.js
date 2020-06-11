var slider = document.getElementById("myRange");
var output = document.getElementById("value");
output.innerHTML = slider.value;

slider.oninput = function () {
    output.innerHTML = this.value;
    if (this.value > 80) {
        document.getElementById("value").style.color = '#008000';
    } else if (this.value > 60) {
        document.getElementById("value").style.color = '#32CD32';
    } else if (this.value > 40) {
        document.getElementById("value").style.color = '#FFD700';
    } else if (this.value > 20) {
        document.getElementById("value").style.color = '#FF7F50';
    } else if (this.value < 20) {
        document.getElementById("value").style.color = '#B22222';
    }
}