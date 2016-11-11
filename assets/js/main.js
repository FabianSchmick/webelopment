function addClassActiveToNav()
{
    var url = window.location;
    var element = $('.nav ul a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
}