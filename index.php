<b>VKCard application</b>
<html>
<head>
    <title>Hello World!</title>
    <script src="http://vkontakte.ru/js/api/xd_connection.js?2" type="text/javascript"></script>
</head>
<body>

<div id="vk_auth">aaaa</div>

<script type="text/javascript">
window.onload = function () {
VK.init({apiId: 3392840});

VK.api('friends.get', {fields:"first_name,last_name,photo"}, function(data) {
        var frCount = data.response.length;
 
        var onlineStr = '<select name="vk_friend" multiple size=20>';
 
        for (var i=0; i<frCount; i++) {
            onlineStr += '<option value="' + data.response[i].uid + '">' + data.response[i].first_name + ' ' + data.response[i].last_name + '</a></option>';
        }
        onlineStr += '</select>';
        var listdiv  = document.getElementById('vk_auth').innerHTML=onlineStr;
    });
}
</script>
</body>
</html>
