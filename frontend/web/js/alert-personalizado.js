//Overriding alert native function
function alert(message) {
    console.log("Alert message: "+ message);
    showSnackbar(message, 'info');
}