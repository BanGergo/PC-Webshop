function tmod(){
    window.open("/tmod/"+document.getElementById('nevek').value);
}

function tmodconf(){
    document.getElementById('tmodositas').action = window.location.href;
}

function handleChange(e) {
    const id = e.target.id.split("_")[1];
    if (e.target.id.includes("fromSlider")) {
        const fromInput = document.getElementById(`fromInput_${id}`);
        fromInput.value = e.target.value;
        const to = document.getElementById(`toSlider_${id}`);
        if (e.target.value > to.value) {
            to.value = e.target.value;
        }
    }
}
