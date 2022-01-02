//{lang:"lang",key:"cle"}

var Lang = function (langSymbol="fr",multiLangString={}) {
	this.langue = langSymbol;
	this.DATA = (typeof multiLangString !== undefined)?multiLangString:{};
	this.setLanguage = function(v){
		if (v!==undefined || v!="") {
			this.langue = v;
		}
	}

	this.getLanguage = function(){
		return this.langue;
	}

	this.setDATA = function(arr){
		if (arr!==undefined || arr!="") {
			this.DATA = arr;
		}
	}

	return this;
}
/*
Lang.prototype.setLanguage() = function(v){
	return this.langue = v;
}

Lang.prototype.getLanguage = function() {
	return this.langue;
}

Lang.prototype.setDATA = function(DATA){
	return this.DATA = DATA;
}*/


Lang.prototype.getValue = function(key) {

	if (this.DATA[this.langue] !== undefined) {
		if (this.DATA[this.langue][key] !== undefined) {
			return this.DATA[this.langue][key];
		}else{
			return "key_not_found";
		}
	}else{
		return "language_not_found";
	}
};

Lang.prototype.translate = function(lang,key) {
	if (typeof this.DATA !==undefined) {
		if (this.DATA[lang] !== undefined) {
			if (this.DATA[lang][key] !== undefined) {
				return this.DATA[lang][key]; 
			}else{
				return "key_not_found";
			}
		}else{
			return "language_not_found";
		}
	}else{
		return "data_not_found"
	}
	
};

var multiLangString = {
	en:{
		hello:"Hello",
		txt1:"Came eat a rize",
		txt2:"came tomorow but it is fiesta"
	},

	fr:{
		hello:"Hello",
		txt1:"je mange du riz",
		txt2:"Venez enszmble demain soir car il y'aura une fête"
	}

}

l = new Lang()
window.Translator = l;