require('./bootstrap');
import 'jquery-ui/ui/widgets/autocomplete.js';


$("#thumbnail").on("change", function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".thumbnail").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    }
});

