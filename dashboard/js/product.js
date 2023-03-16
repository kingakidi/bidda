let plink = document.getElementsByName("p-link");
let slv = _("show-item");

function clean(x) {
  return x.value.trim().length;
}
plink.forEach(function (element) {
  element.onclick = function (event) {
    event.preventDefault();
    id = this.id;

    slv.innerHTML =
      '<div class="fa-size"><span><i class="fa fa-refresh fa-spin"></i></span></div>';
    if (id === "myproducts") {
      $.ajax({
        url: "./control/action.php",
        method: "POST",
        data: {
          myProducts: "myProducts",
        },
        success: function (data) {
          slv.innerHTML = data;
        },
      });
    } else if (id === "addproducts") {
      $.ajax({
        url: "./control/forms.php",
        method: "POST",
        data: {
          aPForm: "addProduct",
        },
        success: function (data) {
          slv.innerHTML = data;
        },
      }).done(function () {
        //    GET ALL THE FORM VARIABLES
        let adProductForm = _("addProduct");
        let name = _("name");
        let price = _("price");

        let cat = _("cat");
        let qty = _("qty");
        let pfe = _("pfError");
        let bpf = _("btn-pf");
        let pImage = _("p-image");
        let iInfo = _("image-info");
        let product_type = _("product_type");

        $(".custom-file-input").on("change", function () {
          var fileName = $(this).val().split("\\").pop();
          $(this)
            .siblings(".custom-file-label")
            .addClass("selected")
            .html(fileName);
        });

        // var formData = new FormData(this)
        CKEDITOR.replace("des", {
          height: 100,
        });
        let desc = _("des");
        // let des = CKEDITOR.instances.des.getData();

        pImage.onchange = function (event) {
          let files = pImage.files;
          let type = files[0].type;

          // console.log(files);
          //    iInfo.innerHTML = `${files[0].name} ${files[0].type} ${files[0].size}`;
          if (
            type === "image/jpeg" ||
            type === "image/jpg" ||
            type === "image/png"
          ) {
            iInfo.innerHTML =
              files[0].name +
              "<br>" +
              Math.round(files[0].size / 1000000) +
              "MB";
          } else {
            iInfo.innerHTML = "INVALID FILE SELECTED, jpeg, png Only";
          }
        };
        adProductForm.onsubmit = function (evt) {
          evt.preventDefault();

          let files = pImage.files;

          //    CLEAN THE FORM
          if (
            clean(name) > 0 &&
            clean(price) > 0 &&
            clean(cat) > 0 &&
            clean(qty) > 0 &&
            clean(desc) > 0 &&
            files.length > 0
          ) {
            // CHECK FOR THE FILES TYPE
            let type = files[0].type;

            if (
              type === "image/jpeg" ||
              type === "image/jpg" ||
              type === "image/png"
            ) {
              pfe.innerHTML = "<div class='text-info mt-2'>GOOD</div>";
              pfe.style.visibility = "visible";
              // SEND AJAX
              const fd = new FormData();

              fd.append("image", files[0]);
              fd.append("name", name.value);
              fd.append("des", des.value);
              fd.append("price", price.value);
              fd.append("cat", cat.value);
              fd.append("qty", qty.value);
              fd.append("product_type", product_type.value);

              fd.append("aPForm", "aPForm");
              $.ajax({
                url: "./control/action.php",
                method: "POST",
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function () {
                  pfe.innerHTML =
                    '<i class="fa fa-refresh fa-spin"></i> Loading';
                  bpf.disabled = true;
                },
                success: function (data) {
                  pfe.innerHTML = data;
                  pfe.style.visibility = "visible";
                  bpf.disabled = false;
                },
              });
            } else {
              pfe.innerHTML =
                "<div class='text-danger mt-2'>INVALID FILE TYPE</div>";
              pfe.style.visibility = "visible";
            }
          } else {
            pfe.innerHTML =
              "<div class='text-danger mt-2'>ALL FIELDS REQUIRED</div>";
            pfe.style.visibility = "visible";
          }
        };
      });
      // SEND AJAX FOR ADD PRODUCTS
    } else if (id === "allproducts") {
      // BRING ALL PRODUCTS
      $.ajax({
        url: "./control/action.php",
        method: "POST",
        data: {
          allProducts: "allproducts",
        },
        success: function (data) {
          slv.innerHTML = data;
        },
      });
    } else if (id === "sales") {
      $.ajax({
        url: "./control/action.php",
        method: "POST",
        data: {
          mySales: "mySales",
        },
        success: function (data) {
          slv.innerHTML = data;
        },
      });
    }
  };
});
