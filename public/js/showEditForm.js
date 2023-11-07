function toggleEdit() {
  const elem = document.getElementById("editForm");
  if (elem?.style?.display === "block") {
    elem.style.display = "none";
  } else {
    elem.style.display = "block";  
  }
}