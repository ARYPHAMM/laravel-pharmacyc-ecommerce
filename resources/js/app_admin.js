require("./bootstrap");

$("#thumbnail").on("change", function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(".user__avatar--image").removeClass("d-none");
            $(".user__avatar--image")
                .next("span")
                .removeClass("d-flex")
                .addClass("d-none");
            $(".user__avatar--image").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    }
});

