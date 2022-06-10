function checkRutField(element) {

	let rut = $(element).val();
	var tmpstr = "";
	for (i = 0; i < rut.length; i++)
		if (rut.charAt(i) != ' ' && rut.charAt(i) != '.'
				&& rut.charAt(i) != '-')
			tmpstr = tmpstr + rut.charAt(i);
	rut = tmpstr;
	largo = rut.length;
	// [VARM+]
	tmpstr = "";
	for (i = 0; rut.charAt(i) == '0'; i++)
		;
	for (; i < rut.length; i++)
		tmpstr = tmpstr + rut.charAt(i);
	rut = tmpstr;
	largo = rut.length;
	// [VARM-]
	if (largo < 2) {
		showSnackbar("Debe ingresar el RUT completo.", 'error')
		//alert("Debe ingresar el RUT completo.");
		element.focus();
		element.select();
		element.value = "";
		return false;
	}
	for (i = 0; i < largo; i++) {
		if (rut.charAt(i) != "0" && rut.charAt(i) != "1"
				&& rut.charAt(i) != "2" && rut.charAt(i) != "3"
				&& rut.charAt(i) != "4" && rut.charAt(i) != "5"
				&& rut.charAt(i) != "6" && rut.charAt(i) != "7"
				&& rut.charAt(i) != "8" && rut.charAt(i) != "9"
				&& rut.charAt(i) != "k" && rut.charAt(i) != "K") {
			showSnackbar("El valor ingresado no corresponde a un RUT valido.", 'error')
			//alert("El valor ingresado no corresponde a un RUT valido.");
			element.focus();
			element.select();
			element.value = "";
			return false;
		}
	}
	var invertido = "";
	for (i = (largo - 1), j = 0; i >= 0; i--, j++)
		invertido = invertido + rut.charAt(i);
	var drut = "";
	drut = drut + invertido.charAt(0);
	drut = drut + '-';
	cnt = 0;
	for (i = 1, j = 2; i < largo; i++, j++) {
		if (cnt == 3) {
			drut = drut + '.';
			j++;
			drut = drut + invertido.charAt(i);
			cnt = 1;
		} else {
			drut = drut + invertido.charAt(i);
			cnt++;
		}
	}
	invertido = "";
	for (i = (drut.length - 1), j = 0; i >= 0; i--, j++)
		invertido = invertido + drut.charAt(i);
	element.value = invertido;
	if (checkDV(rut,element))
		return true;
	return false;
}

function checkDV(crut,element) {
	largo = crut.length;
	if (largo < 2) {
		showSnackbar("Debe ingresar el RUT completo.", 'error')
		//alert("Debe ingresar el RUT completo.");
		element.focus();
		element.select();
		element.value = "";
		return false;
	}
	if (largo > 2)
		rut = crut.substring(0, largo - 1);
	else
		rut = crut.charAt(0);
	dv = crut.charAt(largo - 1);
	checkCDV(dv,element);
	if (rut == null || dv == null)
		return 0;
	var dvr = '0';
	suma = 0;
	mul = 2;
	for (i = rut.length - 1; i >= 0; i--) {
		suma = suma + rut.charAt(i) * mul;
		if (mul == 7)
			mul = 2;
		else
			mul++;
	}
	res = suma % 11;
	if (res == 1)
		dvr = 'k';
	else if (res == 0)
		dvr = '0';
	else {
		dvi = 11 - res;
		dvr = dvi + "";
	}
	if (dvr != dv.toLowerCase()) {
		showSnackbar("EL RUT es incorrecto",'error')
		//alert("EL RUT es incorrecto.");
		element.focus();
		element.select();
		element.value = "";
		return false;
	}

	return true;
}

function checkCDV(dvr,element) {
	dv = dvr + "";
	if (dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4'
			&& dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9'
			&& dv != 'k' && dv != 'K') {
		showSnackbar('Debe ingresar un dígito verificador válido', 'error')
		//alert("Debe ingresar un digito verificador valido.");
		element.focus();
		element.select();
		element.value = "";
		return false;
	}
	return true;
}