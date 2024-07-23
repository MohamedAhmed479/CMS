tinymce.init({
    selector: 'textarea'
  });
  
  $(document).ready(function() {
  
    $('#selectAllBoxe').click(function(event) {
  
      if(this.checked) {
        $('.checkBoxes').each(function(){
          this.checked = true;
        });
      } else { 
        $('.checkBoxes').each(function(){
          this.checked = false; // هنا التغيير
        });
      }
    });
  
  });
  