
let af = i("upload-files");
let sfi = i("show-file-info");

af.onchange = function () {
  let files = af.files;
  sfi.innerHTML = "";
  if (files.length > 0) {

    // IF FILES IS CHOOSEN
    let type = files[i].type;
      let name = files[i].name;
      let size = files[i].size;

      if (
        type === "text/html" ||
        type === "text/htm" ||
        type === "text/css" ||
        type === "text/javascript"
      ) {
        let message = `NAME: ${name} <br> TYPE: ${type} <br> SIZE: ${size} <hr>`;
        sfi.innerHTML += message;
      } else {
        sfi.innerHTML += `NAME: ${name} <br> TYPE:  <strong> INVALID FILE TYPE </strong> <hr>`;
      }
  } else {
    sfi.innerHTML = "NO FILE SELECTED";
  }
};

buf.onclick = function (e) {
  e.preventDefault();
  let files = af.files;
  let i = 0;

  const fileAjax = new XMLHttpRequest();
  const fd = new FormData();

  while (i < files.length) {
    let type = files[i].type;
    let name = files[i].name;
    let size = files[i].size;
    if (
      type === "text/html" ||
      type === "text/htm" ||
      type === "text/css" ||
      type === "text/javascript"
    ) {
      let message = `LOADING:.. ${name} `;
      sfi.innerHTML += message;
      fileAjax.open("POST", "./control/upload.php", true);
      fileAjax.onreadystatechange = function () {
        if (fileAjax.readyState == 4 && fileAjax.status == 200) {
          sfi.innerHTML = this.responseText;
        }
      };
      fd.append("upload", files[i]);
      fd.append("title", title.value);
      // Initiate a multipart/form-data upload
      fileAjax.send(fd);
    } else {
      sfi.innerHTML += `NAME: ${name} <br> TYPE:  <strong> INVALID FILE TYPE </strong> <hr>`;
    }
    i++;
  }
};
