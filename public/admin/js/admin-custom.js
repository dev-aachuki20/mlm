$(document).ready(function() {
    $(".show_hide_password i").on('click', function(event) {
        event.preventDefault();
          var $thisEle = $(this);
    
          var $inputElement = $(this).parent('.input-group-addon').siblings('input');
          // console.log($inputElement);
            if($inputElement.attr("type") == "text"){
              $inputElement.attr('type', 'password');
              $thisEle.addClass( "fa-eye-slash").removeClass( "fa-eye" );
            }else if($inputElement.attr("type") == "password"){
                $inputElement.attr('type', 'text');
                $thisEle.removeClass( "fa-eye-slash").addClass( "fa-eye" );
            }
    });

    // Start datatable search filter
    // Handle search input
    const searchInput = $('#searchInput');
    const clearSearch = $('#clearSearch');
    
    clearSearch.hide();
    
    // Show/hide clear icon based on input value
    searchInput.on('focus',function(){
      clearSearch.show();
    });

    // searchInput.on('focusout',function(){
    //   clearSearch.hide();
    // });

    searchInput.on('keyup', function() {
      const inputValue = searchInput.val();
      if(inputValue != ''){
        clearSearch.show();
      }else{
        clearSearch.hide();
      }
      clearSearch.toggle(!!inputValue);
    });
    
    // Clear input on clear icon click
    clearSearch.on('click', function() {
      searchInput.val('').focus();
      clearSearch.hide();
    });
    // End datatable search filter

   
     
});



