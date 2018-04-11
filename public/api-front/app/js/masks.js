function MascaraCNPJ(cnpj){
        if(mascaraInteiro(cnpj)==false){
                event.returnValue = false;
        }
        return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//adiciona mascara de cep
function MascaraCep(cep){
                if(mascaraInteiro(cep)==false){
                event.returnValue = false;
        }
        return formataCampo(cep, '00.000-000', event);
}

//adiciona mascara de data
function MascaraData(data){
        if(mascaraInteiro(data)==false){
                event.returnValue = false;
        }
        return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){
        if(mascaraInteiro(tel)==false){
                event.returnValue = false;
        }
        return formataCampo(tel, '(00) 0000-0000', event);
}

//adiciona mascara ao telefone
function MascaraCelular(tel){
        if(mascaraInteiro(tel)==false){
                event.returnValue = false;
        }
        return formataCampo(tel, '(00) 00000-0000', event);
}

//adiciona mascara ao telefone
function MascaraHora(hora){
        if(mascaraInteiro(hora)==false){
                event.returnValue = false;
        }
        return formataCampo(hora, '00:00', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
        if(mascaraInteiro(cpf)==false){
                event.returnValue = false;
        }
        console.log($('input[name="cpf"]').val().length);
        console.log($('input[name="cpf"]').val());
        console.log(cpf);
        let cpf_val = document.getElementById('cpf').value;
        if(cpf_val.length == 14){
          // cpf_val = cpf_val.replace(/\D/g,'');
          let verificador = verificaCPF(cpf_val);
          if(!verificador){
            $('#enviar').attr('disabled', 'disabled');
            M.toast({html: 'CPF inválido'});
          }else {
            M.toast({html: 'CPF válido'});
            $('#enviar').attr('disabled', false);
          }
        }

        return formataCampo(cpf, '000.000.000-00', event);
}

//valida telefone
function ValidaTelefone(tel){
        exp = /\(\d{2}\)\ \d{5}\-\d{4}/
        if(!exp.test(tel.value))
                alert('Numero de Telefone Invalido!');
}

//valida CEP
function ValidaCep(cep){
        exp = /\d{2}\.\d{3}\-\d{3}/
        if(!exp.test(cep.value))
                alert('Numero de Cep Invalido!');
}

//valida data
function ValidaData(data){
        exp = /\d{2}\/\d{2}\/\d{4}/
        if(!exp.test(data.value))
                alert('Data Invalida!');
}

function verificaCPF(cpf){
    cpf = cpf.replace(/\D/g, '');
    if(cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
    var result = true;
    [9,10].forEach(function(j){
        var soma = 0, r;
        cpf.split(/(?=)/).splice(0,j).forEach(function(e, i){
            soma += parseInt(e) * ((j+2)-(i+1));
        });
        r = soma % 11;
        r = (r <2)?0:11-r;
        if(r != cpf.substring(j, j+1)) result = false;
    });
    return result;
}


//valida o CPF digitado
function ValidarCPF(Objcpf){
        var cpf = Objcpf.value;
        exp = /\.|\-/g
        cpf = cpf.toString().replace( exp, "" );
        var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
        var soma1=0, soma2=0;
        var vlr =11;

        for(i=0;i<9;i++){
                soma1+=eval(cpf.charAt(i)*(vlr-1));
                soma2+=eval(cpf.charAt(i)*vlr);
                vlr--;
        }
        soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
        soma2=(((soma2+(2*soma1))*10)%11);

        var digitoGerado=(soma1*10)+soma2;
        if(digitoGerado!=digitoDigitado)
                alert('CPF Invalido!');
}

//valida numero inteiro com mascara
function mascaraInteiro(){
        if (event.keyCode < 48 || event.keyCode > 57){
                event.returnValue = false;
                return false;
        }
        return true;
}

//valida o CNPJ digitado
function ValidarCNPJ(ObjCnpj){
        var cnpj = ObjCnpj.value;
        var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
        var dig1= new Number;
        var dig2= new Number;

        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace( exp, "" );
        var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));

        for(i = 0; i<valida.length; i++){
                dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);
                dig2 += cnpj.charAt(i)*valida[i];
        }
        dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
        dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));

        if(((dig1*10)+dig2) != digito)
                alert('CNPJ Invalido!');

}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) {
        var boleanoMascara;

        var Digitato = evento.keyCode;
        exp = /\:|\-|\.|\/|\(|\)| /g
        campoSoNumeros = campo.value.toString().replace( exp, "" );

        var posicaoCampo = 0;
        var NovoValorCampo="";
        var TamanhoMascara = campoSoNumeros.length;;

        if (Digitato != 8) { // backspace
                for(i=0; i<= TamanhoMascara; i++) {
                        boleanoMascara  = ((Mascara.charAt(i) == ":") || (Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".") || (Mascara.charAt(i) == "/"))
                        boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(")
                                                                || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
                        if (boleanoMascara) {
                                NovoValorCampo += Mascara.charAt(i);
                                  TamanhoMascara++;
                        }else {
                                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
                                posicaoCampo++;
                          }
                  }
                campo.value = NovoValorCampo;
                  return true;
        }else {
                return true;
        }
}

/* Jquery Mask Money */
!function($){"use strict";function e(e,t){var n="";return e.indexOf("-")>-1&&(e=e.replace("-",""),n="-"),e.indexOf(t.prefix)>-1&&(e=e.replace(t.prefix,"")),e.indexOf(t.suffix)>-1&&(e=e.replace(t.suffix,"")),n+t.prefix+e+t.suffix}function t(e,t){return t.allowEmpty&&""===e?"":t.reverse?a(e,t):n(e,t)}function n(t,n){var a,i,o,l=t.indexOf("-")>-1&&n.allowNegative?"-":"",s=t.replace(/[^0-9]/g,"");return a=r(s.slice(0,s.length-n.precision),l,n),n.precision>0&&(i=s.slice(s.length-n.precision),o=new Array(n.precision+1-i.length).join(0),a+=n.decimal+o+i),e(a,n)}function a(t,n){var a,i=t.indexOf("-")>-1&&n.allowNegative?"-":"",o=t.replace(n.prefix,"").replace(n.suffix,""),l=o.split(n.decimal)[0],s="";if(""===l&&(l="0"),a=r(l,i,n),n.precision>0){var c=o.split(n.decimal);c.length>1&&(s=c[1]),a+=n.decimal+s;var u=Number.parseFloat(l+"."+s).toFixed(n.precision).toString().split(n.decimal)[1];a=a.split(n.decimal)[0]+"."+u}return e(a,n)}function r(e,t,n){return e=e.replace(/^0*/g,""),""===(e=e.replace(/\B(?=(\d{3})+(?!\d))/g,n.thousands))&&(e="0"),t+e}$.browser||($.browser={},$.browser.mozilla=/mozilla/.test(navigator.userAgent.toLowerCase())&&!/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.webkit=/webkit/.test(navigator.userAgent.toLowerCase()),$.browser.opera=/opera/.test(navigator.userAgent.toLowerCase()),$.browser.msie=/msie/.test(navigator.userAgent.toLowerCase()),$.browser.device=/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));var i={prefix:"",suffix:"",affixesStay:!0,thousands:",",decimal:".",precision:2,allowZero:!1,allowNegative:!1,doubleClickSelection:!0,allowEmpty:!1,bringCaretAtEndOnFocus:!0},o={destroy:function(){return $(this).unbind(".maskMoney"),$.browser.msie&&(this.onpaste=null),this},applyMask:function(e){return t(e,$(this).data("settings"))},mask:function(e){return this.each(function(){var t=$(this);return"number"==typeof e&&t.val(e),t.trigger("mask")})},unmasked:function(){return this.map(function(){var e,t=$(this).val()||"0",n=-1!==t.indexOf("-");return $(t.split(/\D/).reverse()).each(function(t,n){if(n)return e=n,!1}),t=t.replace(/\D/g,""),t=t.replace(new RegExp(e+"$"),"."+e),n&&(t="-"+t),parseFloat(t)})},unmaskedWithOptions:function(){return this.map(function(){var e=$(this).val()||"0",t=$(this).data("settings")||i,n=new RegExp(t.thousandsForUnmasked||t.thousands,"g");return e=e.replace(n,""),parseFloat(e)})},init:function(n){return n=$.extend($.extend({},i),n),this.each(function(){function a(){var e,t,n,a,r,i=x.get(0),o=0,l=0;return"number"==typeof i.selectionStart&&"number"==typeof i.selectionEnd?(o=i.selectionStart,l=i.selectionEnd):(t=document.selection.createRange())&&t.parentElement()===i&&(a=i.value.length,e=i.value.replace(/\r\n/g,"\n"),(n=i.createTextRange()).moveToBookmark(t.getBookmark()),(r=i.createTextRange()).collapse(!1),n.compareEndPoints("StartToEnd",r)>-1?o=l=a:(o=-n.moveStart("character",-a),o+=e.slice(0,o).split("\n").length-1,n.compareEndPoints("EndToEnd",r)>-1?l=a:(l=-n.moveEnd("character",-a),l+=e.slice(0,l).split("\n").length-1))),{start:o,end:l}}function r(){var e=!(x.val().length>=x.attr("maxlength")&&x.attr("maxlength")>=0),t=a(),n=t.start,r=t.end,i=!(t.start===t.end||!x.val().substring(n,r).match(/\d/)),o="0"===x.val().substring(0,1);return e||i||o}function i(e){w.formatOnBlur||x.each(function(t,n){if(n.setSelectionRange)n.focus(),n.setSelectionRange(e,e);else if(n.createTextRange){var a=n.createTextRange();a.collapse(!0),a.moveEnd("character",e),a.moveStart("character",e),a.select()}})}function o(e){var n,a=x.val().length;x.val(t(x.val(),w)),n=x.val().length,w.reverse||(e-=a-n),i(e)}function l(){var e=x.val();if(!w.allowEmpty||""!==e){var n=e.indexOf(w.decimal);if(w.precision>0)if(n<0)e+=w.decimal+new Array(w.precision+1).join(0);else{var a=e.slice(0,n),r=e.slice(n+1);e=a+w.decimal+r+new Array(w.precision+1-r.length).join(0)}else n>0&&(e=e.slice(0,n));x.val(t(e,w))}}function s(){var e=x.val();return w.allowNegative?""!==e&&"-"===e.charAt(0)?e.replace("-",""):"-"+e:e}function c(e){e.preventDefault?e.preventDefault():e.returnValue=!1}function u(e){var t=(e=e||window.event).which||e.charCode||e.keyCode,n=w.decimal.charCodeAt(0);return void 0!==t&&(!(t<48||t>57)||t===n&&w.reverse?!!r()&&((t!==n||!d())&&(!!w.formatOnBlur||(c(e),p(e),!1))):g(t,e))}function d(){return!v()&&f()}function v(){var e=x.val().length,t=a();return 0===t.start&&t.end===e}function f(){return x.val().indexOf(w.decimal)>-1}function p(e){var t,n,r,i,l=(e=e||window.event).which||e.charCode||e.keyCode,s="";l>=48&&l<=57&&(s=String.fromCharCode(l)),n=(t=a()).start,r=t.end,i=x.val(),x.val(i.substring(0,n)+s+i.substring(r,i.length)),o(n+1)}function g(e,t){return 45===e?(x.val(s()),!1):43===e?(x.val(x.val().replace("-","")),!1):13===e||9===e||(!(!$.browser.mozilla||37!==e&&39!==e||0!==t.charCode)||(c(t),!0))}function m(){setTimeout(function(){l()},0)}function h(){return(parseFloat("0")/Math.pow(10,w.precision)).toFixed(w.precision).replace(new RegExp("\\.","g"),w.decimal)}var w,b,x=$(this);w=$.extend({},n),w=$.extend(w,x.data()),x.data("settings",w),$.browser.device&&x.attr("type","tel"),x.unbind(".maskMoney"),x.bind("keypress.maskMoney",u),x.bind("keydown.maskMoney",function(e){var t,n,r,i,l,s=(e=e||window.event).which||e.charCode||e.keyCode;return void 0!==s&&(t=a(),n=t.start,r=t.end,8!==s&&46!==s&&63272!==s||(c(e),i=x.val(),n===r&&(8===s?""===w.suffix?n-=1:(l=i.split("").reverse().join("").search(/\d/),r=1+(n=i.length-l-1)):r+=1),x.val(i.substring(0,n)+i.substring(r,i.length)),o(n),!1))}),x.bind("blur.maskMoney",function(t){if($.browser.msie&&u(t),w.formatOnBlur&&x.val()!==b&&p(t),""===x.val()&&w.allowEmpty)x.val("");else if(""===x.val()||x.val()===e(h(),w))w.allowZero?w.affixesStay?x.val(e(h(),w)):x.val(h()):x.val("");else if(!w.affixesStay){var n=x.val().replace(w.prefix,"").replace(w.suffix,"");x.val(n)}x.val()!==b&&x.change()}),x.bind("focus.maskMoney",function(){b=x.val(),l();var e,t=x.get(0);w.selectAllOnFocus?t.select():t.createTextRange&&w.bringCaretAtEndOnFocus&&((e=t.createTextRange()).collapse(!1),e.select())}),x.bind("click.maskMoney",function(){var e,t=x.get(0);w.selectAllOnFocus||(t.setSelectionRange&&w.bringCaretAtEndOnFocus?(e=x.val().length,t.setSelectionRange(e,e)):x.val(x.val()))}),x.bind("dblclick.maskMoney",function(){var e,t,n=x.get(0);n.setSelectionRange&&w.bringCaretAtEndOnFocus?(t=x.val().length,e=w.doubleClickSelection?0:t,n.setSelectionRange(e,t)):x.val(x.val())}),x.bind("cut.maskMoney",m),x.bind("paste.maskMoney",m),x.bind("mask.maskMoney",l)})}};$.fn.maskMoney=function(e){return o[e]?o[e].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof e&&e?void $.error("Method "+e+" does not exist on jQuery.maskMoney"):o.init.apply(this,arguments)}}(window.jQuery||window.Zepto);

$(function() {
	$('#preco').maskMoney();
})
