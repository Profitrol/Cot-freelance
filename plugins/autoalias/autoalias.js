function genSEF(from, to, allow_slashes )
{
   var str = from.value.toLowerCase();
   var slash = "";
   if (allow_slashes) slash = "\\/";

   var LettersFrom = "абвгдезиклмнопрстуфыэйхё";
   var LettersTo   = "abvgdeziklmnoprstufyeyxe";
   var Consonant = "бвгджзйклмнпрстфхцчшщ";
   var Vowel = "аеёиоуыэюя";
   var BiLetters = {
     "ж" : "zh", "ц" : "ts",  "ч" : "ch",
     "ш" : "sh", "щ" : "sch", "ю" : "yu", "я" : "ya"
                   };

   str = str.replace( /[_\s\.,?!\[\](){}]+/g, "-");
   str = str.replace( /-{2,}/g, "--");
   str = str.replace( /_\-+_/g, "--");

   str = str.toLowerCase();

   //here we replace ъ/ь
   str = str.replace(
      new RegExp( "(ь|ъ)(["+Vowel+"])", "g" ), "j$2");
   str = str.replace( /(ь|ъ)/g, "");

   //transliterating
   var _str = "";
   for( var x=0; x<str.length; x++)
    if ((index = LettersFrom.indexOf(str.charAt(x))) > -1)
     _str+=LettersTo.charAt(index);
    else
     _str+=str.charAt(x);
   str = _str;

   var _str = "";
   for( var x=0; x<str.length; x++)
    if (BiLetters[str.charAt(x)])
     _str+=BiLetters[str.charAt(x)];
    else
     _str+=str.charAt(x);
   str = _str;

   str = str.replace( /j{2,}/g, "j");

   str = str.replace( new RegExp( "[^"+slash+"0-9a-z_\\-]+", "g"), "");

   to.value = str;

}