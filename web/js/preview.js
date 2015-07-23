function changeSizeImage(id) {
  if (id.class === "preview-image") $(id).addClass("large")
  $(id).toggleClass("large")
}