// JavaScript source code
window.onload = function()
{
    makeRequest('action=init');
    document.getElementById("deleteAll").onclick = function ()
    {
        makeRequest('action=deleteAll');
    }
    document.getElementById("addNew").onclick = function () {
        var newName = document.getElementById('addForm').elements['Name'].value;
        var newCategory = document.getElementById('addForm').elements['Category'].value;
        var newLength = document.getElementById('addForm').elements['Length'].value;
        if (!isNaN(newLength) && parseInt(newLength) > 0 && newName.length < 255 && newCategory.length < 255 && checkUniqueName(newName))
        {
            makeRequest('action=addNew&Name=' + newName + '&Category=' + newCategory + '&Length=' + newLength);
        }
        else
        {
            var errorMessage1 = "";
            var errorMessage2 = "";
            var errorMessage3 = "";
            var errorMessage4 = "";
            if (isNaN(newLength) || parseInt(newLength) <= 0)
            {
                errorMessage1 = "invalid length input";
            }
            if (newName.length >= 255)
            {
                errorMessage2 = "invalid name input";
            }
            if (newCategory.length >= 255)
            {
                errorMessage3 = "invalid category input";
            }
            if (!checkUniqueName(newName))
            {
                errorMessage4 = "not unique name";
            }
            window.alert(errorMessage1 + " " + errorMessage2 + " " + errorMessage3 + " "+errorMessage4);
        }
    }
}


/*Dletebutton.onclick = function
{
  getbuttiByID
  request -> PHP id delete row with this ID
}*/

function checkUniqueName(newName)
{
    var existName = document.getElementsByClassName("checkName");
    var length = existName.length;
    for(var i = 0; i < length; i++)
    {
        if (newName == existName[i].textContent)
            return false;
    }
    return true;
}
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
    