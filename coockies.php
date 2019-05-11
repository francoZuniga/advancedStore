<div id="overbox3" style="position: fixed; width: 100%;">
    <div id="infobox3">
        <p>Esta web utiliza cookies para obtener datos estadísticos de la navegación de sus usuarios. Si continúas navegando consideramos que aceptas su uso.
        <a href="politica-privacidad.php">Más información</a>
        <a class="close" onclick="aceptar_cookies();" style="cursor:pointer;"><span aria-hidden="true">&times;</span></a></p>
    </div>
</div>
<style media="screen">
#overbox3 {
    position: fixed;
    bottom: 0;
    background-color: rgba(185, 185, 185, .5);
}
#infobox3 {
    margin: auto;
    position: relative;
    top: 0px;
    height: 58px;
    width: 100%;
    text-align:center;
    background-color: rgba(185, 185, 185, .5);
}
#infobox3 p {
    line-height:58px;
    font-size:12px;
    text-align:center;
}
#infobox3 p a {
    margin-right:15px;
    text-decoration: underline;
}
#infobox3 p a span{
  margin-right: 25px;
}
</style>
<script type="text/javascript">
function GetCookie(name) {
    var arg=name+"=";
    var alen=arg.length;
    var clen=document.cookie.length;
    var i=0;

    while (i<clen) {
        var j=i+alen;

        if (document.cookie.substring(i,j)==arg)
            return "1";
        i=document.cookie.indexOf(" ",i)+1;
        if (i==0)
            break;
    }

    return null;
}

function aceptar_cookies(){
    var expire=new Date();
    expire=new Date(expire.getTime()+7776000000);
    document.cookie="cookies_surestao=aceptada; expires="+expire;

    var visit=GetCookie("cookies_surestao");

    if (visit==1){
        popbox3();
    }
}

$(function() {
    var visit=GetCookie("cookies_surestao");
    if (visit==1){ popbox3(); }
});

function popbox3() {
    $('#overbox3').toggle();
}
</script>
