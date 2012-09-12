function HideMC()
{
	document.all.mc.style.display = 'none';
	document.all.mc2.style.display = 'none';
	document.all.mc3.style.display = 'none';
	document.all.mc4.style.display = 'none';
}

function ShowMC()
{
	document.all.mc.style.display = 'block';
	document.all.mc2.style.display = 'block';
	document.all.mc3.style.display = 'block';
	document.all.mc4.style.display = 'block';
}

function HideAMC()
{
	document.all.amc.style.display = 'none';
	document.all.amc2.style.display = 'none';
	document.all.amc3.style.display = 'none';
	document.all.amc4.style.display = 'none';
}

function ShowAMC()
{
	document.all.amc.style.display = 'block';
	document.all.amc2.style.display = 'block';
	document.all.amc3.style.display = 'block';
	document.all.amc4.style.display = 'block';
}

function HideTF()
{
	document.all.tf.style.display = 'none';
}

function ShowTF()
{
	document.all.tf.style.display = 'block';
}

function HideATF()
{
	document.all.atf.style.display = 'none';
}

function ShowATF()
{
	document.all.atf.style.display = 'block';
}

function HideSA()
{
	document.all.sa.style.display = 'none';
}

function ShowSA()
{
	document.all.sa.style.display = 'block';
}

function HideASA()
{
	document.all.asa.style.display = 'none';
}

function ShowASA()
{
	document.all.asa.style.display = 'block';
}

function setQType()
{
	if(document.slide.qType.value == "sa"){
		HideMC(); // Hide C D
		HideTF(); // Hide A B
		ShowSA();
	} else if (document.slide.qType.value == "mc"){
		HideTF(); // Show A B
		ShowMC(); // Show C D
		HideSA();
	} else if (document.slide.qType.value == "tf"){
		ShowTF(); // Show A B
		HideMC();
		HideSA();	
	}
}

function setAQType()
{
	if(document.slide.a_qType.value == "sa"){
		HideAMC(); // Hide C D
		HideATF(); // Hide A B
		ShowASA();
	} else if (document.slide.a_qType.value == "mc"){
		HideATF(); // Show A B
		ShowAMC(); // Show C D
		HideASA();
	} else if (document.slide.a_qType.value == "tf"){
		ShowATF(); // Show A B
		HideAMC();
		HideASA();	
	}
}

function setStart()
{
	HideMC();
	HideAMC();
	HideTF();
	HideATF();
	HideSA();
	HideASA();
}