<script>
        function showProgress(progressBarClass,elementId) {
            $(progressBarClass).find(elementId).css('width', '0%');
            $(progressBarClass).find(elementId).html('0%');
            $(progressBarClass).find(elementId).removeClass('bg-success');
            $(progressBarClass).show();
        }

        function updateProgress(progressBarClass,elementId,value) {
            $(progressBarClass).find(elementId).css('width', `${value}%`)
            $(progressBarClass).find(elementId).html(`${value}%`)

            if (value === 100) {
                $(progressBarClass).find(elementId).addClass('bg-success');

                // setTimeout(hideProgress(progressBarClass), 120000);
            }
        }

        function hideProgress(progressBarClass) {
            $(progressBarClass).hide();
        }
        //End file upload
       
</script>