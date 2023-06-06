let container = document.getElementById("canvas-container"), wrapper = document.getElementById("canvas-wrapper");

window.addEventListener("resize", resize)

function resize(){
    container.setAttribute("width", wrapper.clientWidth);
    container.setAttribute("height", wrapper.clientWidth / 2);
}
resize();

setTimeout(resize, 100)