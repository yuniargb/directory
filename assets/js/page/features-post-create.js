"use strict";

$("select").selectric();
$.uploadPreview({
  input_field: "#image-upload", // Default: .image-upload
  preview_box: "#image-preview", // Default: .image-preview
  label_field: "#image-label", // Default: .image-label
  label_default: "Choose File", // Default: Choose File
  label_selected: "Change File", // Default: Change File
  no_label: false, // Default: false
  success_callback: null // Default: null
});

$.uploadPreview({
  input_field: "#logo_1", // Default: .image-upload
  preview_box: "#image-preview-1", // Default: .image-preview
  label_field: "#image-label-1", // Default: .image-label
  label_default: "Pilih File", // Default: Choose File
  label_selected: "Ganti File", // Default: Change File
  no_label: false, // Default: false
  success_callback: null // Default: null
});
$.uploadPreview({
  input_field: "#logo_2", // Default: .image-upload
  preview_box: "#image-preview-2", // Default: .image-preview
  label_field: "#image-label-2", // Default: .image-label
  label_default: "Pilih File", // Default: Choose File
  label_selected: "Ganti File", // Default: Change File
  no_label: false, // Default: false
  success_callback: null // Default: null
});
$(".inputtags").tagsinput('items');