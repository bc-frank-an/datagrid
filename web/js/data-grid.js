var dataGrid = {

  currentPage: 1,
  limit: 10,
  order: null,
  dir: "desc",


  buildQueryStr: function () {
    var url = "?page=" + this.currentPage + "&limit=" + this.limit;
    if (this.order && this.dir)url += "&orderBy=" + this.order + "&dir=" + this.dir;
    return url;
  },

  isEnterKey: function (event) {

    key = event.which;

    if (window.event) {
      key = window.event.keyCode; //IE
    }
    console.log(key);
    if (key == 13) {
      return true;
    }
    return false;
  },

  goToPrevPage: function () {

    this.goToPage(null, --this.currentPage);

  },

  goToNextPage: function () {
    this.goToPage(null, ++this.currentPage);
  },

  goToPage: function (event, pageNumber) {
    if (event && !this.isEnterKey(event))return;
    this.currentPage = pageNumber;

    var currentUrl = window.location.pathname;

    currentUrl = currentUrl.split("?")[0];

    window.location = currentUrl + this.buildQueryStr();
  },

  changeLimit: function (limit) {
    this.limit = limit;
    var currentUrl = window.location.pathname;

    currentUrl = currentUrl.split("?")[0];

    window.location = currentUrl + this.buildQueryStr();
  },

  orderBy: function (order) {

    this.order = order;

    if(!this.dir)this.dir="asc";
    else if(this.dir=="asc")this.dir="desc";
    else if(this.dir=="desc")this.dir="asc";

    console.log(this.dir + " " + this.order);

    var currentUrl = window.location.pathname;

    currentUrl = currentUrl.split("?")[0];

    window.location = currentUrl + this.buildQueryStr();

  }

}

$(function(){

  $('.order-header').each(function(index,value){
    console.log($(value).attr('fieldName'))

    if($(value).attr('fieldName')==dataGrid.order)
    {
      if(dataGrid.dir=="asc")
      {
        $(value).addClass('order-asc');

      }else
      {
        $(value).addClass('order-desc');
      }

    }

  });

});