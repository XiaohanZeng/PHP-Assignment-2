// JavaScript source code
window.onload = function()
{
    makeRequest('action=init');

}

/*Dletebutton.onclick = function
{
  getbuttiByID
  request -> PHP id delete row with this ID
}*/
function makeRequest(statement)
{
    var xmlhttp;
    if(window.XMLHttpRequest)
    {
        xmlhttp = new XMLHttpRequest();
    }
    else
    {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var response = xmlhttp.responseText;
            var elem = document.getElementById('videoTrack')
            elem.innerHTML = response;
            localStorage.setItem('localvideo',response);
            //addListeners();
        }

    }
    xmlhttp.open("GET",'videoTrack.php?' + statement,true);
    xmlhttp.send();
}
   /* if(statement == 'action = add')
    {
        var elem = document.getElementById('videoTrack');
        statement += '&Name=' +elem.elements['Name'].value;
        statement += '&Category=' +elem.elements['Category'].value;
        statement += '&Length=' +elem.elements['Category'].value;
        statement += '&Rent=' +elem.elements['Rent'].value;
    }
    var filter = 'filter='+ localStorage.getItem('filter');
    var filterBy = 'filterBy=' + localStorage.getItem('filterBy');
    var sortBy = 'sortBy=' + localStorage.getItem('sortBy');
    statement += '&' + filter + '&' + filterBy + '&' + sortBy;
    */    
    